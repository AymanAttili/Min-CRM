<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EmployeeControler extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {

        $request->merge(['company_id' => Auth::user()->employee->company_id]);

        $employee = $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'company_id' => ['required', Rule::exists('companies', 'id')],
            'phone' => ['max:14']
        ]);

        Employee::factory()->create($employee);

        return redirect()->route('user.show')->with('success', 'Employee created successfully!');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {

        $employee->user->update(['email' => $request->input('email')]);


        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255']
        ]);


        $employee->update($request->except(['email']));

        return redirect()->route('user.show')->with('success', 'Employee updated successfully!');
    }

    public function destroy(Employee $employee)
    {
        optional($employee->user)->delete();

        $employee->delete();

        return redirect()->route('user.show')->with('success', 'Employee deleted successfully!');
    }
}
