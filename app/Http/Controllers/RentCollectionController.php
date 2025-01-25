<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Rent;
use App\Models\MonthlyRent;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\UserStatement;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RentCollectionHistory;

class RentCollectionController extends Controller
{
    public function index()
    {
        $rents = MonthlyRent::with('collectionHistory')->get();
        return view('rentcollection.index', compact('rents'));
    }
    public function create()
    {
        // $rents = MonthlyRent::with('collectionHistory')->get();
        $rents = Rent::where('status', '1')->with('renter')->get();
        $methods = PaymentMethod::get();
        return view('rentcollection.create', compact('rents', 'methods'));
    }

    public function getDue($rentId)
    {
        $rents = MonthlyRent::where('rent_id', $rentId)->get();
        $total = $rents->sum('total_amount');
        $collection = $rents->sum('collection_amount');

        if ($rents->isEmpty()) {
            return response()->json(['error' => 'Rent not found'], 404);
        }

        $due = $total - $collection;

        $collectionrents = RentCollectionHistory::where('rent_id', $rentId)->orderBy('created_at', 'desc')->latest()->take(3)->get();
        $collectionDetails = $collectionrents->map(function ($rent) {
            return [
                'month' => $rent->month,
                'year' => $rent->year,
                'collection_amount' => $rent->amount_paid,
            ];
        });

        return response()->json([
            'due_amount' => $due,
            'collection_amount' => $collection,
            'collection_details' => $collectionDetails,
        ]);
    }


    public function collectRent(Request $request)
    {
        $request->validate([
            'amount_paid' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $rentId = $request->agreement_id;

            $rent = MonthlyRent::where('rent_id', $rentId)->where('month', $request->month)->where('year', $request->year)->first();

            if ($rent == null) {
                return back()->with('failed', 'এই মাসের ভাড়া জেনারেট করা হয় নাই।');
            }

            $date = date('Y-m-d', strtotime($request->payment_date));
            $invoice = time();

            $collection_amount = $rent->collection_amount ?? 0;
            $newAdvance = $collection_amount + $request->amount_paid;

            // Update Rent Status
            $status = $newAdvance >= $rent->total_amount ? 2 : 1; // 2 for fully paid, 1 for partially paid

            // Update Collection History
            $collection = RentCollectionHistory::create([
                'monthly_rent_id' => $rent->id,
                'rent_id' => $rent->rent_id,
                'amount_paid' => $request->amount_paid,
                'month' => $request->month,
                'year' => $request->year,
                'payment_date' => $date,
                'payment_method' => $request->payment_method,
                'notes' => $request->notes,
                'invoice' => $invoice,
                'status' => $status,
            ]);

            if ($request->amount_paid > 0) {
                $transaction = new Transaction([
                    'user_id' => Auth::user()->id,
                    'payment_method_id' => $request->method_id,
                    'receive_amount' => $request->amount_paid,
                    'type' => '0', //0 means receive 1 means sent amount
                    'transaction_type' => 'App\Models\RentCollectionHistory',
                    'transaction_date' => now(),
                    'note' => $request->notes,
                ]);
                $collection->transactions()->save($transaction);
            }

            // Update Rent Collection Amount and Status
            $rent->update([
                'collection_amount' => $newAdvance,
                'status' => $status,
            ]);

            // Add to Renter Ledger
            $previousBalance = UserStatement::where('rent_id', $rent->rent_id)
                ->latest('payment_date')
                ->orderBy('created_at', 'desc')
                ->value('balance') ?? 0;

            $newBalance = $previousBalance - $request->amount_paid;
            UserStatement::create([
                'user_id' => Auth::user()->id, // Assuming user's ID is stored in `user_id`
                'rent_id' => $rent->rent_id, // Assuming renter's ID is stored in `user_id`
                'monthly_rent_id' => $rent->id,
                'amount_paid' => $request->amount_paid,
                'payment_method_id' => $request->method_id,
                'balance' => $newBalance,
                'payment_date' => $date,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Rent collected successfully and ledger updated.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Failed to collect rent. Please try again.' . $e->getMessage());
        }
    }


    public function history()
    {
        $history = RentCollectionHistory::with('monthly_rent', 'rent')->get();
        // dd($history);
        return view('rentcollection.history', compact('history'));
    }

    public function print($id)
    {
        $history = RentCollectionHistory::find($id);
        // dd($history);
        $rent = MonthlyRent::where('id', $history->monthly_rent_id)->first();
        $due = $rent->total_amount - $rent->collection_amount;
        return view('rentcollection.index', compact('history', 'due'));
    }

    public function delete($id)
    {
        $collection = RentCollectionHistory::find($id);
        // dd($collection);
        try {
            DB::beginTransaction();

            $rent = MonthlyRent::where('id', $collection->monthly_rent_id)->first();
            $previous_collection = $rent->collection_amount;
            $collected          = $collection->amount_paid;
            $new_collection     = $previous_collection - $collected;

            $rent->update([
                'collection_amount' => $new_collection,
            ]);

            $statement = UserStatement::where('rent_id', $collection->rent_id)->where('monthly_rent_id', $collection->monthly_rent_id)->first();
            $statement->delete();
            
            $collection->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Collection deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Failed to delete collection. Please try again.' . $e->getMessage());
        }
    }
}
