<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show(){
        return view('dashboard',[
            'records' => Company::paginate(10),
            'model' => 'company'
        ]);
    }
}
