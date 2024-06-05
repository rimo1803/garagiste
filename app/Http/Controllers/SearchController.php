<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class SearchController extends Controller
{



    $keyword = $request->input('keyword');

    // Recherche des utilisateurs dont le prénom ou le nom de famille contient le mot de recherche
    $users = User::where('firstname', 'like', '%' . $keyword . '%')
                 ->orWhere('lastname', 'like', '%' . $keyword . '%')
                 ->get();

    // Retourner les utilisateurs trouvés au format JSON
    return response()->json($users);



}


