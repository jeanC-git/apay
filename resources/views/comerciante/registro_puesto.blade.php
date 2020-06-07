@extends('layouts.app')
@section('content')
    <registro-puesto id_user="{{auth()->user()->id}}" ></registro-puesto>
@endsection