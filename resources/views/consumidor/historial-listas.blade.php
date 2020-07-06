@extends('layouts.app')
@section('content')
    <historial-listas id_user="{{auth()->user()->id}}"></historial-listas>
@endsection
