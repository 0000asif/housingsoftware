<?php

namespace App\Http\Controllers;

use App\Models\Renter;
use App\Models\Remainder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class RenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $renters = Renter::all();
        return view('renter.index', compact('renters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('renter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'required|string|unique:renters,phone',
            'gender'        => 'required|string|in:male,female,other',
            'birth_date'    => 'nullable|date',
            'nid'           => 'required',
            'regnumber'     => 'nullable|string|max:255',
            'occupation'    => 'required|string|max:255',
            'institute'     => 'nullable|string|max:255',
            'other_info'    => 'nullable|string',
            'address'       => 'required|string',
            'note'          => 'nullable',
            'pdf_file'      => 'nullable',
        ]);

        // if ($request->hasFile('photo')) {
        //     $logoName = time() . '.' . $request->photo->extension();
        //     $request->photo->move(public_path('image/photoGalery'), $logoName);
        // }

        //add pdf file to the folder and store also database
        if ($request->hasFile('pdf_file')) {
            $pdfName = time() . '.' . $request->pdf_file->extension();
            $request->pdf_file->move(public_path('pdf/renter'), $pdfName);
            $validated['pdf_file'] = $pdfName;
        }
        $birth_date = date('Y-m-d', strtotime($request->birth_date));
        $validated['status'] = '1';
        $validated['user_id'] = Auth::user()->id;
        $validated['birth_date'] = $birth_date;

        Renter::create($validated);

        return redirect()->back()->with('success', 'Renter created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Renter  $renter
     * @return \Illuminate\Http\Response
     */
    public function show(Renter $renter)
    {
        return view('renter.show', compact('renter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Renter  $renter
     * @return \Illuminate\Http\Response
     */
    public function edit(Renter $renter)
    {
        return view('renter.edit', compact('renter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Renter  $renter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Renter $renter)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'nid' => 'required|string|unique:renters,nid,' . $renter->id,
            'phone' => 'required|string',
            'gender' => 'required|string|in:male,female,other',
            'birth_date' => 'nullable|date',
            'regnumber' => 'nullable|string|max:255',
            'occupation' => 'required|string|max:255',
            'institute' => 'nullable|string|max:255',
            'other_info' => 'nullable|string',
            'address' => 'required|string',
            'status' => 'required',
            'note' => 'nullable',
            'pdf_file' => 'nullable',
        ]);

        $birth_date = date('Y-m-d', strtotime($request->birth_date));
        $validated['user_id'] = Auth::user()->id;
        $validated['birth_date'] = $birth_date;

        // Check if the PDF file has been uploaded
        if ($request->hasFile('pdf_file')) {
            // Delete the old file if it exists
            if ($renter->pdf_file && file_exists(public_path('pdf/renter/' . $renter->pdf_file))) {
                unlink(public_path('pdf/renter/' . $renter->pdf_file));
            }

            // Upload the new file
            $pdfName = time() . '.' . $request->pdf_file->extension();
            $request->pdf_file->move(public_path('pdf/renter'), $pdfName);
            $validated['pdf_file'] = $pdfName; // Update with the new file name
        }

        $renter->update($validated);

        return redirect()->route('renter.index')->with('success', 'Renter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Renter  $renter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Renter $renter)
    {
        $isUsedInRents = DB::table('rents')->where('renter_id', $renter->id)->exists();
        $isUsedNote = Remainder::where('renter_id', $renter->id)->exists();
        if ($isUsedInRents || $isUsedNote) {
            return redirect()->route('renter.index')
                ->with('failed', 'Cannot delete this renter as it is linked to other records.');
        }

        $renter->delete();
        return redirect()->route('renter.index')->with('success', 'Renter Deleted successfully.');
    }

    public function downloadPdf($file)
    {
        $filePath = public_path('pdf/renter/' . $file);

        if (file_exists($filePath)) {
            return Response::download($filePath, $file, [
                'Content-Type' => 'application/pdf',
            ]);
        } else {
            abort(404, 'File not found.');
        }
    }
}
