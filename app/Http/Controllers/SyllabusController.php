<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Subject;
use App\Models\Syllabus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $syllabus = Syllabus::with('batch', 'subject')->get();
        return view('syllabus.index', compact('syllabus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $batchs = Batch::get();
        $subjects = Subject::get();
        return view('syllabus.create', compact('batchs', 'subjects'));
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
            'subject_id' => 'required|exists:subjects,id',
            'file' => 'required',
            'description' => 'nullable',
            'status' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // Handle file uploads
        if ($request->hasFile('file')) {
            $logoName = time() . '_file.' . $request->file->extension();
            $request->file->move(public_path('image/syllabus'), $logoName);
            $data['file'] = $logoName;
        }

        Syllabus::create($data);
        return redirect()->back()->with('success', 'syllabus Added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Syllabus  $syllabus
     * @return \Illuminate\Http\Response
     */
    public function show(Syllabus $syllabus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Syllabus  $syllabus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $syllabus = Syllabus::find($id);
        // dd($syllabus);
        $batchs = Batch::get();
        $subjects = Subject::get();
        return view('syllabus.edit', compact('batchs', 'syllabus', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Syllabus  $syllabus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $syllabus = Syllabus::find($id);

        $file = $syllabus->file;
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'batch_id' => 'required|exists:batches,id',
            'subject_id' => 'required|exists:subjects,id',
            'file' => 'nullable',
            'description' => 'nullable',
            'status' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // Handle file uploads
        if ($request->hasFile('file')) {
            $logoName = time() . '_file.' . $request->file->extension();
            $request->file->move(public_path('image/syllabus'), $logoName);
            $data['file'] = $logoName;
            if ($file) {
                File::delete(public_path('image/syllabus') . '/' . $file);
            }
        }

        $syllabus->update($data);
        return redirect()->back()->with('success', 'syllabus Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Syllabus  $syllabus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $syllabus = Syllabus::find($id);
        $file = $syllabus->file;
        $syllabus->delete();
        if ($file) {
            File::delete(public_path('image/syllabus') . '/' . $file);
        }
        return redirect()->back()->with('success', 'syllabus Deleted successfully');

    }
}
