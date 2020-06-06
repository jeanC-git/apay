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
                <li><a href="#">Inicio</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="">Alimentos</a></li>
                <li><a href="/inicio-sesion">Iniciar Sesión</a></li>
            </ul>
        </div>
        <div class="nav-bg-fostrap">
            <div class="navbar-fostrap" onclick="mostrar_navbar()"> <span></span> <span></span> <span></span> </div>
            <a href="#" class="title-mobile">APAY</a>
        </div>
    </nav>
    <v-app id="app">
    <template>
        <v-row>
            <v-col cols="12" class="mt-0 pa-0">        
            <v-img src="images/Slides/slide1.png">
            </v-col>
        </v-row>

        <template>
        <div id="servicios">
            <v-row class="yellow lighten-2">
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <h1 class="text-center title">Nuestros servicios</h1>
                        </v-col>
                        <v-col cols="12" md="4" xs="12">
                            <v-icon x-large color="pink accent-3" class="d-block text-center">mdi-heart</v-icon>
                            <p class="text-center font-weight-bold">Encuentra tus alimentos en un solo lugar.
                            </p>
                        </v-col>
                        <v-col cols="12" md="4" xs="12">
                            <v-icon x-large color="green accent-2" class="d-block text-center">mdi-star
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
                    <v-row>
                        <v-col cols="12">
                        <v-divider class="green accent-2"></v-divider>
                        <h1 class="text-center text-lg title ma-3" style="color-text:#263238">Que productos puedes encontrar en este mercado 😍</h1>                   
                        </v-col>
                        <v-col cols="12" md="6">
                        <p class="text-center font-weight-bold text-md body-1" color="blue-grey darken-3">
                            En este mercado encontraras los vegetales entre frutas ya sean secos o frescos. Las verduras chinas o 
                            criollas. Además, entre lacteos y derivados como queso, yogurth. También, puedes encontrar la sección de carnes
                            con pollos en trozos o enteros; res molido, trozo o lomitos; cerdo ya sea en chuletas. Y la sección de mariscos y pescados.
                            Por otra parte, encontraras la sección de pastelería para tus postres dulces o salados y entre golosinas.
                        </p>
                        </v-col>
                        <v-col cols="12" md="6">
                        <p class="text-center font-weight-bold text-md"> 
                            🍉 FRUTAS <br>
                            🍆 VERDURAS <br>
                            🍖 CARNES POLLO/RES/CERDO <br>
                            🍤 PESCADOS Y MARISCOS <br>
                            🍯 PASTELERIA Y GOLOSINAS <br>
                            🍳 ABARROTES <br>
                            🍶 LÁCTEOS <br>
                        </p>
                        </v-col>
                    </v-row>
                </v-container>
            </v-row>
        </div>
        </template>
    </template>
        <pie></pie>
    </v-app>

</body>
<script>
    function mostrar_navbar() {
        document.querySelector('.nav-fostrap').classList.toggle('visible');
    };
</script>