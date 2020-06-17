@extends('layouts.app')
@section('content')
    @if(@Auth::user()->hasRole('consumidor'))
    <catalago></catalago>
    @elseif(@Auth::user()->hasRole('comerciante'))
    <home-comerciante></home-comerciante>

    @elseif(@Auth::user()->hasRole('administrador'))
        <consumidores></consumidores>
    @endif
@endsection
