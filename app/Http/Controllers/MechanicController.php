<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    public function welcome(){
        $mechanics = User::where('role', 'Mecanicien')->simplePaginate(5);
        return view('Mecanicien', compact('mechanics'));
    }
    public function addMechanic(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username'=>'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',

        ]);

        $mechanic = new User;
        $mechanic->password = bcrypt('password');
        $mechanic->firstname = $request->firstname;
        $mechanic->lastname = $request->lastname;
        $mechanic->username = $request->username;
        $mechanic->email = $request->email;
        $mechanic->phone = $request->phone;
        $mechanic->address = $request->address;
        $mechanic->role = 'Mecanicien';

        $mechanic->save();
        return redirect()->route('welcome')->with('success', 'Mecanicien created successfully.');
    }
    public function updateMechanic(Request $request){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username'=>'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',

        ]);

        $mechanic = User::findOrFail($request->input('id'));
        $mechanic->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        $mechanic->role = 'Mecanicien';

        $mechanic->save();
        return redirect()->route('welcome')->with('success', 'Mécanicien mis à jour avec succès.');

    }
    public function deleteMechanic(Request $request){


        $mechanicId =$request->input('mechanicId');

        User::destroy($mechanicId);

        return redirect()->route('welcome')->with('success', 'Mécanicien supprimé avec succès.');

    }

    public function show($id)
    {
        $mechanic = User::find($id);
        if (!$client) {
            return response()->json(['error' => 'Mecanicien not found'], 404);
        }
        return response()->json($mechanic);
    }


}
