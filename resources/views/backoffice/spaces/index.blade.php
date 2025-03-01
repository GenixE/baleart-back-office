@extends('backoffice.spaces.form')

@section('title', 'Llistat d\'Espais')

@section('content')
    <div class="mb-4">
        <a href="{{ route('dashboard.spaces.create') }}"
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Crear Nou Espai
        </a>
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead>
        <tr>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nom
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Tipus
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Email
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Accions
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($spaces as $space)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $space->name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $space->spaceType->name ?? 'N/A' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $space->email }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('dashboard.spaces.edit', $space) }}"
                       class="text-indigo-600 hover:text-indigo-900">Editar</a>

                    <form action="{{ route('dashboard.spaces.destroy', $space) }}"
                          method="POST"
                          class="inline"
                          onsubmit="return confirm('Estàs segur que vols eliminar aquest espai?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="ml-2 text-red-600 hover:text-red-900">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $spaces->links() }}
    </div>
@endsection
