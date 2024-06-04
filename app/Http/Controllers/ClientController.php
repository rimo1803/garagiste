<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function welcome(){
        $clients = User::where('role', 'Client')->simplePaginate(5);
        return view('Admin.client', compact('clients'));
    }
    public function addClient(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username'=>'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',

        ]);

        $client = new User;
        $client->password = bcrypt('password');
        $client->firstname = $request->firstname;
        $client->lastname = $request->lastname;
        $client->username = $request->username;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->role = 'Client';

        $client->save();
        return redirect()->route('welcome')->with('success', 'Client created successfully.');
    }
    public function updateClient(Request $request){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username'=>'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',

        ]);

        $client = User::FindOrFail($request->input('id'));

        $client->firstname = $request->firstname;
        $client->lastname = $request->lastname;
        $client->username = $request->username;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->role = 'Client';

        $client->save();
        return redirect()->route('Admin.client');

    }
    public function deleteClient(Request $request){


        $clientId =$request->input('clientId');

        User::destroy($clientId);

        return redirect()->route('welcome');

    }

    public function show($id)
    {
        $client = User::find($id);
        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }
        return response()->json($client);
    }


}
