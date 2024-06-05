<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function index()
    {
        $vehicules = Vehicule::all();
        $mechanics = User::where('role', 'Mecanicien')->get();
        $repairs = Repair::all();

        return view('Admin.reparation', compact('vehicules', 'mechanics', 'repairs'));
    }

    public function show($id)
    {
        $repair = Repair::with(['vehicule', 'mecanic'])->findOrFail($id);
        return response()->json($repair);
    }

    public function delete(Request $request)
    {
        $repair = Repair::find($request->id);
        try {
            $repair->delete();
            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error']);
        }
    }

    public function createForm()
    {
        $vehicules = Vehicule::all();
        $mechanics = User::where('role', 'Mecanicien')->get();

        return view('Admin.repairs.create', compact('vehicules', 'mechanics'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'status' => 'required|string',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date',
            'vehiculeId' => 'nullable|integer|exists:vehicles,id',
            'mecanicId' => 'required|integer|exists:users,id',
            'mecanicNotes' => 'nullable|string',
            'clientNotes' => 'nullable|string'
        ]);

        Repair::create([
            'description' => $request->description,
            'status' => $request->status,
            'startDate' => now(),
            'endDate' => $request->endDate,
            'vehiculeId' => $request->vehiculeId,
            'mecanicId' => $request->mecanicId,
            'mecanicNotes' => $request->mecanicNotes,
            'clientNotes' => $request->clientNotes
        ]);

        return redirect()->route('admin.repairs')->with('success', 'Réparation créée avec succès.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date|after_or_equal:startDate',
            'description' => 'nullable|string|max:255',
            'status' => 'required|string|in:in_progress,pending,completed',
            'vehiculeId' => 'required|exists:vehicles,id',
            'mecanicId' => 'required|exists:users,id',
            'mecanicNotes' => 'nullable|string',
            'clientNotes' => 'nullable|string',
        ]);

        $repair = Repair::findOrFail($request->id);
        $repair->update([
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'description' => $request->description,
            'status' => $request->status,
            'vehiculeId' => $request->vehiculeId,
            'mecanicId' => $request->mecanicId,
            'mecanicNotes' => $request->mecanicNotes,
            'clientNotes' => $request->clientNotes,
        ]);

        return redirect()->route('admin.repairs')->with('success', 'Réparation mise à jour avec succès.');
    }
}
