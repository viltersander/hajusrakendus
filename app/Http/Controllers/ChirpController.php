<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Index', [
            'chirps' => Chirp::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {   
        
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
        
        $request->user()->chirps()->create($validated);
        
        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

        /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        if (auth()->user()->is_admin || $chirp->user_id === auth()->id()) {
            $validated = $request->validate([
                'message' => 'required|string|max:255',
            ]);
    
            $chirp->update($validated);
    
            return redirect(route('chirps.index'));
        }
        
        // User is not authorized to update the chirp
        // For example, you can redirect back with an error message
        return redirect()->back()->with('error', 'You are not authorized to update this chirp.');
    }
        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        if (auth()->user()->is_admin) {
            $chirp->delete();
            return redirect(route('chirps.index'));
        }
        
        // User is not an admin, handle unauthorized access
        // For example, you can redirect back with an error message
        return redirect()->back()->with('error', 'Only admins can delete chirps.');
    }
}
