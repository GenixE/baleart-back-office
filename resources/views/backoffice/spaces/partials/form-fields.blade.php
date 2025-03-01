<div class="grid grid-cols-1 gap-6">
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
        <label for="address_id" class="block text-sm font-medium text-gray-700">Adreça</label>
        <select name="address_id" id="address_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
            <option value="">Seleccionar adreça...</option>
            @foreach($addresses as $address)
                <option value="{{ $address->id }}"
                    {{ (old('address_id', $space->address_id ?? '') == $address->id) ? 'selected' : '' }}>
                    {{ $address->name }}
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
