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
    @laravelPWA
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
                                style="background-image:url('images/icons/banner.jpg');background-size: cover;background-position:center;background-repeat: no-repeat;">
                                {{-- INICIO SESION --}}
                                <v-content v-if="mostrar_inicio_sesion===true">
                                    <v-container class="fill-height" fluid>
                                        <v-row align="center" justify="center">
                                            <v-col class="mt-0" cols="12" sm="8" md="4">
                                                <v-card class="elevation-12">
                                                    <v-toolbar color="yellow darken-1" dark flat>
                                                        <v-toolbar-title class="grey--text darken-3">Iniciar Sesión
                                                        </v-toolbar-title>
                                                        <v-spacer></v-spacer>
                                                    </v-toolbar>
                                                    <form method="POST" action="{{ route('login') }}">
                                                        @csrf
                                                    <v-card-text>
                                                            <v-text-field label="Correo electrónico" name="email"
                                                                type="text" prepend-icon="mdi-account-circle"
                                                                color="green accent-3"></v-text-field>

                                                            <v-text-field color="green accent-1" id="password"
                                                                label="Contraseña" name="password"
                                                                :type="showPassword ? 'text' :'password'"
                                                                prepend-icon="mdi-lock" :append-icon="showPassword ? 'mdi-eye' :
                                                      'mdi-eye-off'" @click:append="showPassword =
                                                      !showPassword"></v-text-field>
                                                    </v-card-text>
                                                    <v-card-actions outline tile>

                                                        <v-spacer></v-spacer>
                                                        <v-btn class='color: yellow darken-2' style='color : #9F9E9D'
                                                            @click="mostrar_inicio_sesion = !mostrar_inicio_sesion">
                                                            Registrarse</v-btn>
                                                        <v-spacer></v-spacer>
                                                        <v-btn type="submit" class='color: yellow darken-2'
                                                            style='color : #9F9E9D'>
                                                            Ingresar</v-btn>

                                                    </v-card-actions>
                                                    </form>
                                                </v-card>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-content>
                                {{-- REGISTRAR USUARIO --}}
                                <v-content v-else>
                                    <v-container class="fill-height" fluid>
                                        <v-row align="center" justify="center">
                                            <v-col class="mt-0" cols="12" sm="8" md="4">
                                                <v-card class="elevation-12" color="">
                                                    <v-toolbar color="yellow darken-1" dark>
                                                        <v-btn  icon color="grey"  @click="mostrar_inicio_sesion = !mostrar_inicio_sesion"
                                                            ><v-icon>mdi-arrow-left</v-icon></v-btn>
                                                        </v-flex>
                                                        <v-card-actions>
                                                            <v-toolbar-title class="grey--text darken-3">Registrate
                                                            </v-toolbar-title>
                                                        </v-card-actions>
                                                        <v-spacer></v-spacer>
                                                            <v-btn class="mx-4 white--text" icon>
                                                                <v-icon size="40px">mdi-facebook-box</v-icon>
                                                            </v-btn>
                                                            <v-btn class="mx-4 white--text" icon>
                                                                <v-icon size="40px">mdi-google</v-icon>
                                                            </v-btn>
                                                    </v-toolbar>
                                                    <form method="POST" action="{{ route('register') }}">
                                                        @csrf
                                                    <v-card-text>
                                                            <v-text-field label="Nombre" name="name" type="text"
                                                                color="green accent-3"></v-text-field>

                                                            <v-text-field label="Apellido" name="lastname" type="text"
                                                                color="green accent-3"></v-text-field>
                                                            <v-text-field label="Correo electrónico" name="email"
                                                                type="text" color="green accent-3"></v-text-field>

                                                            <v-text-field label="Contraseña"
                                                                name="password"
                                                                :type="showPassword ? 'text' :'password'" :append-icon="showPassword ? 'mdi-eye' :
                                                                'mdi-eye-off'" @click:append="showPassword =
                                                                !showPassword" color="green accent-3"></v-text-field>
                                                            <v-text-field color="green accent-3"
                                                                label="Confirmar contraseña" name="password_confirmation"
                                                                :type="showValidatePassword ? 'text' :'password'"
                                                                :append-icon="showValidatePassword ? 'mdi-eye' :
                                                                'mdi-eye-off'" @click:append="showValidatePassword =
                                                                !showValidatePassword"></v-text-field>
                                                    </v-card-text>
                                                    <v-card-actions>
                                                        <v-flex justify-center>
                                                            <div id='example-3' style="text-align:center">
                                                                <input type="checkbox" id="aceptar" value="Aceptar">
                                                                <label>Aceptar términos y condiciones</label>
                                                                <br>
                                                            </div>
                                                        </v-flex>
                                                    </v-card-actions>
                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-flex justify-center>
                                                            <v-btn class='color: yellow darken-2'
                                                                style='color : #9F9E9D' type="submit">
                                                                Continuar</v-btn>
                                                        </v-flex>
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
                                <v-col cols="12" md="4" xs="12">
                                    <v-icon x-large color="pink accent-3" class="d-block text-center">mdi-heart</v-icon>
                                    <p class="text-center font-weight-bold">Encuentra tus alimentos en un solo lugar.
                                    </p>
                                </v-col>
                                <v-col cols="12" md="4" xs="12">
                                    <v-icon x-large color="yellow darken-1" class="d-block text-center">mdi-star
                                    </v-icon>
                                    <p class="text-center font-weight-bold">Te contactamos con tu casero(a)-clientes.
                                    </p>
                                </v-col>
                                <v-col cols="12" md="4" xs="12">
                                    <v-icon x-large color="blue-grey darken-3" class="d-block text-center">mdi-thumb-up
                                    </v-icon>
                                    <p class="text-center font-weight-bold">Precio estandar al mercado sugerido.</p>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-row>
                </template>
            </div>
            <footer></footer>
        </v-content>
    </v-app>
    <script>
        function mostrar_navbar() {
            document.querySelector('.nav-fostrap').classList.toggle('visible');
        };
    </script>
</body>