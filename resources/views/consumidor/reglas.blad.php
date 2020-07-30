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
</head>
<body>
    <v-app id="app">
        <template>
        <v-container>
          <v-row>
            <v-col cols="12">
              <h1 class="headline">REglas del servicio</h1>
              <v-divider class="green accent-2"></v-divider>
            </v-col>
            <v-col cols="12" md="12">
                <ul>
                    <li>
                    Los productos que se encontraran son solo alimentos más no ropa, productos de limpieza, entre otros.
                    </li>
                    <li>
                    El catálogo que se encuentra se presenta serán los productos más demandados por el mercado. 
                    </li>
                    <li>
                    El consumidor debe realizar la solicitud de la lista de compras como máximo 24 horas de anticipación para que el comerciante pueda tener listo su canasta de víveres al día siguiente. 
                    </li>
                    <li>
                    El consumidor debe adquirir como mínimo 15 alimentos diferentes y la cantidad que desee.
                    </li>
                    <li>
                    El consumidor debe esperar las respuestas de los comerciantes parara ir a recoger. 
                    </li>
                    <li>
                    El consumidor podrá escoger un horario propuesto por el servicio y obtener un cupo. Los cupos para cada día son 40. 
                    </li>
                    <li>
                    El consumidor podrá cambiar de horario solamente cuando el comerciante no haya aceptado los alimentos requeridos. 
                    </li>
                    <li>
                    El pago por ahora es efectivo y tendrá que recogerlo en el puesto que escogió para ello debe verificar el número de puesto.
                    </li>
                    <li>
                    El consumidor debe presentar su código para ir a recoger su canasta de víveres.
                    </li>
                    <li>
                    Al momento de ir a recoger debe respetar las medidas sanitarias establecidas como respetar la cola 1.5 m, uso de la mascarilla y protector facial.
                    </li>
                    <li>
                    El consumidor que no recoja la canasta de víveres se le denegara el acceso por un periodo. 
                    </li>

                </ul>
            </v-col>
          </v-row>
        </v-container>
        </template>
    </v-app>

</body>
</html>
