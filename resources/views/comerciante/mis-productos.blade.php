@extends('layouts.app')
@section('content')
    <productos id_user="{{auth()->user()->id}}"></productos>
@endsection