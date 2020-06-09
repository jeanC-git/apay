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
                <li><a href="/">Inicio</a></li>
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
                </template>
            </div>
            <pie></pie>

        </v-content>

        <v-row justify="center">
            <v-dialog v-model="dialog" max-width="60%">
                <v-card>
                    <v-card-title class="headline green accent-2" style='color : #9F9E9D'>TÉRMINOS Y CONDICIONES
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-card-text>
                        <strong>Si usted desea acceder a nuestros servicios, deberá cumplir con los siguientes
                            lineamientos:</strong><br><br>
                        <strong>Sobre el servicio:</strong><br>
                        <hr><br>
                        <li>Al ir al establecimiento en recoger su canasta de productos, debe cumplir con las medidas
                            sanitarias, como portar mascarilla, guantes, y respetar la cola de 2 metros.</li><br>
                        <li>Si va a adquirir los productos mostrados como mínimo deben ser de 15 productos diferentes a
                            más.</li><br>
                        <li>La lista de compras se tiene que realizar con 1 día de anticipación. Y si desea cancelar la
                            solicitud que sea en un lapso de 24 horas contando desde el envió de su lista.</li><br>
                        <li>Realizara una lista de compras como solicitud de productos y posteriormente esperar su
                            confirmación.</li><br>
                        <li>Si su lista de compra es aceptada, se habilitará los horarios disponibles, hasta un máximo
                            de 25 personas por intervalo de horario.</li><br>
                        <li>Se realizará el pago en efectivo al momento de recoger su canasta de víveres.</li><br>
                        <li>En el momento de recoger su canasta de víveres deberá presentar su código.</li><br>
                        <li>No podrá cancelar una lista de pedido después de haber confirmado el horario de recojo.</li>
                        <br>
                        <li>Los usuarios que no recojan sus productos, se le deniega el acceso por un tiempo de 2 meses.
                        </li><br>
                        <hr><br>
                        <strong>Acceso y usos:</strong><br>
                        <li>La Aplicación está dirigida exclusivamente a usuarios residentes en Perú. Los usuarios que
                            residan en el extranjero y que decidan acceder y/o utilizar esta Aplicación, lo harán bajo
                            su propia responsabilidad debiendo asegurarse de que tal acceso y/o utilización cumple con
                            la legislación local aplicable.</li><br>
                        <li>El Usuario podrá acceder a la Aplicación de forma libre y gratuita, además reconoce y acepta
                            que el acceso y uso de la Aplicación tiene lugar libre y conscientemente, bajo su exclusiva
                            responsabilidad. El Usuario únicamente podrá acceder a la Aplicación a través de los medios
                            autorizados.</li><br>
                        <hr><br>
                        <strong>Sobre los datos recopilados de datos:</strong><br>
                        <li>Como usuario de esta Aplicación, ponemos en su conocimiento que los datos que recopilamos
                            son utilizados única y exclusivamente para garantizar el buen funcionamiento de la misma y
                            estos no se comparten ni revelan a terceros sin su respectiva autorización.</li><br>
                        <li>La recopilación de datos se obtiene de la Información que usted nos proporciona: Para poder
                            hacer uso de algunos de nuestros servicios, usted necesita proporcionarnos datos personales
                            como: Correo electrónico, Número de celular, Apellidos y nombres y Tipo y número de
                            documento de identidad.</li><br>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn color="green darken-1" text @click="tyc(false,true)">
                            No acepto
                        </v-btn>

                        <v-btn color="green accent-2" @click="tyc(false,false)" style='color : #9F9E9D'>
                            Acepto
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
    </v-app>

</body>
<script>
    function mostrar_navbar() {
        document.querySelector('.nav-fostrap').classList.toggle('visible');
    };
</script>