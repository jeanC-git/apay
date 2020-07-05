@extends('layouts.app')
@section('content')
    <catalogo id_user="{{auth()->user()->id}}"></catalogo>
@endsection