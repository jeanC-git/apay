@extends('layouts.app')
@section('content')
    <lista-pendiente id_user="{{auth()->user()->id}}"></lista-pendiente>
@endsection

