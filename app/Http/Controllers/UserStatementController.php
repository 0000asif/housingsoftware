<?php

namespace App\Http\Controllers;

use App\Models\MonthlyRent;
use Illuminate\Http\Request;
use App\Models\UserStatement;
use Illuminate\Routing\Controller;

class UserStatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ledgers = UserStatement::with(['rent', 'monthlyRent'])->get(); // Fetch data with relationships if needed
        return view('renter_ledger.index', compact('ledgers'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\UserStatement  $userStatement
     * @return \Illuminate\Http\Response
     */
    public function show($agreementId)
    {
        $rent = MonthlyRent::with('rent')->findOrFail($agreementId); // Fetch agreement details
        $ledger = UserStatement::where('monthly_rent_id', $agreementId)->get(); // Fetch ledger entries

        return view('renter_ledger.show', compact('rent', 'ledger'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserStatement  $userStatement
     * @return \Illuminate\Http\Response
     */
    public function edit(UserStatement $userStatement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserStatement  $userStatement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserStatement $userStatement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserStatement  $userStatement
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserStatement $userStatement)
    {
        //
    }

    public function print($agreementId)
    {
        $rent = MonthlyRent::with('rent')->findOrFail($agreementId); // Fetch agreement details
        $ledger = UserStatement::where('monthly_rent_id', $agreementId)->get(); // Fetch ledger entries

        return view('renter_ledger.print', compact('rent', 'ledger'));
    }
}
