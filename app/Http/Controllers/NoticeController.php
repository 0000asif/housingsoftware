<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::with('batch')->get();
        return view('notice.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $batchs = Batch::get();
        return view('notice.create', compact('batchs'));
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
            $request->file->move(public_path('image/notice'), $logoName);
            $data['file'] = $logoName;
        }

        Notice::create($data);
        return redirect()->back()->with('success', 'Notice Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        $batchs = Batch::get();
        return view('notice.edit', compact('batchs', 'notice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
        $file = $notice->file;
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
            $request->file->move(public_path('image/notice'), $logoName);
            $data['file'] = $logoName;
            if ($file) {
                File::delete(public_path('image/notice') . '/' . $file);
            }
        }
        // Handle file uploads
        // if ($request->hasFile('logo')) {
        //     $logoName = time() . '_logo.' . $request->logo->extension();
        //     $request->logo->move(public_path('image/setting'), $logoName);
        //     $setting->update(['logo' => $logoName]);
        //     if ($currentLogo) {
        //         File::delete(public_path('image/setting') . '/' . $currentLogo);
        //     }
        // }


        $notice->update($data);
        return redirect()->back()->with('success', 'Notice Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        $file = $notice->file;
        $notice->delete();
        if ($file) {
            File::delete(public_path('image/notice') . '/' . $file);
        }
        return redirect()->back()->with('success', 'Notice Deleted successfully');
    }
}
