<div class="grid grid-cols-1 gap-6">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
        <input type="text" name="name" id="name"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
               value="{{ old('name', $space->name ?? '') }}" required>
    </div>

    <div>
        <label for="reg_number" class="block text-sm font-medium text-gray-700">Número de Registre</label>
        <input type="text" name="reg_number" id="reg_number"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
               value="{{ old('reg_number', $space->reg_number ?? '') }}" required>
    </div>

    <div>
        <label for="observation_CA" class="block text-sm font-medium text-gray-700">Observacions (Català)</label>
        <textarea name="observation_CA" id="observation_CA"
                  class="ckeditor mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            {{ old('observation_CA', $space->observation_CA ?? '') }}
        </textarea>
    </div>

    <div>
        <label for="observation_ES" class="block text-sm font-medium text-gray-700">Observacions (Espanyol)</label>
        <textarea name="observation_ES" id="observation_ES"
                  class="ckeditor mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            {{ old('observation_ES', $space->observation_ES ?? '') }}
        </textarea>
    </div>

    <div>
        <label for="observation_EN" class="block text-sm font-medium text-gray-700">Observacions (Anglès)</label>
        <textarea name="observation_EN" id="observation_EN"
                  class="ckeditor mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            {{ old('observation_CA', $space->observation_CA ?? '') }}
        </textarea>
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
               value="{{ old('email', $space->email ?? '') }}" required>
    </div>

    <div>
        <label for="phone" class="block text-sm font-medium text-gray-700">Telèfon</label>
        <input type="text" name="phone" id="phone"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
               value="{{ old('phone', $space->phone ?? '') }}" required>
    </div>

    <div>
        <label for="website" class="block text-sm font-medium text-gray-700">Lloc Web</label>
        <input type="text" name="website" id="website"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
               value="{{ old('website', $space->website ?? '') }}">
    </div>

    <div>
        <label for="accessType" class="block text-sm font-medium text-gray-700">Tipus d'Accés</label>
        <select name="accessType" id="accessType"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
            <option value="">Seleccionar tipus...</option>
            <option value="B" {{ old('accessType', $space->accessType ?? '') == 'B' ? 'selected' : '' }}>Baixa</option>
            <option value="M" {{ old('accessType', $space->accessType ?? '') == 'M' ? 'selected' : '' }}>Mitja</option>
            <option value="A" {{ old('accessType', $space->accessType ?? '') == 'A' ? 'selected' : '' }}>Accessible
            </option>
        </select>
    </div>

    <div>
        <label for="space_type_id" class="block text-sm font-medium text-gray-700">Tipus d'Espai</label>
        <select name="space_type_id" id="space_type_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
            <option value="">Seleccionar tipus...</option>
            @foreach($spaceTypes as $type)
                <option value="{{ $type->id }}"
                    {{ (old('space_type_id', $space->space_type_id ?? '') == $type->id) ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="address" class="block text-sm font-medium text-gray-700">Adreça</label>
        <input type="text" name="address" id="address"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
               value="{{ old('address', $space->address->name ?? '') }}" required>
    </div>

    <div>
        <label for="zone_id" class="block text-sm font-medium text-gray-700">Zona</label>
        <select name="zone_id" id="zone_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
            <option value="">Seleccionar zona...</option>
            @foreach($zones as $zone)
                <option value="{{ $zone->id }}"
                    {{ (old('zone_id', $space->address->zone_id ?? '') == $zone->id) ? 'selected' : '' }}>
                    {{ $zone->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="municipality_id" class="block text-sm font-medium text-gray-700">Municipi</label>
        <select name="municipality_id" id="municipality_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
            <option value="">Seleccionar municipi...</option>
            @foreach($municipalities as $municipality)
                <option value="{{ $municipality->id }}"
                    {{ (old('municipality_id', $space->address->municipality_id ?? '') == $municipality->id) ? 'selected' : '' }}>
                    {{ $municipality->name }} ({{ $municipality->island->name }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="island_id" class="block text-sm font-medium text-gray-700">Illa</label>
        <select name="island_id" id="island_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
            <option value="">Seleccionar illa...</option>
            @foreach($islands as $island)
                <option value="{{ $island->id }}"
                    {{ (old('island_id', $space->address->municipality->island_id ?? '') == $island->id) ? 'selected' : '' }}>
                    {{ $island->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Modalities -->
    <div>
        <label for="modalities" class="block text-sm font-medium text-gray-700">Modalitats</label>
        <select name="modalities[]" id="modalities" multiple
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @foreach($modalities as $modality)
                <option value="{{ $modality->id }}"
                    {{ in_array($modality->id, old('modalities', $space->modalities->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                    {{ $modality->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Services -->
    <div>
        <label for="services" class="block text-sm font-medium text-gray-700">Serveis</label>
        <select name="services[]" id="services" multiple
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @foreach($services as $service)
                <option value="{{ $service->id }}"
                    {{ in_array($service->id, old('services', $space->services->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                    {{ $service->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mt-4">
        <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ isset($space) ? __('Actualitzar') : __('Crear') }}
        </button>
        <a href="{{ route('dashboard.spaces.index') }}"
           class="ml-2 inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Cancelar
        </a>
    </div>
</div>
