<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SparePart;

class PieceDeRechangeController extends Controller
{
    public function index()
    {
        $pieces = SparePart::all();
        return view('Admin.PieceDeRechange', compact('pieces'));
    }


    public function AddPieceDeRechange(Request $request)
    {
        $request->validate([
            'partName' => 'required',
            'partReference' => 'required',
            'supplier' => 'required',
            'price' => 'required|numeric',

        ]);

        $piece = new SparePart;
        $piece->partName = $request->partName;
        $piece->partReference = $request->partReference;
        $piece->supplier = $request->supplier;
        $piece->price = $request->price;


        $piece->save();

        return redirect()->route('index')->with('success', 'Pièce de rechange ajoutée avec succès.');
    }



    public function updatePieceDeRechange(Request $request)
    {
        $request->validate([
            'partName' => 'required',
            'partReference' => 'required',
            'supplier' => 'required',
            'price' => 'required|numeric',

        ]);

        $piece = SparePart::findOrFail($request->input('id'));
        $piece->partName = $request->partName;
        $piece->partReference = $request->partReference;
        $piece->supplier = $request->supplier;
        $piece->price = $request->price;


        $piece->save();

        return redirect()->route('index')->with('success', 'Pièce de rechange mise à jour avec succès.');
    }

    public function deletePieceDeRechange(Request $request)
    {


        $pieceId =$request->input('pieceId');
        SparePart::destroy($pieceId);

        return redirect()->route('index')->with('success', 'Pièce de rechange supprimée avec succès.');

    }

    public function show($id)
    {
        $piece = SparePart::find($id);
        if (!$piece) {
            return response()->json(['error' => 'Pièce de rechange non trouvée'], 404);
        }
        return response()->json($piece);
    }
}
