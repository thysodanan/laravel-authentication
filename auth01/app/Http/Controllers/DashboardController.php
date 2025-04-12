<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showTeacher(){
        return view('teacher');
    }
    public function showStudent(){
        return view('student');
    }
    public function showDashboard(){
        return view('dashboard');
    }
}
