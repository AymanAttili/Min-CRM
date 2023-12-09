<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(10);

        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {

        $company = $request->validate([
            'name' => ['required','max:255',Rule::unique('companies')],
            'email' => ['nullable','email',Rule::unique('companies')],
            'logo' => 'nullable|max:100',
            'website_link' => ['nullable',Rule::unique('companies')]
        ]);


        if ($request->hasFile('logo')) {
            Storage::put($request->get('logo'), $request->get('logo'));
        }

        Company::factory()->create($company);

        return redirect()->route('admin.show')->with('success', 'Company created successfully!');
    }

    public function show(Company $company)
    {
        return view('company.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('company.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
//        ddd($request->all());
        $request->validate([
            'name' => ['required','max:255',Rule::unique('companies')->ignore($company)],
            'email' => ['nullable','email',Rule::unique('companies')->ignore($company)],
            'logo' => 'nullable|image|dimensions:max_width=100,max_height=100',
            'website_link' => ['nullable',Rule::unique('companies')->ignore($company)]
        ]);

        $company->update($request->all());

        return redirect()->route('admin.show')->with('success', 'company updated successfully!');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('admin.show')->with('success', 'company deleted successfully!');
    }
}
