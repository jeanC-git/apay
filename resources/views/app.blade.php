<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apay-Inicio</title>
    <script src="{{ URL::asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -ms-box-sizing: border-box;
        box-sizing: border-box;
    }

    body {
        background: #F0F0F0;
        font-size: 15px;
        color: #666;
        font-family: 'Roboto', sans-serif;
    }

    /* .content {
        height: 200px;
        } */
    a {
        text-decoration: none;
    }


    .nav-fostrap {
        display: flex;
        justify-content: space-between;
        z-index: 1;
        align-items: center;
        margin-bottom: 15px 0;
        background: rgba(105, 240, 174);
        -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        -ms-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        -o-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        border-radius: 3px;
    }

    .nav-fostrap ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: block;
    }

    .nav-fostrap li {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: inline-block;
        position: relative;
        font-size: 14;
        color: #def1f0;
    }

    .nav-fostrap li a {
        padding: 15px 20px;
        font-size: 14;
        color: rgb(146, 146, 146);
        display: inline-block;
        outline: 0;
        font-weight: 400;
    }

    .nav-fostrap li:hover ul.dropdown {
        display: block;
    }

    .nav-fostrap li ul.dropdown {
        position: absolute;
        display: none;
        width: 200px;
        background: #2980B9;
        -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        -ms-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        -o-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        padding-top: 0;
    }

    .nav-fostrap li ul.dropdown li {
        display: block;
        list-style-type: none;
    }

    .nav-fostrap li ul.dropdown li a {
        padding: 15px 20px;
        font-size: 15px;
        color: #fff;
        display: block;
        font-weight: 400;
    }

    .nav-fostrap li ul.dropdown li:last-child a {
        border-bottom: none;
    }

    .nav-fostrap li:hover a {
        background: rgb(43, 189, 126);
        color: #fff !important;
    }

    .nav-fostrap li:first-child:hover a {
        border-radius: 3px 0 0 3px;
    }

    .nav-fostrap li ul.dropdown li:hover a {
        background: rgba(0, 0, 0, .1);
    }

    .nav-fostrap li ul.dropdown li:first-child:hover a {
        border-radius: 0;
    }

    .nav-fostrap li:hover .arrow-down {
        border-top: 5px solid #fff;
    }

    .arrow-down {
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid #def1f0;
        position: relative;
        top: 15px;
        right: -5px;
        content: '';
    }

    .title-mobile {
        display: none;
    }

    @media only screen and (max-width:900px) {

        .nav-fostrap {
            background: #fff;
            width: 200px;
            height: 100%;
            display: block;
            position: fixed;
            left: -200px;
            top: 0px;
            -webkit-transition: left 0.25s ease;
            -moz-transition: left 0.25s ease;
            -ms-transition: left 0.25s ease;
            -o-transition: left 0.25s ease;
            transition: left 0.25s ease;
            margin: 0;
            border: 0;
            border-radius: 0;
            overflow-y: auto;
            overflow-x: hidden;
            height: 100%;
        }

        .title-mobile {
            position: fixed;
            display: block;
            top: 10px;
            font-size: 20px;
            left: 100px;
            right: 100px;
            text-align: center;
            color: #FFF;
        }

        .nav-fostrap.visible {
            left: 0px;
            -webkit-transition: left 0.25s ease;
            -moz-transition: left 0.25s ease;
            -ms-transition: left 0.25s ease;
            -o-transition: left 0.25s ease;
            transition: left 0.25s ease;
        }

        .nav-bg-fostrap {
            display: inline-block;
            vertical-align: middle;
            width: 100%;
            height: 50px;
            margin: 0;
            position: absolute;
            top: 0px;
            left: 0px;
            z-index: 2;
            background: rgba(105, 240, 174);
            padding: 12px 0 0 10px;
            -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
            -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
            -ms-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
            -o-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        }

        .navbar-fostrap {
            display: inline-block;
            vertical-align: middle;
            height: 50px;
            cursor: pointer;
            margin: 0;
            position: absolute;
            top: 0;
            left: 0;
            padding: 12px;
        }

        .navbar-fostrap span {
            height: 2px;
            background: #fff;
            margin: 5px;
            display: block;
            width: 20px;
        }

        .navbar-fostrap span:nth-child(2) {
            width: 20px;
        }

        .navbar-fostrap span:nth-child(3) {
            width: 20px;
        }

        .nav-fostrap ul {
            padding-top: 50px;
        }

        .nav-fostrap li {
            display: block;
        }

        .nav-fostrap li a {
            display: block;
            color: #505050;
            font-weight: 600;
        }

        .nav-fostrap li:first-child:hover a {
            border-radius: 0;
        }

        .nav-fostrap li ul.dropdown {
            position: relative;
        }

        .nav-fostrap li ul.dropdown li a {
            background: #2980B9 !important;
            border-bottom: none;
            color: #fff !important;
        }

        .nav-fostrap li:hover a {
            background: rgba(105, 240, 174);
            color: #fff !important;
        }

        .nav-fostrap li ul.dropdown li:hover a {
            background: rgba(0, 0, 0, .1);
             !important;
            color: #fff !important;
        }

        .nav-fostrap li ul.dropdown li a {
            padding: 10px 10px 10px 30px;
        }

        .nav-fostrap li:hover .arrow-down {
            border-top: 5px solid #fff;
        }

        .arrow-down {
            border-top: 5px solid #505050;
            position: absolute;
            top: 20px;
            right: 10px;
        }

        .cover-bg {
            background: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }
    }

    .fixed-top {
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
    }

    .name_apay {
        margin: 42%;
        font-size: xx-large;
        color: rgb(43, 189, 126);
    }
</style>
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
                                                    <v-toolbar color="yellow darken-1" dark flat>
                                                        <v-toolbar-title class="grey--text darken-3">Iniciar Sesión
                                                        </v-toolbar-title>
                                                        <v-spacer></v-spacer>
                                                        <v-tooltip bottom>
                                                            <template v-slot:activator="{ on }">
                                                                <v-btn :href="source" icon large target="_blank"
                                                                    v-on="on"></v-btn>
                                                            </template>
                                                            <span>Source</span>
                                                        </v-tooltip>
                                                    </v-toolbar>
                                                    <form method="POST" action="{{ route('login') }}">
                                                        @csrf
                                                        <v-card-text>
                                                            <v-text-field label="Correo electrónico" name="email"
                                                            type="text"></v-text-field>

                                                            <v-text-field color="green accent-1" id="password"
                                                            label="Contraseña" name="password" type="password">
                                                            </v-text-field>
                                                        </v-card-text>
                                                        <v-card-actions>
                                                            <v-spacer></v-spacer>
                                                            <v-btn class="grey--text darken-3" flat color="yellow darken-1" type="submit">
                                                                Ingresar</v-btn>
                                                        </v-card-actions>
                                                    </form>
                                                </v-card>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-content>
                            </v-app>

                            <!-- <v-img src="https://i.ibb.co/xFT2W9F/banner.jpg" class="d-block"
                                max-height="513">
                      </v-img>-->
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
                <v-card width="100%" flat tile class="green accent-4 white--text text-center">
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

            {{-- <!-- <navbar-component></navbar-component> -->
            <inicio></inicio>
            <pie></pie>
            <!-- <inicio-sesion></inicio-sesion> -->
            <registro></registro> --}}
        </v-content>
    </v-app>
    <script>
        function mostrar_navbar() {
            document.querySelector('.nav-fostrap').classList.toggle('visible');
        };
    </script>
