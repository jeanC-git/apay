<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel=”stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @laravelPWA
</head>
<body>
    <v-app id="app">
        <template>
            <v-app id="inspire">
                <v-navigation-drawer v-model="drawer" :clipped="$vuetify.breakpoint.lgAndUp" app color="#A0FFE1">
                    <template >
                        <v-list>
                            <v-list-item-group>
                                @include('layouts.v-list');
                                {{-- BOTON LOGOUT --}}
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon>mdi-logout</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                                style="text-decoration: none; color:black">
                                                Cerrar Sesión
                                            </a>
                                        </v-list-item-title>
                                    </v-list-item-content>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </v-list-item>
                            </v-list-item-group>
                        </v-list>
                    </template>
                </v-navigation-drawer>
                <v-app-bar :clipped-left="$vuetify.breakpoint.lgAndUp" app color="#69F0AE" dark>
                    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                    <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
                        <span style='color : #9F9E9D' class="hidden-sm-and-down">Bienvenido, {{auth()->user()->name}}</span>
                    </v-toolbar-title>
                    <v-text-field flat solo-inverted hide-details prepend-inner-icon="mdi-magnify" label="Buscar producto"
                        class="hidden-sm-and-down"></v-text-field>
                    <v-spacer></v-spacer>
                    <v-btn icon>
                        <v-icon>mdi-apps</v-icon>
                    </v-btn>
                    <v-btn icon>
                        <v-icon>mdi-bell</v-icon>
                    </v-btn>
                    <v-btn icon large>
                        <v-avatar size="42px" item>
                            <v-img src="\images\icons\icon-72x72.png" alt="Vuetify"></v-img>
                        </v-avatar>
                    </v-btn>
                </v-app-bar>
                <v-content>
                    <v-container class="fill-height" fluid>
                        @yield('content')
                    </v-container>
                </v-content>
            </v-app>
        </template>
    </v-app>
</body>
</html>
