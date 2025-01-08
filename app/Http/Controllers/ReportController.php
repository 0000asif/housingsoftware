<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\House;
use App\Models\Leads;
use App\Models\Renter;
use App\Models\Project;
use App\Models\Employee;
use App\Models\MonthlyRent;
use App\Models\SalaryRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\IncomeExpence;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\IncomeExpenceCategory;
use App\Models\RentCollectionHistory;

class ReportController extends Controller
{
    // -------------- expense controller -------------
    public function ExportReport()
    {
        // $staffs = Project::get();
        $category = IncomeExpenceCategory::get();
        return view('reports.expense-report', compact('category'));
    }
    public function GetExpenseReport(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $from_date = Carbon::parse($request->from_date)->startOfDay();
        $to_date = Carbon::parse($request->to_date)->endOfDay();
        $category_id = $request->category_id;

        $query = IncomeExpence::whereBetween('date', [$from_date, $to_date])->where('type', 2);

        if ($category_id) {
            $query->where('income_expence_category_id', $category_id);
        }

        $expense_report = $query->get();

        return view('reports.view-expense', compact('expense_report', 'from_date', 'to_date', 'category_id'));
    }

    // -------------- Income controller -------------
    public function IncomeReport()
    {
        // $staffs = Project::get();
        $category = IncomeExpenceCategory::get();
        return view('reports.income-report', compact('category'));
    }
    public function GetIncomeReport(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $from_date = Carbon::parse($request->from_date)->startOfDay();
        $to_date = Carbon::parse($request->to_date)->endOfDay();
        $category_id = $request->category_id;

        $query = IncomeExpence::whereBetween('date', [$from_date, $to_date])->where('type', 1);

        if ($category_id) {
            $query->where('income_expence_category_id', $category_id);
        }

        $expense_report = $query->get();

        return view('reports.view-income', compact('expense_report', 'from_date', 'to_date', 'category_id'));
    }


    // -------------- Salary controller -------------
    public function SalaryReport()
    {
        $staffs = Employee::get();

        return view('reports.salaryrecord', compact('staffs'));
    }

    public function GetsalaryReport(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $staff_data = $request->staff_data;

        $query = SalaryRecord::with('staff')->whereBetween('payment_date', [$from_date, $to_date]);

        if ($staff_data) {
            $query->where('employee_id', $staff_data);
        }
        $salary_report = $query->get();

        return view('reports.view-salary-report', compact('salary_report', 'from_date', 'to_date', 'staff_data'));
    }

    // -------------- Rent Colleciton Report -------------
    public function collectionReport()
    {
        $staffs = Rent::with('renter')->get();
        // dd($staffs);
        return view('reports.collection_history', compact('staffs'));
    }


    public function GetcollectionReport(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'staff_data' => 'nullable|integer',
        ]);

        $from_date = Carbon::parse($request->from_date)->startOfDay();
        $to_date = Carbon::parse($request->to_date)->endOfDay();
        $staff_data = $request->staff_data;

        $query = RentCollectionHistory::with('monthly_rent')
            ->whereBetween('payment_date', [$from_date, $to_date]);

        if (!empty($staff_data)) {
            $query->where('rent_id', $staff_data);
        }

        $salary_report = $query->get();

        // Debugging Logs
        Log::info('Collection Report Query', [
            'from_date' => $from_date,
            'to_date' => $to_date,
            'staff_data' => $staff_data,
            'result_count' => $salary_report->count(),
        ]);

        return view(
            'reports.view-collection_history',
            compact('salary_report', 'from_date', 'to_date', 'staff_data')
        );
    }


    // -------------- Rent due controller -------------
    public function dueReport()
    {
        $staffs = Rent::with('renter')->get();
        // dd($staffs);
        return view('reports.due_history', compact('staffs'));
    }

    public function GetdueReport(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'staff_data' => 'nullable|integer',
        ]);

        $from_date = Carbon::parse($request->from_date)->startOfDay();
        $to_date = Carbon::parse($request->to_date)->endOfDay();
        $staff_data = $request->staff_data;
        // dd($request->staff_data);

        $query = MonthlyRent::with('rent')
            ->whereBetween('date', [$from_date, $to_date]);

        if (!empty($staff_data)) {
            $query->where('rent_id', $staff_data);
        }

        $salary_report = $query->get();

        return view('reports.view_due', compact('salary_report', 'from_date', 'to_date', 'staff_data'));
    }

    // -------------- Rent REnt controller -------------
    public function rentReport()
    {


        $houses = House::all();
        $staffs = Rent::with('renter')->get();
        // dd($staffs);
        return view('reports.rent_history', compact('staffs', 'houses'));
    }

    public function GetrentReport(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'month' => 'nullable',
            'status' => 'nullable|integer',
        ]);

        $year = $request->year;
        $month = $request->month;
        $status = $request->status;
        // dd($year, $month, $status);

        $query = MonthlyRent::with('rent')
            ->where('year', $year);

        if (!empty($month)) {
            $query->where('month', $month);
        }
        if (!empty($status)) {
            $query->where('status', $status);
        }

        $rent_report = $query->get();

        return view('reports.view_rent', compact('rent_report', 'year', 'month', 'status'));
    }
}
