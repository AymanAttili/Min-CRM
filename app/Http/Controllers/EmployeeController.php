<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
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

        if($request->has('email')) {
            $userController = new UserController();
            $userRequest = Request::create('/user', 'POST', $request->only(['email', 'password', 'password_confirmation']));
            $user_id = $userController->store($userRequest);

            $request->merge([
                'user_id' => $user_id,
            ]);
        }


        $request->merge([
            'company_id' => Auth::user()->employee->company_id,
            ]);

        $employee = $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'company_id' => ['required', Rule::exists('companies', 'id')],
            'user_id' => ['nullable', Rule::exists('users', 'id')],
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
        if($request->has('email')) {
            $userController = new UserController();
            if(!$employee->user) {
                $userRequest = Request::create('/user', 'POST', $request->only(['email', 'password', 'password_confirmation']));
                $user_id = $userController->store($userRequest);

                $request->merge([
                    'user_id' => $user_id,
                ]);
            }
            else{
                $userRequest = Request::create('/user', 'PUT', $request->only(['email', 'password', 'password_confirmation']));
                $userController->update($userRequest, $employee->user);
            }
        }



        $updatedData = $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'user_id' => ['nullable', Rule::exists('users', 'id')],
            'phone' => ['nullable']
        ]);


        $employee->update($updatedData);

        return redirect()->route('user.show')->with('success', 'Employee updated successfully!');
    }

    public function destroy(Employee $employee)
    {
        optional($employee->user)->delete();

        $employee->delete();

        return redirect()->route('user.show')->with('success', 'Employee deleted successfully!');
    }
}
