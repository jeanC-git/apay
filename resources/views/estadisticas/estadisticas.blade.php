@extends('layouts.app')
@section('content')
    @if(@Auth::user()->hasRole('consumidor'))
    @elseif(@Auth::user()->hasRole('comerciante'))
    @elseif(@Auth::user()->hasRole('administrador'))
        <estadisticas-admin></estadisticas-admin>
    @endif
@endsection
