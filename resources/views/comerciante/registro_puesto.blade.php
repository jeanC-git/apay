@extends('layouts.app')
@section('content')
    <!-- @if(isset($Titulo))
        <v-snackbar
        class="mt-7"
        v-model="snackbar"
        right
        top
        color="info"
        vertical
        >
        {{$Titulo}}
        <br>
        <v-btn
            dark
            text
            @click="snackbar = false"
        >
            Cerrar
        </v-btn>
        </v-snackbar>
    @endif -->
    <registro-puesto id_user="{{auth()->user()->id}}" ></registro-puesto>
@endsection