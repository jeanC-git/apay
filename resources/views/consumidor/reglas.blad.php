@extends('layouts.app')
@section('content')
  <reglas id_user="{{auth()->user()->id}}"></reglas>
@endsection
