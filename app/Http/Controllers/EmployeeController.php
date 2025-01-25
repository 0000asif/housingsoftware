<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\SalaryRecord;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $desigantion = Designation::all();
        return view('employee.create', compact('desigantion'));
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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|min:10',
            'image' => 'required|image',
            'designation_id' => 'required',
            'join_date' => 'required',
            'salary' => 'required',
        ]);
        // dd($request->all());
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $date = Carbon::parse($request->input('join_date'));

        $month = $date->month;
        $year = $date->year;

        $data['join_date'] = $date;
        $data['join_month'] = $month;
        $data['join_year'] = $year;


        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/employee'), $imageName);
            $data['image'] = $imageName;
        }
        Employee::create($data);

        return redirect()->route('employee.index')->with('success', 'Employee Created Success');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Employee::find($id);
        $positions = Designation::all();
        return view('employee.edit', compact('member', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $employee = Employee::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|min:10',
            'image' => 'nullable|image',
            'designation_id' => 'required',
        ]);

        // dd($request->all());

        $data = $request->all();
        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            $image_path = public_path("admin/employee/") . $employee->image;
            if (file_exists($image_path)) {
                @unlink($image_path);
            }

            // Upload the new image and update the image name
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/employee'), $imageName);
            $data['image'] = $imageName;
        }
        $employee->update($data);

        return redirect()->route('employee.index')->with('success', 'Employee Updated Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $employee = Employee::find($id);
        $employeeExists = SalaryRecord::where('employee_id', $employee->id)->exists();
        if ($employeeExists) {
            return back()->with('failed', 'Employee Exists Salary Record');
        }
        $employee->delete();

        $image_path = public_path("admin/employee/") . $employee->image;
        if (file_exists($image_path)) {
            @unlink($image_path);
        }
        return redirect()->route('employee.index')->with('success', 'Employee Deleted Successfully');
    }
}
