<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Unit;
use App\Models\Floor;
use App\Models\House;
use App\Models\Renter;
use Illuminate\Http\Request;
use App\Models\RentAdjustment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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

        $start_date             = date('Y-m-d', strtotime($request->rent_date));
        $validated['user_id']   = Auth::user()->id;
        $validated['status']    = '1';
        $validated['rent_date'] = $start_date;
        $rent_info = Rent::create($validated);

        $inputs                     = $validated;
        $inputs['rent_id']          = $rent_info->id;
        $inputs['user_id']          = Auth::user()->id;
        $inputs['adjustment_date']  = Carbon::now()->format('Y-m-d');
        $inputs['month']            = Carbon::parse($start_date)->format('m');
        $inputs['year']             = Carbon::parse($start_date)->format('Y');
        RentAdjustment::create($inputs);

        $unit               = Unit::find($request->unit_id);
        $unit->rent_status  = '1'; // status 0 meand avilable & 1 means rented.
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
        $units = Unit::where('floor_id', $rent->floor_id)
            ->where(function ($query) use ($rent) {
                $query->where('rent_status', 0)
                    ->orWhere('id', $rent->unit_id);
            })
            ->get();

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
        $rent       = Rent::findOrFail($id);
        $unit_id    = $rent->unit_id;

        if ($unit_id == $request->unit_id) {
            $unit_status = false;
        } else {
            $unit_status = true;
        }

        $data               = $request->all();
        $data['user_id']    = Auth::user()->id;
        $data['rent_date']  = $start_date;
        $data['status']     = $request->status;
        $rent->update($data);

        $check_adjustemnt_info = RentAdjustment::where('rent_id', $rent->id)->count();
        if ($check_adjustemnt_info == 1) {
            $rent_adjustment                          = RentAdjustment::where('rent_id', $rent->id)->first();
            $rent_adjustment_data                     = $request->all();
            $rent_adjustment_data['user_id']          = Auth::user()->id;
            $rent_adjustment_data['adjustment_date']  = Carbon::now()->format('Y-m-d');
            $rent_adjustment_data['month']            = Carbon::parse($start_date)->format('m');
            $rent_adjustment_data['year']             = Carbon::parse($start_date)->format('Y');
            $rent_adjustment->update($rent_adjustment_data);
        }

        if ($unit_status == true && $request->status == 1) {

            $befor_unit_info                = Unit::find($unit_id);
            $befor_unit_info->rent_status   = 0;
            $befor_unit_info->save();

            $unit               = Unit::find($request->unit_id);
            $unit->rent_status  = 1; // status 0 meand avilable & 1 means rented.
            $unit->save();
        } else {
            $befor_unit_info                = Unit::find($unit_id);
            $befor_unit_info->rent_status   = 0;
            $befor_unit_info->save();
        }


        return redirect()->route('rent.index')->with('success', 'Rent record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rent                   = Rent::find($id);
        $existingRentCollection = DB::table('rent_collection_histories')->where('rent_id', $rent->id)->exists();
        $existingRentAdjust     = DB::table('rent_adjustments')->where('rent_id', $rent->id)->exists();
        $user_statements        = DB::table('user_statements')->where('rent_id', $rent->id)->exists();
        $existingRent           = DB::table('monthly_rents')->where('rent_id', $rent->id)->exists();

        if ($existingRentAdjust > 1) {
            return back()->with('failed', 'This rent is used in another table.');
        }

        if ($existingRent || $existingRentCollection || $user_statements) {
            return back()->with('failed', 'This rent is used in another table.');
        } else {


            $unit               = Unit::find($rent->unit_id);
            $unit->rent_status  = '0'; // status 0 meand avilable & 1 means rented.
            $unit->save();

            DB::table('rent_adjustments')->where('rent_id', $rent->id)->delete();
            $rent->delete();
            return back()->with('success', 'Deleted Successfully!');
        }
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
        RentAdjustment::create($validatedData);

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
