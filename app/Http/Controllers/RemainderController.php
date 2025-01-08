<?php

namespace App\Http\Controllers;

use App\Models\Renter;
use App\Models\Remainder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemainderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Remainder::with('renter')->orderByDesc('created_at')->get();
        return view('remainder.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $renters = Renter::where('status', '1')->get();
        return view('remainder.create', compact('renters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'renter_id' => 'nullable',
            'note' => 'required',
            'date' => 'required|date',
        ]);
        //make date format first
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['date'] = date('Y-m-d', strtotime($request->date));
        $data['status'] = '1';

        Remainder::create($data);
        return redirect()->route('remainder.index')->with('success', 'Remainder created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Remainder  $remainder
     * @return \Illuminate\Http\Response
     */
    public function show(Remainder $remainder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Remainder  $remainder
     * @return \Illuminate\Http\Response
     */
    public function edit(Remainder $remainder)
    {
        $renters = Renter::where('status', '1')->get();
        return view('remainder.edit', compact('remainder', 'renters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Remainder  $remainder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Remainder $remainder)
    {
        $request->validate([
            'renter_id' => 'nullable',
            'note' => 'required',
            'date' => 'required|date',
        ]);
        //make date format first
        $data = $request->all();
        $data['date'] = date('Y-m-d', strtotime($request->date));
        $data['user_id'] = Auth::user()->id;

        $remainder->update($data);
        return redirect()->route('remainder.index')->with('success', 'Remainder updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Remainder  $remainder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Remainder $remainder)
    {
        $remainder->delete();
        return redirect()->route('remainder.index')->with('success', 'Remainder deleted successfully.');
    }
}
