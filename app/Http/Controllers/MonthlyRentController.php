<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\House;
use App\Models\MonthlyRent;
use App\Models\RentCollectionHistory;
use Illuminate\Http\Request;
use App\Models\UserStatement;
use App\Models\RentAdjustment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MonthlyRentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monthlyRents = MonthlyRent::whereIn('status', [0, 1])->get();
        return view('monthley_rent.index', compact('monthlyRents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rents = Rent::where('status', '1')->with('renter')->get();
        return view('monthley_rent.create', compact('rents'));
    }
    public function allrentcreate()
    {
        $houses = House::where('status', '1')->get();
        return view('monthley_rent.allrentcreate', compact('houses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MonthlyRent  $monthlyRent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rent = MonthlyRent::find($id);
        return view('monthley_rent.show', compact('rent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MonthlyRent  $monthlyRent
     * @return \Illuminate\Http\Response
     */
    public function edit(MonthlyRent $monthlyRent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MonthlyRent  $monthlyRent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MonthlyRent $monthlyRent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonthlyRent  $monthlyRent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $monthlyRent    = MonthlyRent::find($id);
        $userStatement  = UserStatement::where('monthly_rent_id', $monthlyRent->id)->first();
        $existingRent   = RentCollectionHistory::where('monthly_rent_id', $monthlyRent->id)->exists();
        if ($existingRent) {
            return back()->with('failed', ' Sorry ! This Rent is Used in Rentcollection .');
        } else {
            $userStatement->delete();
            $monthlyRent->delete();
            return back()->with('success', 'Deleted successfully');
        }
    }




    public function generateRent(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'agreement_id' => 'required|exists:rents,id',
            'year' => 'required|digits:4|integer|min:2000|max:' . date('Y'),
            'month' => 'required|integer|min:1|max:12',
            'generate_date' => 'required|date',
            'remarks' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            // Fetch the rent agreement using agreement_id
            $rent = Rent::find($request->agreement_id);

            if (!$rent) {
                return redirect()->back()->with('failed', 'Agreement not found');
            }

            // Check if rent has already been generated for the requested month and year
            $existingRent = MonthlyRent::where('rent_id', $rent->id)
                ->where('month', $request->month)
                ->where('year', $request->year)
                ->first();

            if ($existingRent) {
                return redirect()->back()->with('failed', 'Rent for this agreement has already been generated for the requested month and year.');
            }

            // Fetch any adjustments for the given rent
            $adjustment = RentAdjustment::where('rent_id', $rent->id)
                ->where(function ($query) use ($request) {
                    $query->where('year', '<', $request->year)
                        ->orWhere(function ($q) use ($request) {
                            $q->where('year', '=', $request->year)
                                ->where('month', '<=', $request->month);
                        });
                })
                ->latest('created_at')
                ->first();

            // Calculate the total rent
            $totalRent = $rent->monthly_rent
                + $rent->electracity_bill
                + $rent->water_bill
                + $rent->gas_bill
                + $rent->gatmanbill
                + $rent->lift_bill
                + $rent->garage_bill
                + $rent->service_charge;

            $startDates = date("Y-m-d", strtotime($request->input('generate_date')));

            if ($adjustment) {
                // Calculate the total rent
                $adjustRent = $adjustment->monthly_rent
                    + $adjustment->electracity_bill
                    + $adjustment->water_bill
                    + $adjustment->gas_bill
                    + $adjustment->gatmanbill
                    + $adjustment->lift_bill
                    + $adjustment->garage_bill
                    + $adjustment->service_charge;

                // Adjust the total rent based on the adjustment
                $monthly_rent =  MonthlyRent::create([
                    'user_id' => Auth::user()->id,
                    'renter_id' => $rent->renter_id,
                    'rent_id' => $rent->id,
                    'month' => $request->month,
                    'year' => $request->year,
                    'date' => $startDates,
                    'status' => 0,
                    'total_amount' => $adjustRent,
                    'advance_amount' => $rent->advance ?? '0',
                    'note' => $request->remarks,
                ]);
            } else {
                // Create the monthly rent record
                $monthly_rent =  MonthlyRent::create([
                    'user_id' => Auth::user()->id,
                    'renter_id' => $rent->renter_id,
                    'rent_id' => $rent->id,
                    'month' => $request->month,
                    'year' => $request->year,
                    'date' => $startDates,
                    'status' => 0,
                    'total_amount' => $totalRent,
                    'advance_amount' => $rent->advance ?? '0',
                    'note' => $request->remarks,
                ]);
            }

            $previousBalance = UserStatement::where('rent_id', $rent->id)
                ->latest('created_at')
                ->value('balance') ?? 0;

            $newBalance = $previousBalance + $monthly_rent->total_amount;
            UserStatement::create([
                'user_id' => Auth::user()->id,
                'rent_id' => $rent->id, // Assuming renter's ID is stored in `user_id`
                'monthly_rent_id' => $monthly_rent->id,
                'payable_amount' => $monthly_rent->total_amount,
                'amount_paid' => 0,
                'balance' => $newBalance,
                'payment_date' => $startDates,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Rent generated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'An error occurred while generating rent: ' . $e->getMessage());
        }
    }

    public function allgenerateRent(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'house_id' => 'required|exists:houses,id',
            'year' => 'required|digits:4|integer|min:2000|max:' . date('Y'),
            'month' => 'required|integer|min:1|max:12',
            'generate_date' => 'required|date',
            'remarks' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            // Fetch all rent agreements under the selected house
            $rents = Rent::where('house_id', $request->house_id)->get();

            if ($rents->isEmpty()) {
                return redirect()->back()->with('failed', 'No rent agreements found for the selected house.');
            }

            $skippedRents = [];
            $generatedRents = [];

            foreach ($rents as $rent) {
                // Check if rent has already been generated for the requested month and year
                $existingRent = MonthlyRent::where('rent_id', $rent->id)
                    ->where('month', $request->month)
                    ->where('year', $request->year)
                    ->first();

                if ($existingRent) {
                    // Skip if rent already exists
                    $skippedRents[] = $rent->id;
                    continue;
                }

                // Fetch any adjustments for the given rent
                $adjustment = RentAdjustment::where('rent_id', $rent->id)
                    ->where(function ($query) use ($request) {
                        $query->where('year', '<', $request->year)
                            ->orWhere(function ($q) use ($request) {
                                $q->where('year', '=', $request->year)
                                    ->where('month', '<=', $request->month);
                            });
                    })
                    ->latest('created_at')
                    ->first();

                // Calculate the total rent
                $totalRent = $rent->monthly_rent
                    + $rent->electracity_bill
                    + $rent->water_bill
                    + $rent->gas_bill
                    + $rent->gatmanbill
                    + $rent->lift_bill
                    + $rent->garage_bill
                    + $rent->service_charge;

                $startDates = date("Y-m-d", strtotime($request->input('generate_date')));

                if ($adjustment) {
                    // Calculate adjusted total rent
                    $adjustRent = $adjustment->monthly_rent
                        + $adjustment->electracity_bill
                        + $adjustment->water_bill
                        + $adjustment->gas_bill
                        + $adjustment->gatmanbill
                        + $adjustment->lift_bill
                        + $adjustment->garage_bill
                        + $adjustment->service_charge;

                    // Create the monthly rent record with adjustment
                    $monthly_rent =  MonthlyRent::create([
                        'user_id' => Auth::user()->id,
                        'renter_id' => $rent->renter_id,
                        'rent_id' => $rent->id,
                        'month' => $request->month,
                        'year' => $request->year,
                        'date' => $startDates,
                        'status' => 0,
                        'total_amount' => $adjustRent,
                        'advance_amount' => $rent->advance ?? 0,
                        'note' => $request->remarks,
                    ]);
                } else {
                    // Create the monthly rent record without adjustment
                    $monthly_rent =  MonthlyRent::create([
                        'user_id' => Auth::user()->id,
                        'renter_id' => $rent->renter_id,
                        'rent_id' => $rent->id,
                        'month' => $request->month,
                        'year' => $request->year,
                        'date' => $startDates,
                        'status' => 0,
                        'total_amount' => $totalRent,
                        'advance_amount' => $rent->advance ?? 0,
                        'note' => $request->remarks,
                    ]);
                }

                $generatedRents[] = $rent->id;

                $previousBalance = UserStatement::where('rent_id', $rent->id)
                    ->latest('payment_date')
                    ->value('balance') ?? 0;

                $newBalance = $previousBalance + $monthly_rent->total_amount;
                UserStatement::create([
                    'user_id' => Auth::user()->id, // Assuming user's ID is stored in `user_id`
                    'rent_id' => $rent->id, // Assuming renter's ID is stored in `user_id`
                    'monthly_rent_id' => $monthly_rent->id,
                    'amount_paid' => 0,
                    'balance' => $newBalance,
                    'payment_date' => $startDates,
                ]);
            }

            DB::commit();

            $message = 'Rent generated successfully for the selected house.';
            if (!empty($skippedRents)) {
                $message .= ' Some rents were skipped because they were already generated.';
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'An error occurred while generating rent: ' . $e->getMessage());
        }
    }

    public function print($id)
    {
        $rent = MonthlyRent::find($id);
        return view('monthley_rent.print', compact('rent'));
    }
}
