<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Floor;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::with('house', 'floor')->get();
        return view('unit.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $house = House::where('status', '1')->get();
        $floor = Floor::where('status', '1')->get();
        return view('unit.create', compact('house', 'floor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'house_id' => 'required',
            'floor_id' => 'required',
            'name' => 'required',
            'info' => 'nullable',
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['status'] = '1';

        Unit::create($data);
        return redirect()->back()->with('success', 'Operation completed successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }
    public function getFloors($houseId)
    {
        $floors = Floor::where('house_id', $houseId)->get();
        return response()->json($floors);
    }
    public function getunits($houseId)
    {
        $floors = Unit::where('floor_id', $houseId)->where('rent_status', '0')->get();
        return response()->json($floors);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $house = House::where('status', '1')->get();
        $floor = Floor::where('status', '1')->get();
        $info = Unit::find($id);
        // dd($leads);  
        return view('unit.edit', compact('info', 'house', 'floor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $unit = Unit::find($id);
        // dd($request->all());
        $request->validate([
            'house_id' => 'required',
            'floor_id' => 'required',
            'name' => 'required',
            'info' => 'nullable',
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $unit->update($data);
        return redirect()->back()->with('success', 'Operation completed successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
        return redirect()->back()->with('success', 'Operation completed successfully!');
    }
}
