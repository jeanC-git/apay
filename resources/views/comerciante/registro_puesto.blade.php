@extends('layouts.app')

@section('content')

<registro-puesto id_user="{{auth()->user()->name}}" ></registro-puesto>


@endsection
