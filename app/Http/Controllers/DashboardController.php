<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function about()
    {
        return view('dashboard.about');
    }

    public function service()
    {
        return view('dashboard.service');
    }

    public function dokter()
    {
        return view('dashboard.dokter');
    }

    public function contact()
    {
        return view('dashboard.contact');
    }
}
