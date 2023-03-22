<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marker;

class MarkerController extends Controller
{

    public function index()
    {
        $markers = Marker::all();
        return response()->json($markers);
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'desc' => 'nullable',
        ]);
        
        $marker = Marker::create([
            'name' => $validatedData['name'],
            'latitude' => floatval($validatedData['lat']),
            'longitude' => floatval($validatedData['lng']),
            'description' => $validatedData['desc'],
            'added' => now(),
            'edited' => now(),
        ]);

        return redirect()->back()->with('success', 'Marker added');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'desc' => 'nullable',
        ]);

        $marker = Marker::findOrFail($id);

        $marker->name = $validatedData['name'];
        $marker->latitude = $validatedData['lat'];
        $marker->longitude = $validatedData['lng'];
        $marker->description = $validatedData['desc'];
        $marker->edited = now();
        $marker->save();

        return redirect()->back()->with(['message' => 'Marker updated successfully']);
    }


    public function destroy($id)
    {
        $marker = Marker::findOrFail($id);
        $marker->delete();

        return response()->json(['message' => 'Marker deleted']);
    }
}
