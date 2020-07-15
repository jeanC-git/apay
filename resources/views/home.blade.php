@extends('layouts.app')
@section('content')
    @if(@Auth::user()->hasRole('consumidor'))
    <catalago></catalago>
    @elseif(@Auth::user()->hasRole('comerciante'))
    <lista-pendiente id_user="{{auth()->user()->id}}"></lista-pendiente>
    @elseif(@Auth::user()->hasRole('administrador'))
        <consumidores></consumidores>
    @endif
@endsection
