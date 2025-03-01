<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Space;
use App\Models\SpaceType;
use App\Models\Address;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    public function index()
    {
        $spaces = Space::with(['spaceType', 'address'])->paginate(10);
        return view('backoffice.spaces.index', compact('spaces'));
    }

    public function create()
    {
        $spaceTypes = SpaceType::all();
        $addresses = Address::all();
        return view('backoffice.spaces.create', compact('spaceTypes', 'addresses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'reg_number' => 'required|string|max:255',
            'observation_CA' => 'required|string',
            'observation_ES' => 'required|string',
            'observation_EN' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'website' => 'nullable|url',
            'accessType' => 'required|string',
            'space_type_id' => 'required|exists:space_types,id',
            'address_id' => 'required|exists:addresses,id',
        ]);

        Space::create($validated);

        return redirect()->route('dashboard.spaces.index')
            ->with('success', 'Espai creat correctament.');
    }

    public function edit(Space $space)
    {
        $spaceTypes = SpaceType::all();
        $addresses = Address::all();
        return view('backoffice.spaces.edit', compact('space', 'spaceTypes', 'addresses'));
    }

    public function update(Request $request, Space $space)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'reg_number' => 'required|string|max:255',
            'observation_CA' => 'required|string',
            'observation_ES' => 'required|string',
            'observation_EN' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'website' => 'nullable|url',
            'accessType' => 'required|string',
            'space_type_id' => 'required|exists:space_types,id',
            'address_id' => 'required|exists:addresses,id',
        ]);

        $space->update($validated);

        return redirect()->route('dashboard.spaces.index')
            ->with('success', 'Espai actualitzat correctament.');
    }

    public function destroy(Space $space)
    {
        try {
            $spaceId = $space->id; // Store the ID before deletion

            // The model's boot method will handle the cascade deletion
            $space->delete();

            // Verify deletion
            $deletedSpace = Space::find($spaceId);
            if (!$deletedSpace) {
                return redirect()->route('dashboard.spaces.index')
                    ->with('success', 'Espai eliminat correctament amb totes les seves relacions.');
            } else {
                return redirect()->route('dashboard.spaces.index')
                    ->with('error', 'Error: L\'espai no s\'ha pogut eliminar correctament.');
            }
        } catch (\Exception $e) {
            return redirect()->route('dashboard.spaces.index')
                ->with('error', 'Error en eliminar l\'espai: ' . $e->getMessage());
        }
    }
}
