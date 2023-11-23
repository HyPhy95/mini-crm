<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'require|max:255',
        ]);
        Company::created($request->all());
        return redirect()->route('companies.index')->with('success', 'Company has created.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Company $company)
    {
        $company = Company::find($id);
        return view('companies.show', compact('companies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Company $company)
    {
        $company = Company::find($id);
        return view('companies.edit', compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, Company $company)
    {
        $request->validate([
            'name' => 'require|max:255',
        ]);
        $company = Company::find($id);
        $company->update($request->all());
        return redirect()->route('companies.index')->with('success', 'Company has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Company $company)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect()->route('companies.index')->with('deleted', 'Company has been deleted.');
    }
}
