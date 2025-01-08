<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Routine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routines = Routine::with('batch')->get();
        return view('Routine.index', compact('routines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $batchs = Batch::get();
        return view('Routine.create', compact('batchs'));
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
            'title' => 'required',
            'batch_id' => 'required|exists:batches,id',
            'file' => 'required',
            'description' => 'nullable',
            'status' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // Handle file uploads
        if ($request->hasFile('file')) {
            $logoName = time() . '_file.' . $request->file->extension();
            $request->file->move(public_path('image/routine'), $logoName);
            $data['file'] = $logoName;
        }

        Routine::create($data);
        return redirect()->back()->with('success', 'Routine Added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function show(Routine $routine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function edit(Routine $routine)
    {
        $batchs = Batch::get();
        return view('Routine.edit', compact('batchs', 'routine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Routine $routine)
    {
        $file = $routine->file;
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'batch_id' => 'required|exists:batches,id',
            'file' => 'nullable',
            'description' => 'nullable',
            'status' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // Handle file uploads
        if ($request->hasFile('file')) {
            $logoName = time() . '_file.' . $request->file->extension();
            $request->file->move(public_path('image/routine'), $logoName);
            $data['file'] = $logoName;
            if ($file) {
                File::delete(public_path('image/routine') . '/' . $file);
            }
        }


        $routine->update($data);
        return redirect()->back()->with('success', 'Routine Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Routine $routine)
    {
        $file = $routine->file;
        $routine->delete();
        if ($file) {
            File::delete(public_path('image/routine') . '/' . $file);
        }
        return redirect()->back()->with('success', 'Routine Deleted successfully');

    }
}
