@extends('layouts.app')
@section('content')
    @if(@Auth::user()->hasRole('consumidor'))
    <home-consumidor></home-consumidor>
    @elseif(@Auth::user()->hasRole('comerciante'))
    <home-comerciante></home-comerciante>

    @elseif(@Auth::user()->hasRole('administrador'))
        <consumidores></consumidores>
    @endif
@endsection
