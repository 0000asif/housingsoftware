<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\BankTransaction;
use Illuminate\Support\Facades\Auth;

class BankTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = BankTransaction::all();
        return view('transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $methods = PaymentMethod::all();
        return view('transaction.create', compact('methods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'payment_method_id' => 'required',
            'amount' => 'required|numeric',
            'image' => 'nullable',
            'reference' => 'nullable',
            'date' => 'required',
            'note' => 'nullable',
        ]);

        //formate first date 
        $validatedData['date'] = date('Y-m-d', strtotime($request->date));
        // upload image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['type'] = '1'; // 1 means deposite and 2 means withdraw

        $bank = BankTransaction::create($validatedData);

        if ($request->amount > 0) {

            $transaction = new Transaction([
                'user_id' => Auth::user()->id,
                'payment_method_id' => $request->payment_method_id,
                'sent_amount' => $request->amount,
                'type' => '1', //0 means receive 1 means sent amount
                'transaction_type' => 'App\Models\IncomeExpence',
                'transaction_date' => now(),
                'reference' => $request->reference,
                'note' => $request->note,
            ]);
            $bank->transactions()->save($transaction);
        }

        return redirect()->route('bankTransaction.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(BankTransaction $bankTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(BankTransaction $bankTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankTransaction $bankTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankTransaction $bankTransaction)
    {
        $bankTransaction->delete();
        return redirect()->route('bankTransaction.index')->with('success', 'Transaction deleted successfully.');
    }

    public function BankToCash()
    {
        $methods = PaymentMethod::all();
        return view('transaction.bank_to_cash', compact('methods'));
    }

    public function BankToCashStore(Request $request)
    {
        $validatedData = $request->validate([
            'payment_method_id' => 'required',
            'amount' => 'required|numeric',
            'image' => 'nullable',
            'reference' => 'nullable',
            'date' => 'required',
            'note' => 'nullable',
        ]);

        //formate first date 
        $validatedData['date'] = date('Y-m-d', strtotime($request->date));
        // upload image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['type'] = '2'; // 1 means deposite and 2 means withdraw

        $bank = BankTransaction::create($validatedData);

        if ($request->amount > 0) {

            $transaction = new Transaction([
                'user_id' => Auth::user()->id,
                'payment_method_id' => $request->payment_method_id,
                'receive_amount' => $request->amount,
                'type' => '0', //0 means receive 1 means sent amount
                'transaction_type' => 'App\Models\IncomeExpence',
                'transaction_date' => now(),
                'reference' => $request->reference,
                'note' => $request->note,
            ]);
            $bank->transactions()->save($transaction);
        }

        return redirect()->route('bankTransaction.index')->with('success', 'Transaction created successfully.');
    }
}
