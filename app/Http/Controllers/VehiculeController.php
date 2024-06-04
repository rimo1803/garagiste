<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    public function welcomeee()
    {
        $vehicules = Vehicule::all();
        return view('Admin.vehicule', compact('vehicules'));
    }

    public function addVehicule(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'mark' => 'required',
            'model' => 'required',
            'fuelType' => 'required',
            'registration' => 'required',
            'photo' => 'required',
            'user_id' => 'required'
        ]);

        Vehicule::create($request->all());

        return redirect()->route('welcomeee')->with('success', 'Véhicule créé avec succès.');
    }

    public function updateVehicule(Request $request)
    {
        $request->validate([
            'mark' => 'required',
            'model' => 'required',
            'fuelType' => 'required',
            'registration' => 'required|unique:vehicules,registration,' . $request->id,
            'photo' => 'required',
            'user_id' => 'required'
        ]);

        $vehicule = Vehicule::findOrFail($request->id);
        $vehicule->update($request->all());

        return redirect()->route('welcomeee')->with('success', 'Véhicule mis à jour avec succès.');
    }

    public function deleteVehicule(Request $request)
    {
        $vehiculeId = $request->input('vehiculeId');
        Vehicule::destroy($vehiculeId);

        return redirect()->route('welcomeee')->with('success', 'Véhicule supprimé avec succès.');
    }

    public function show($id)
    {
        $vehicule = Vehicule::find($id);
        if (!$vehicule) {
            return response()->json(['error' => 'Véhicule non trouvé'], 404);
        }
        return response()->json($vehicule);
    }
}
