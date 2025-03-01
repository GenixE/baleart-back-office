<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Island;
use App\Models\Modality;
use App\Models\Municipality;
use App\Models\Service;
use App\Models\Space;
use App\Models\SpaceType;
use App\Models\Address;
use App\Models\Zone;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    public function index(Request $request)
    {
        // Get the search term
        $search = $request->query('search');

        // Get the sort column and direction
        $sort = $request->query('sort', 'name'); // Default sort by 'name'
        $direction = $request->query('direction', 'asc'); // Default direction 'asc'

        // Validate sort column
        $validSortColumns = ['name', 'spaceType', 'email'];
        if (!in_array($sort, $validSortColumns)) {
            $sort = 'name';
        }

        // Query spaces with relationships
        $spaces = Space::with(['spaceType', 'address'])
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->when($sort === 'spaceType', function ($query) use ($direction) {
                return $query->join('space_types', 'spaces.space_type_id', '=', 'space_types.id')
                    ->orderBy('space_types.name', $direction)
                    ->select('spaces.*');
            })
            ->when($sort !== 'spaceType', function ($query) use ($sort, $direction) {
                return $query->orderBy($sort, $direction);
            })
            ->paginate(15);

        return view('backoffice.spaces.index', compact('spaces'));
    }

    public function create()
    {
        $spaceTypes = SpaceType::all();
        $zones = Zone::all(); // Fetch all zones
        $municipalities = Municipality::with('island')->get(); // Fetch municipalities with their islands
        $islands = Island::all(); // Fetch all islands
        $modalities = Modality::all();
        $services = Service::all();

        // Initialize an empty Space model
        $space = new Space();

        return view('backoffice.spaces.create', compact(
            'spaceTypes',
            'zones',
            'municipalities',
            'islands',
            'modalities',
            'services',
            'space' // Pass the empty Space model
        ));
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
            'website' => 'required|string',
            'accessType' => 'required|in:B,M,A',
            'space_type_id' => 'required|exists:space_types,id',
            'address' => 'required|string', // Address is now a free-text field
            'zone_id' => 'required|exists:zones,id', // Zone is selected from the database
            'municipality_id' => 'required|exists:municipalities,id', // Municipality is selected from the database
            'island_id' => 'required|exists:islands,id', // Island is selected from the database
            'modalities' => 'nullable|array', // Array of modality IDs
            'modalities.*' => 'exists:modalities,id', // Validate each modality ID
            'services' => 'nullable|array', // Array of service IDs
            'services.*' => 'exists:services,id', // Validate each service ID
        ]);

        // Create the address
        $address = Address::create([
            'name' => $validated['address'], // Use the address field as the name
            'zone_id' => $validated['zone_id'],
            'municipality_id' => $validated['municipality_id'],
        ]);

        // Get the logged-in user's ID or default to 1 (admin)
        $userId = auth()->id() ?? 1;

        // Create the space
        $space = Space::create([
            'name' => $validated['name'],
            'reg_number' => $validated['reg_number'],
            'observation_CA' => $validated['observation_CA'],
            'observation_ES' => $validated['observation_ES'],
            'observation_EN' => $validated['observation_EN'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'website' => $validated['website'],
            'accessType' => $validated['accessType'],
            'space_type_id' => $validated['space_type_id'],
            'address_id' => $address->id, // Associate the space with the address
            'user_id' => $userId, // Associate the space with the user
        ]);

        // Attach modalities and services
        if (isset($validated['modalities'])) {
            $space->modalities()->attach($validated['modalities']);
        }
        if (isset($validated['services'])) {
            $space->services()->attach($validated['services']);
        }

        return redirect()->route('dashboard.spaces.index')
            ->with('success', 'Espai creat correctament.');
    }

    public function edit(Space $space)
    {
        $spaceTypes = SpaceType::all();
        $zones = Zone::all(); // Fetch all zones
        $municipalities = Municipality::with('island')->get(); // Fetch municipalities with their islands
        $islands = Island::all(); // Fetch all islands
        $modalities = Modality::all();
        $services = Service::all();

        return view('backoffice.spaces.edit', compact(
            'space',
            'spaceTypes',
            'zones',
            'municipalities',
            'islands',
            'modalities',
            'services'
        ));
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
            'website' => 'required|string',
            'accessType' => 'required|in:B,M,A',
            'space_type_id' => 'required|exists:space_types,id',
            'address' => 'required|string', // Address is now a free-text field
            'zone_id' => 'required|exists:zones,id', // Zone is selected from the database
            'municipality_id' => 'required|exists:municipalities,id', // Municipality is selected from the database
            'island_id' => 'required|exists:islands,id', // Island is selected from the database
            'modalities' => 'nullable|array', // Array of modality IDs
            'modalities.*' => 'exists:modalities,id', // Validate each modality ID
            'services' => 'nullable|array', // Array of service IDs
            'services.*' => 'exists:services,id', // Validate each service ID
        ]);

        // Update the address
        $space->address()->update([
            'name' => $validated['address'], // Use the address field as the name
            'zone_id' => $validated['zone_id'],
            'municipality_id' => $validated['municipality_id'],
        ]);

        // Update the space (do not update user_id)
        $space->update([
            'name' => $validated['name'],
            'reg_number' => $validated['reg_number'],
            'observation_CA' => $validated['observation_CA'],
            'observation_ES' => $validated['observation_ES'],
            'observation_EN' => $validated['observation_EN'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'website' => $validated['website'],
            'accessType' => $validated['accessType'],
            'space_type_id' => $validated['space_type_id'],
        ]);

        // Sync modalities and services
        if (isset($validated['modalities'])) {
            $space->modalities()->sync($validated['modalities']);
        }
        if (isset($validated['services'])) {
            $space->services()->sync($validated['services']);
        }

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
