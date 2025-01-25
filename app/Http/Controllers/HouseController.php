<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::all();
        return view('house.index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('house.create');
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
            'house_name' => 'required',
            'owner_name' => 'nullable',
            'contract_number' => 'nullable',
            'holding_number' => 'nullable',
            'address' => 'required',
            'land_info' => 'nullable',
            'opening_balance' => 'required',
            'confirm_balance' => 'required',
            'document' => 'nullable',
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // dd($request->opening_balance);

        $opening_balance = $request->opening_balance;
        $confirm_balance = $request->confirm_balance;
        if ($opening_balance == $confirm_balance) {
            $balance = $opening_balance;
        } else {
            return redirect()->back()->with('failed', 'Opening balance and confirm balance not match');
        }

        if ($request->document) {
            $house_name = $request->house_name . "_" . time() . "." . $request->document->extension();
            $request->document->move(public_path('images/house/'), $house_name);
            $data['document'] = $house_name;
        }
        $data['opening_balance'] = $balance;
        $data['status'] = '1';

        House::create($data);
        return redirect()->back()->with('success', 'Operation complete successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = House::find($id);
        return view('house.show', compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = House::find($id);
        // dd($leads);  
        return view('house.edit', compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'house_name' => 'required',
            'owner_name' => 'nullable',
            'contract_number' => 'nullable|numeric',
            'address' => 'required',
            'status' => 'required',
            'land_info' => 'nullable',
            'document' => 'nullable',
        ]);

        $house = House::find($id);
        // dd($request->all());

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['status'] = $request->status;

        if ($request->document) {

            if ($house->document) {
                $image_2_file = "public/images/house/" . $house->document;
                if (file_exists($image_2_file)) {
                    unlink($image_2_file);
                }
            }
            $house_name = $request->house_name . "_" . time() . "." . $request->document->extension();
            $request->document->move(public_path('images/house/'), $house_name);
            $data['document'] = $house_name;
        }


        $house->update($data);
        return redirect()->back()->with('success', 'Operation completed successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $house = House::find($id);

        $isUsedInFloor = DB::table('floors')->where('house_id', $house->id)->exists();
        $isUsedInUnit = DB::table('units')->where('house_id', $house->id)->exists();
        $isUsedInRent = DB::table('rents')->where('house_id', $house->id)->exists();

        if ($isUsedInFloor || $isUsedInUnit || $isUsedInRent) {
            return back()
                ->with('error', 'Cannot delete this it is linked to other records.');
        }
        $house->delete();
        if ($house->document) {
            $image_2_file = "public/images/house/" . $house->document;
            if (file_exists($image_2_file)) {
                unlink($image_2_file);
            }
        }
        return back()->with('success', 'Operation completed successfully!');
    }
}
