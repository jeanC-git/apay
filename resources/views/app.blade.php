<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apay-Inicio</title>
    <script src="{{ URL::asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
</head>
<body id="body">
    <nav>
        <div class="nav-fostrap">
            <div>
                <span class="name_apay">Apay</span>
            </div>
            <ul>
                <li><a href="">Inicio</a></li>
                <li><a href="">Caseros</a></li>
                <li><a href="">Alimentos</a></li>
                <li><a href="">Testimonios</a></li>
                <li><a href="">Iniciar sesión</a></li>
            </ul>
        </div>
        <div class="nav-bg-fostrap">
            <div class="navbar-fostrap" onclick="mostrar_navbar()"> <span></span> <span></span> <span></span> </div>
            <a href="" class="title-mobile">APAY</a>
        </div>
    </nav>
    <v-app id="app">
        <v-content>
            <div class="ma-0 pa-0">
                <template>
                    <v-row>
                        <v-col cols="12" class="pa-0">
                            <v-app id="inspire"
                                style="background-image:url('https://i.ibb.co/xFT2W9F/banner.jpg');background-size: cover;background-position:center;background-repeat: no-repeat;">
                                <v-content>
                                    <v-container class="fill-height" fluid>
                                        <v-row align="center" justify="center">
                                            <v-col class="mt-0" cols="12" sm="8" md="4">
                                                <v-card class="elevation-12">
                                                    <v-toolbar color="yellow darken-1" dark >
                                                        <v-toolbar-title class="grey--text darken-3">Iniciar Sesión
                                                        </v-toolbar-title>
                                                        <v-spacer></v-spacer>
                                                        <v-tooltip bottom>
                                                            <template v-slot:activator="{ on }">
                                                                <v-btn icon large target="_blank"
                                                                    v-on="on"></v-btn>
                                                            </template>
                                                            <span>Source</span>
                                                        </v-tooltip>
                                                    </v-toolbar>
                                                    <form method="POST" action="{{ route('login') }}">
                                                        @csrf
                                                        <v-card-text>
                                                            <v-text-field color="green accent-3" label="Correo electrónico" name="email"
                                                            type="text" prepend-icon="mdi-account-circle">
                                                            </v-text-field>
                                                            <v-text-field color="green accent-3" id="password"
                                                            label="Contraseña" name="password"  :type="showPassword ? 'text' :'password'"
                                                            prepend-icon="mdi-lock"
                                                            :append-icon="showPassword ? 'mdi-eye' :
                                                            'mdi-eye-off'"
                                                            @click:append="showPassword = 
                                                            !showPassword">
                                                            </v-text-field>
                                                        </v-card-text>
                                                        <v-card-actions>
                                                            <v-spacer></v-spacer>
                                                            <v-btn class="grey--text darken-3"  color="yellow darken-1" type="submit">
                                                                Ingresar</v-btn>
                                                        </v-card-actions>
                                                    </form>
                                                </v-card>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-content>
                            </v-app>
                        </v-col>
                    </v-row>
                    <v-row class="green accent-2">
                        <v-container>
                            <v-row>
                                <v-col cols="12">
                                    <h1 class="text-center">Nuestros servicios</h1>
                                </v-col>
                                <v-col cols="4" md="4">
                                    <v-icon x-large color="pink accent-3" class="d-block text-center">mdi-heart</v-icon>
                                    <p class="text-center font-weight-bold">Encuentra tus alimentos en un solo lugar.
                                    </p>
                                </v-col>
                                <v-col cols="4" md="4">
                                    <v-icon x-large color="yellow darken-1" class="d-block text-center">mdi-star
                                    </v-icon>
                                    <p class="text-center font-weight-bold">Te contactamos con tu casero(a)-clientes.
                                    </p>
                                </v-col>
                                <v-col cols="4" md="4">
                                    <v-icon x-large color="blue-grey darken-3" class="d-block text-center">mdi-thumb-up
                                    </v-icon>
                                    <p class="text-center font-weight-bold">Precio estandar al mercado sugerido.</p>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-row>
                </template>
            </div>


            <v-footer dark padless>
                <v-card width="100%" tile class="green accent-3 white--text text-center">
                    <v-card-text>
                        <v-btn class="mx-4 white--text" icon>
                            <v-icon size="24px">mdi-facebook</v-icon>
                        </v-btn>
                        <v-btn class="mx-4 white--text" icon>
                            <v-icon size="24px">mdi-twitter</v-icon>
                        </v-btn>
                        <v-btn class="mx-4 white--text" icon>
                            <v-icon size="24px">mdi-linkedin</v-icon>
                        </v-btn>
                        <v-btn class="mx-4 white--text" icon>
                            <v-icon size="24px">mdi-instagram</v-icon>
                        </v-btn>
                    </v-card-text>
                    <v-card-text class="white--text pt-0">
                        Equipo de Apay
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-text class="white--text">
                        2020 — <strong>Curso de Integrador</strong>
                    </v-card-text>
                </v-card>
            </v-footer>
            <registro></registro> 
            <inicio-sesion></inicio-sesion>
            <perfil></perfil>
        </v-content>
    </v-app> 
    <script>
        function mostrar_navbar() {
            document.querySelector('.nav-fostrap').classList.toggle('visible');
        };
    </script>
</body>