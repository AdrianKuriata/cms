<?php

namespace Akuriatadev\Wordit\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('wordit::dashboard.index');
    }
}
