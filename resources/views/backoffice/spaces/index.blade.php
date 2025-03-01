@extends('backoffice.spaces.form')

@section('title', 'Llistat d\'Espais')

@section('content')
    <style>
        .sort-arrow {
            display: inline-block;
            margin-left: 5px;
            font-size: 12px;
            color: #6b7280;
        }

        .sort-arrow.active {
            color: #3b82f6;
        }

        .pagination-info {
            text-align: center;
            color: #6b7280;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }
    </style>

    <div class="mb-4 flex justify-between items-center">
        <!-- Search Bar moved to left -->
        <form action="{{ route('dashboard.spaces.index') }}" method="GET" class="flex items-center">
            <input type="text" name="search" placeholder="Cercar per nom..."
                   class="px-4 py-2 border rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ request('search') }}">
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r">
                Cercar
            </button>
        </form>

        <!-- Create button moved to right -->
        <a href="{{ route('dashboard.spaces.create') }}"
           class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded shadow">
            Crear Nou Espai
        </a>
    </div>

    <table class="w-full divide-y divide-gray-200">
        <thead>
        <tr>
            <!-- Sortable Headers -->
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                onclick="window.location.href='{{ route('dashboard.spaces.index', ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}'">
                Nom
                <span class="sort-arrow {{ request('sort') === 'name' ? 'active' : '' }}">
                    @if (request('sort') === 'name')
                        @if (request('direction') === 'asc')
                            ▲
                        @else
                            ▼
                        @endif
                    @else
                        ▲▼
                    @endif
                </span>
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                onclick="window.location.href='{{ route('dashboard.spaces.index', ['sort' => 'spaceType', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}'">
                Tipus
                <span class="sort-arrow {{ request('sort') === 'spaceType' ? 'active' : '' }}">
                    @if (request('sort') === 'spaceType')
                        @if (request('direction') === 'asc')
                            ▲
                        @else
                            ▼
                        @endif
                    @else
                        ▲▼
                    @endif
                </span>
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                onclick="window.location.href='{{ route('dashboard.spaces.index', ['sort' => 'email', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}'">
                Email
                <span class="sort-arrow {{ request('sort') === 'email' ? 'active' : '' }}">
                    @if (request('sort') === 'email')
                        @if (request('direction') === 'asc')
                            ▲
                        @else
                            ▼
                        @endif
                    @else
                        ▲▼
                    @endif
                </span>
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
                       class="text-indigo-600 hover:text-indigo-900 flex items-center">
                        Editar
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                        </svg>
                    </a>

                    <form action="{{ route('dashboard.spaces.destroy', $space) }}"
                          method="POST"
                          class="inline"
                          onsubmit="return confirm('Estàs segur que vols eliminar aquest espai?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="ml-2 text-red-600 hover:text-red-900 flex items-center">
                            Eliminar
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 ml-1 inline-block align-middle">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
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
