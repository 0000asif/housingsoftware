<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Unit;
use App\Models\Floor;
use App\Models\House;
use App\Models\Renter;
use Illuminate\Http\Request;
use App\Models\RentAdjustment;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rents = Rent::with('house', 'floor', 'renter', 'unit')->get();
        return view('rent.index', compact('rents'));
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
        $unit = Unit::where('status', '1')->get();
        $renter = Renter::where('status', '1')->get();
        return view('rent.create', compact('house', 'floor', 'unit', 'renter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validate the form data
        $validated = $request->validate([
            'renter_id' => 'required|exists:renters,id',
            'rent_date' => 'required|date',
            'house_id' => 'required|exists:houses,id',
            'floor_id' => 'required|exists:floors,id',
            'unit_id' => 'required|exists:units,id',
            'monthly_rent' => 'required|numeric|min:0',
            'electracity_bill' => 'nullable|numeric|min:0',
            'water_bill' => 'nullable|numeric|min:0',
            'gas_bill' => 'nullable|numeric|min:0',
            'gatmanbill' => 'nullable|numeric|min:0',
            'lift_bill' => 'nullable|numeric|min:0',
            'car_reg_no' => 'nullable|string',
            'quantity' => 'nullable|integer|min:0',
            'garage_bill' => 'nullable|numeric|min:0',
            'service_charge' => 'nullable|numeric|min:0',
            'advance' => 'nullable|numeric|min:0',
            'member' => 'nullable|numeric|min:0',
        ]);

        $start_date = date('Y-m-d', strtotime($request->rent_date));
        // dd($request->all());
        $validated['user_id'] = Auth::user()->id;
        $validated['status'] = '1';
        $validated['rent_date'] = $start_date;

        Rent::create($validated);

        $unit = Unit::find($request->unit_id);

        $unit->rent_status = '1'; // status 0 meand avilable & 1 means rented.
        $unit->save();

        // Redirect or return response
        return redirect()->back()->with('success', 'Rent record created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rent = Rent::with('renter', 'house', 'floor', 'unit')->findOrFail($id);
        return view('rent.show', compact('rent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rent = Rent::findOrFail($id);
        $renters = Renter::where('status', '1')->get();
        $houses = House::where('status', '1')->get();

        $floors = Floor::where('house_id', $rent->house_id)->get();
        $units = Unit::where('floor_id', $rent->floor_id)->get();

        return view('rent.edit', compact('rent', 'renters', 'houses', 'floors', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    // Show the edit form
    // Update rent details
    public function update(Request $request, $id)
    {
        $request->validate([
            'renter_id' => 'required|exists:renters,id',
            'rent_date' => 'nullable|date',
            'house_id' => 'required|exists:houses,id',
            'floor_id' => 'required|exists:floors,id',
            'unit_id' => 'required|exists:units,id',
            'monthly_rent' => 'required|numeric|min:0',
            'electracity_bill' => 'nullable|numeric|min:0',
            'water_bill' => 'nullable|numeric|min:0',
            'gas_bill' => 'nullable|numeric|min:0',
            'gatmanbill' => 'nullable|numeric|min:0',
            'lift_bill' => 'nullable|numeric|min:0',
            'car_reg_no' => 'nullable|string',
            'quantity' => 'nullable|integer|min:0',
            'garage_bill' => 'nullable|numeric|min:0',
            'service_charge' => 'nullable|numeric|min:0',
            'advance' => 'nullable|numeric|min:0',
            'member' => 'nullable|numeric|min:0',
            'status' => 'required',
        ]);

        $start_date = date('Y-m-d', strtotime($request->rent_date));

        $rent = Rent::findOrFail($id);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['rent_date'] = $start_date;
        $data['status'] = $request->status;

        $rent->update($data);

        $unit = Unit::find($request->unit_id);
        $unit->rent_status = $request->status; // status 0 meand avilable & 1 means rented.
        $unit->save();

        return redirect()->route('rent.index')->with('success', 'Rent record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rent $rent)
    {
        //
    }

    public function IncreaseDecrease()
    {
        $renters = Rent::with('renter')->where('status', '1')->get();
        return view('rent.RentIncreaseDecrease', compact('renters'));
    }

    public function RentIncreaseDecreaseStore(Request $request)
    {
        $validatedData = $request->validate([
            'rent_id' => 'required|exists:rents,id',
            'renter_id' => 'required|exists:renters,id',
            'adjustment_date' => 'required|date',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:1900',
            'monthly_rent' => 'required|numeric|min:0',
            'electracity_bill' => 'nullable|numeric|min:0',
            'water_bill' => 'nullable|numeric|min:0',
            'gas_bill' => 'nullable|numeric|min:0',
            'gatmanbill' => 'nullable|numeric|min:0',
            'lift_bill' => 'nullable|numeric|min:0',
            'garage_bill' => 'nullable|numeric|min:0',
            'service_charge' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
        ]);
        $start_date = date('Y-m-d', strtotime($request->adjustment_date));
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['adjustment_date'] = $start_date;
        // dd($validatedData);
        $rentAdjustment = RentAdjustment::create($validatedData);

        return redirect()->back()->with('success', 'Rent increased/decreased successfully.');
    }

    public function getRenter(Request $request)
    {
        $renter = Rent::where('id', $request->rent_id)->first();
        // dd($renter);
        if ($renter) {
            return response()->json([
                'status' => 'success',
                'renter_id' => $renter->renter_id,
            ]);
        }

        return response()->json(['error' => 'Rent not found'], 404);
    }
}
