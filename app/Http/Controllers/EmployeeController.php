<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Transaction;
use App\Account;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
    public function __construct() {
        $this->middleware('permission:employees-create')->only(['create', 'store']);
        $this->middleware('permission:employees-read')->only(['index', 'show']);
        $this->middleware('permission:employees-update')->only(['edit', 'update']);
        $this->middleware('permission:employees-delete')->only('destroy');
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $employees = Employee::all()->except([auth()->user()->employee->id]);
        return view('dashboard.employees.index', compact('employees'));
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
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
            'name'      => 'required | string | max:45',
            'phone'     => 'required | string | max:30',
            'address'   => 'required | string | max:255',
        ]);
        
        $employee = Employee::create($request->all());
        
        session()->flash('success', 'تمت اضافة الموظف بنجاح');
        
        return back();
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Employee  $employee
    * @return \Illuminate\Http\Response
    */
    public function show(Request $request, Employee $employee)
    {
        $year = isset($request->year) ? $request->year : date('Y');
        $month = isset($request->month) ? $request->month < 10 ? '0' . $request->month : $request->month : date('m');
        $fullMonth = $year . '-' . $month;
        $transactions = $employee->monthlyTransactions($fullMonth);
        $debts = $transactions->where('type', Transaction::TYPE_DEBT)->groupBy('safe_id');
        $bonuses = $transactions->where('type', Transaction::TYPE_BONUS)->groupBy('safe_id');
        $deducations = $transactions->where('type', Transaction::TYPE_DEDUCATION)->groupBy('safe_id');
        $totalDebts = ['payed' => 0, 'remain' => 0, 'total' => 0];
        $totalDeducations = ['payed' => 0, 'remain' => 0, 'total' => 0];
        $totalBonuses = ['payed' => 0, 'remain' => 0, 'total' => 0];
        $net = $employee->salary;
        foreach ($debts as $debt) {
            if($debt->first()->safe){
                $totalDebts['payed'] += $debt->sum('amount');
            }else{
                $totalDebts['remain'] += $debt->sum('amount');
                $net -= $debt->sum('amount');
            }
            $totalDebts['total'] += $debt->sum('amount');
        }
        foreach ($bonuses as $bonus) {
            if($bonus->first()->safe){
                $totalBonuses['payed'] += $bonus->sum('amount');
            }else{
                $totalBonuses['remain'] += $bonus->sum('amount');
                $net += $debt->sum('amount');
            }
            $totalBonuses['total'] += $bonus->sum('amount');
        }
        foreach ($deducations as $deducation) {
            if($deducation->first()->safe){
                $totalDeducations['payed'] += $deducation->sum('amount');
            }else{
                $totalDeducations['remain'] += $deducation->sum('amount');
                $net -= $debt->sum('amount');
            }
            $totalDeducations['total'] += $deducation->sum('amount');
        }
        return view('dashboard.employees.show', compact('employee', 'totalDebts', 'totalBonuses', 'totalDeducations', 'year', 'fullMonth', 'month'));
        
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Employee  $employee
    * @return \Illuminate\Http\Response
    */
    public function edit(Employee $employee)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Employee  $employee
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'      => 'required | string | max:45',
            'phone'     => 'required | string | max:20',
            'address'   => 'required | string | max:255',
        ]);
        
        $employee->update($request->all());
        
        session()->flash('success', 'تمت العملية بنجاح');
        
        return back();
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Employee  $employee
    * @return \Illuminate\Http\Response
    */
    public function destroy(Employee $employee)
    {
        if(count($employee->user->bills)) {
            session()->flash('error', 'لا يمكن حذف الموظف');
            return redirect()->route('users.index');
        }else {
            $employee->user->roles()->detach();
    
            $employee->user->permissions()->detach();
    
            $employee->user->delete();

            $employee->delete();
    
            session()->flash('success', 'تمت العملية بنجاح');
    
    
            return redirect()->route('employees.index');
        }
    }
}