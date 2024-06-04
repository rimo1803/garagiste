<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function repairlist()
    {
      
        $repairs = Repair::all();
        return view('admin.repairlist', compact('repairs'));
    }
}
