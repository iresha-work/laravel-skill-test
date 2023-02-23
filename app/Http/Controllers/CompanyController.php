<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CompanyAddRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use Storage;
use App\Notifications\NewCompany;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $companies = Company::all();
        return  view('company.list', [
            'companies' => $companies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('company.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyAddRequest $request): RedirectResponse
    {
        $company = new Company;
        $company->name = $request->company_name;
        $company->email = $request->company_email;
        $company->website = $request->company_web;

        try {
            if ($request->hasFile('company_logo')) {
                $path = $request->file('company_logo')->store(
                    '', 'public'
                );
                $company->logo = $path;
            }
            $company->save();
            $user = \Auth::user();
            $user->notify(new NewCompany($company));
        } catch (\Throwable $th) {
            return Redirect::route('company.create')->with('status_fail', 'company-created');
        }

        return Redirect::route('company.create')->with('status_ok', 'company-created');
       
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
        $company = Company::find( $id);
        return view('company.edit', [
            'company' => $company,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, string $id): RedirectResponse
    {
        $company = Company::find($id);
        $company->name = $request->company_name;
        $company->email = $request->company_email;
        $company->website = $request->company_web;

        try {
            if ($request->hasFile('company_logo')) {
                $path = $request->file('company_logo')->store(
                    '', 'public'
                );
                $company->logo = $path;
            }
            $company->save();
            
        } catch (\Throwable $th) {
            return Redirect::route('company.view',$id)->with('status_fail', 'company-updated');
        }

        return Redirect::route('company.view',$id)->with('status_ok', 'company-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);
        
        try {
            $company->forceDelete();
        } catch (\Throwable $th) {
            return Redirect::route('company.view',$id)->with('status_fail', 'company-updated');
        }

        return Redirect::route('company.list')->with('status_ok', 'company-deleted');
    }
}
