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
                                                        <a class="mx-4 white--text" icon href="{{ route('social.auth', 'facebook') }}">
                                                            <v-icon size="40px">mdi-facebook-box</v-icon>
                                                        </a>
                                                        <a class="mx-4 white--text" icon href="{{ route('social.auth', 'google') }}">
                                                            <v-icon size="40px">mdi-google</v-icon>
                                                        </a>
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
                                                            <a class="mx-4 white--text" icon href="{{ route('social.auth', 'facebook') }}">
                                                                <v-icon size="40px">mdi-facebook-box</v-icon>
                                                            </a>
                                                            <a class="mx-4 white--text" icon href="{{ route('social.auth', 'google') }}">
                                                                <v-icon size="40px">mdi-google</v-icon>
                                                            </a>
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
                                                                <v-btn
                                                                    color="light"
                                                                    small
                                                                    @click.stop="dialog = true"
                                                                >
                                                                    Términos y Condiciones
                                                                </v-btn>
                                                            </div>
                                                        </v-flex>
                                                    </v-card-actions>
                                                    <v-flex justify-center style="text-align:center">
                                                        <small style='color :red; font-size:0.8rem' v-if="btn_registro==true">*Es necesario aceptar los Términos y Condiciones para registrarte.</small>
                                                        <small style='color :green; font-size:0.8rem' v-else>Gracias por aceptar nuestros Términos y Condiciones !</small>
                                                    </v-flex>
                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-flex justify-center>
                                                            <v-btn class='color: yellow darken-2'
                                                                style='color : #9F9E9D' type="submit" :disabled="btn_registro">
                                                                Registrarte</v-btn>
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

        <v-row justify="center">
            <v-dialog
            v-model="dialog"
            max-width="60%"
          >
            <v-card>
              <v-card-title class="headline green accent-2" style='color : #9F9E9D'>TÉRMINOS Y CONDICIONES</v-card-title>
              <v-divider></v-divider>
              <v-card-text>
                <strong>Si usted desea acceder a nuestros servicios, deberá cumplir con los siguientes lineamientos:</strong><br><br>
                <strong>Sobre el servicio:</strong><br><hr><br>
                <li>Al ir al establecimiento en recoger su canasta de productos, debe cumplir con las medidas sanitarias, como portar mascarilla, guantes, y respetar la cola de 2 metros.</li><br>
                <li>Si va a adquirir los productos mostrados como mínimo deben ser de 15 productos diferentes a más.</li><br>
                <li>La lista de compras se tiene que realizar con 1 día de anticipación. Y si desea cancelar la solicitud que sea en un lapso de 24 horas contando desde el envió de su lista.</li><br>
                <li>Realizara una lista de compras como solicitud de productos y posteriormente esperar su confirmación.</li><br>
                <li>Si su lista de compra es aceptada, se habilitará los horarios disponibles, hasta un máximo de 25 personas por intervalo de horario.</li><br>
                <li>Se realizará el pago en efectivo al momento de recoger su canasta de víveres.</li><br>
                <li>En el momento de recoger su canasta de víveres deberá presentar su código.</li><br>
                <li>No podrá cancelar una lista de pedido después de haber confirmado el horario de recojo.</li><br>
                <li>Los usuarios que no recojan sus productos, se le deniega el acceso por un tiempo de 2 meses.</li><br><hr><br>
                <strong>Acceso y usos:</strong><br>
                <li>La Aplicación está dirigida exclusivamente a usuarios residentes en Perú. Los usuarios que residan en el extranjero y que decidan acceder y/o utilizar esta Aplicación, lo harán bajo su propia responsabilidad debiendo asegurarse de que tal acceso y/o utilización cumple con la legislación local aplicable.</li><br>
                <li>El Usuario podrá acceder a la Aplicación de forma libre y gratuita, además reconoce y acepta que el acceso y uso de la Aplicación tiene lugar libre y conscientemente, bajo su exclusiva responsabilidad. El Usuario únicamente podrá acceder a la Aplicación a través de los medios autorizados.</li><br><hr><br>
                <strong>Sobre los datos recopilados de datos:</strong><br>
                <li>Como usuario de esta Aplicación, ponemos en su conocimiento que los datos que recopilamos son utilizados única y exclusivamente para garantizar el buen funcionamiento de la misma y estos no se comparten ni revelan a terceros sin su respectiva autorización.</li><br>
                <li>La recopilación de datos se obtiene de la Información que usted nos proporciona: Para poder hacer uso de algunos de nuestros servicios, usted necesita proporcionarnos datos personales como: Correo electrónico, Número de celular, Apellidos y nombres y Tipo y número de documento de identidad.</li><br>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn
                  color="green darken-1"
                  text
                  @click="tyc(false,true)"
                >
                  No acepto
                </v-btn>

                <v-btn
                  color="green accent-2"
                  @click="tyc(false,false)"
                  style='color : #9F9E9D'
                >
                  Acepto
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-row>


    </v-app>

    <script>
        function mostrar_navbar() {
            document.querySelector('.nav-fostrap').classList.toggle('visible');
        };
    </script>
</body>
