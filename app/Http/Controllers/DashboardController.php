<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        if ($role == 'Administrateur') {
            return view('Admin.home');
        } elseif ($role == 'Mecanicien') {
            return view('Mecanicien.home');
        } elseif ($role == 'Client') {
            return view('Client.home');
        }
        return redirect()->route('login');
    }

    public function admin()
    {
        return view('Admin.home');
    }

    public function mechanic()
    {
        return view('Mecanicien.home');
    }

    public function client()
    {
        return view('Mecanicien.home');
    }
}
