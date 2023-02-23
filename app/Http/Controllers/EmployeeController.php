<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\EmployeeAddRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Employee;
use App\Models\Company;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $employees = Employee::with(['company_link'])->get();
        return  view('employee.list', [
            'employees' => $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $companies = Company::select(['id' , 'name'])->get();
        return view('employee.add', [
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeAddRequest $request): RedirectResponse
    {
        $employee = new Employee;
        $employee->first_name = $request->em_first_name;
        $employee->last_name = $request->em_last_name;
        $employee->email  = $request->em_email;
        $employee->phone  = $request->em_phone;
        $employee->company   = $request->em_company;

        try {
            $employee->save();
        } catch (\Throwable $th) {
            return Redirect::route('employee.create')->with('status_fail', 'employee-created');
        }

        return Redirect::route('employee.create')->with('status_ok', 'employee-created');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $companies = Company::select(['id' , 'name'])->get();
        $employee = Employee::find( $id);
        return view('employee.edit', [
            'employee' => $employee,
            'companies' => $companies
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeUpdateRequest $request, string $id): RedirectResponse
    {
        $employee = Employee::find($id);
        $employee->first_name = $request->em_first_name;
        $employee->last_name = $request->em_last_name;
        $employee->email  = $request->em_email;
        $employee->phone  = $request->em_phone;
        $employee->company   = $request->em_company;

        try {
            $employee->save();
        } catch (\Throwable $th) {
            return Redirect::route('employee.view',$id)->with('status_fail', 'employee-updated');
        }

        return Redirect::route('employee.view',$id)->with('status_ok', 'employee-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Employee::find($id);
        
        try {
            $company->forceDelete();
        } catch (\Throwable $th) {
            return Redirect::route('employee.view',$id)->with('status_fail', 'company-updated');
        }

        return Redirect::route('employee.list')->with('status_ok', 'company-deleted');
    }
}
