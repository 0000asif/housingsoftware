<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\UserStatement;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $methods = PaymentMethod::with('user')->get();
        return view('payment-method.index', compact('methods'));
    }

    public function create()
    {
        return view('payment-method.cerate');
    }
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'branch_name' => 'nullable|string|max:255',
            'account_number' => 'required',
            'balance' => 'required',
            'opening_date' => 'required',
        ]);
        $user_id = Auth::user()->id;
        $balance = $request->balance;
        $opening_date = date("Y-m-d", strtotime($request->opening_date));

        $data = $request->all();
        $data['user_id'] = $user_id;
        $data['balance'] = $balance ?? 0;
        $data['opening_date'] = $opening_date;

        $method = PaymentMethod::create($data);


        if ($balance > 0) {
            $transaction = new Transaction([
                'user_id' => Auth::user()->id,
                'payment_method_id' => $method->id,
                'receive_amount' => $balance,
                'type' => '0', //0 means receive 1 means sent amount
                'transaction_type' => 'App\Models\PaymentMethod',
                'transaction_date' => now(),
            ]);
            $method->transactions()->save($transaction);
        }

        return redirect()->route('payment_method.index')->with('success', 'Payment Method addedd successfully');
    }

    public function destroy(string $id)
    {
        $method          = PaymentMethod::find($id);
        $user_statements = UserStatement::where('payment_method_id', $method->id)->exists();
        if ($user_statements) {
            return back()->with('failed', 'Method can not be deleted. It has user statements associated.');
        }
        $method->delete();
        return redirect()->route('payment_method.index')->with('success', 'Method Delete Successfully');
    }
}
