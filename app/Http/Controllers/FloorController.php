<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $floors = Floor::with('house')->get();
        return view('floor.index', compact('floors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $house = House::where('status', '1')->get();
        return view('floor.create', compact('house'));
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
            'name' => 'required',
            'info' => 'nullable',
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['status'] = '1';

        Floor::create($data);
        return redirect()->back()->with('success', 'Operation completed successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function show(Floor $floor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $house = House::where('status', '1')->get();
        $info = Floor::find($id);
        // dd($leads);  
        return view('floor.edit', compact('info', 'house'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'house_id' => 'required',
            'name' => 'required',
            'info' => 'nullable',
            'status' => 'required',
        ]);
        $floor = Floor::find($id);
        // dd($request->all());

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $floor->update($data);
        return redirect()->back()->with('success', 'Operation completed successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $floor = Floor::find($id);
        $isUsedInFloor = DB::table('units')->where('floor_id', $floor->id)->exists();


        if ($isUsedInFloor) {
            return redirect()->back()
                ->with('error', 'Cannot delete this it is linked to other records.');
        }

        $floor->delete();
        return redirect()->back()->with('success', 'Operation completed successfully!');
    }
}
