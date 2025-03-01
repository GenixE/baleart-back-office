@extends('backoffice.spaces.form')

@section('title', 'Crear Espai')

@section('content')
    <form method="POST" action="{{ route('dashboard.spaces.store') }}">
        @csrf
        @include('backoffice.spaces.partials.form-fields')
    </form>
@endsection
