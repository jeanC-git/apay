@extends('layouts.app')
@section('content')
    <informacion-personal id_user="{{auth()->user()->id}}"></informacion-personal>
@endsection