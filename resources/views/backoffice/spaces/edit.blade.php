@extends('backoffice.spaces.form')

@section('title', 'Editar Espai')

@section('content')
    <form method="POST" action="{{ route('dashboard.spaces.update', $space) }}">
        @csrf
        @method('PUT')
        @include('backoffice.spaces.partials.form-fields')
    </form>
@endsection
