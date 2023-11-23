<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'require|max:255',
            'last_name' => 'require|max:255',
        ]);
        Employee::created($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee has join');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Employee $employee)
    {
        $employee = Employee::find($id);
        return view('employees.show', compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Employee $employee)
    {
        $employee = Employee::find($id);
        return view('employees.edit', compact('employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, Employee $employee)
    {
        $request->validate([
            'first_name' => 'require|max:255',
            'last_name' => 'require|max:255',
        ]);
        $employee = Employee::find($id);
        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Employee $employee)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('deleted', 'Employee info deleted');
    }
}
