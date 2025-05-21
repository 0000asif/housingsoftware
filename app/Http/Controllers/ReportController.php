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
use Symfony\Component\CssSelector\Node\FunctionNode;

class ReportController extends Controller
{
    // -------------- expense controller -------------
    public function ExportReport()
    {
        // $staffs = Project::get();
        $category = IncomeExpenceCategory::get();
        $all_house = House::get();
        return view('reports.expense-report', compact('category', 'all_house'));
    }
    public function GetExpenseReport(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $from_date      = Carbon::parse($request->from_date)->startOfDay();
        $to_date        = Carbon::parse($request->to_date)->endOfDay();
        $category_id    = $request->category_id;
        $project_id     = $request->project_id;

        $query = IncomeExpence::whereBetween('date', [$from_date, $to_date])->where('type', 2);

        if ($category_id) {
            $query->where('income_expence_category_id', $category_id);
        }

        if ($project_id) {
            $query->where('house_id', $project_id);
        }

        $expense_report = $query->get();

        return view('reports.view-expense', compact('expense_report', 'from_date', 'to_date', 'category_id'));
    }

    // -------------- Income controller -------------
    public function IncomeReport()
    {
        $category = IncomeExpenceCategory::get();
        $all_house = House::get();
        return view('reports.income-report', compact('category', 'all_house'));
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
        $house_id = $request->house_id;

        $query = IncomeExpence::whereBetween('date', [$from_date, $to_date])->where('type', 1);

        if ($category_id) {
            $query->where('income_expence_category_id', $category_id);
        }
        if ($house_id) {
            $query->where('house_id', $house_id);
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
        $all_house = House::get();
        // dd($staffs);
        return view('reports.collection_history', compact('staffs', 'all_house'));
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
        $project_id = $request->project_id;

        $query = RentCollectionHistory::with('monthly_rent')
            ->whereBetween('payment_date', [$from_date, $to_date]);

        if (!empty($staff_data)) {
            $query->where('rent_id', $staff_data);
        }

        if (!empty($project_id)) {
            $query->whereHas('rent', function ($q) use ($project_id) {
                $q->where('house_id', $project_id);
            });
        }

        $salary_report = $query->get();

        // Debugging Logs

        return view(
            'reports.view-collection_history',
            compact('salary_report', 'from_date', 'to_date', 'staff_data', 'project_id')
        );
    }


    // -------------- Rent due controller -------------
    public function dueReport()
    {
        $staffs = Rent::with('renter')->get();
        $all_house = House::get();
        // dd($staffs);
        return view('reports.due_history', compact('staffs', 'all_house'));
    }

    public function GetdueReport(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'month' => 'required',
            'staff_data' => 'nullable|integer',
        ]);

        $year = $request->year;
        $month = $request->month;
        $staff_data = $request->staff_data;
        $project_id = $request->project_id;
        // dd($request->staff_data);

        $query = MonthlyRent::with('rent')
            ->where('year', $year);

        if (!empty($month)) {
            $query->where('month', $month);
        }

        if (!empty($staff_data)) {
            $query->where('rent_id', $staff_data);
        }

        if (!empty($project_id)) {
            $query->whereHas('rent', function ($q) use ($project_id) {
                $q->where('house_id', $project_id);
            });
        }

        $salary_report = $query->get();

        return view('reports.view_due', compact('salary_report', 'month', 'year', 'staff_data', 'project_id'));
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
        $project_id = $request->project_id;
        // dd($year, $month, $status);

        $query = MonthlyRent::with('rent')
            ->where('year', $year);

        if (!empty($month)) {
            $query->where('month', $month);
        }
        if (!empty($status)) {
            $query->where('status', $status);
        }

        if (!empty($project_id)) {
            $query->whereHas('rent', function ($q) use ($project_id) {
                $q->where('house_id', $project_id);
            });
        }

        $rent_report = $query->get();

        return view('reports.view_rent', compact('rent_report', 'year', 'month', 'status', 'project_id'));
    }
}
