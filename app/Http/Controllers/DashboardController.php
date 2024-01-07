<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LetterType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $staffTotal = User::where('role', 'staff')->count();
        $guruTotal = User::where('role', 'guru')->count();
        $klasifikasiTotal = LetterType::all()->count();
        return view('dashboard', compact('guruTotal', 'staffTotal','klasifikasiTotal'));
    }
}
