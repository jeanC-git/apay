require('./bootstrap');
//IMPORT SWAL
import Swal from 'sweetalert2'
window.Swal = Swal;
window.Vue = require('vue');
// LOAD VUETIFY
import Vuetify from 'vuetify'
Vue.use(Vuetify);
//REGISTRO DE COMPONENTES
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//REGISTRO DE COMPONENTES LIBRES
Vue.component('inicio', require('./components/Inicio.vue').default);
Vue.component('pie', require('./components/Footer.vue').default);
Vue.component('inicio-sesion', require('./components/Inicio-sesion.vue').default);
Vue.component('registro', require('./components/Registro.vue').default);

// Vue.component('informacion', require('./components/Consumidor/InfoPersonal.vue').default);
//REGISTRO DE COMPONENTES SOLO PARA EL COMERCIANTE
Vue.component('registro-puesto', require('./components/Comerciante/RegistroPuesto.vue').default);
Vue.component('home-comerciante', require('./components/Comerciante/Home.vue').default);
Vue.component('productos', require('./components/Comerciante/Mis-productos.vue').default);
Vue.component('notificaciones-comerciante', require('./components/Comerciante/NotificacionesComerciante.vue').default);
Vue.component('lista-pendiente', require('./components/Comerciante/ListasPuesto.vue').default);
Vue.component('reporte-comer', require('./components/Comerciante/Reporte-Comerciante.vue').default);

//REGISTRO DE COMPONENTES SOLO PARA EL CONSUMIDOR
Vue.component('home-consumidor', require('./components/Consumidor/Home.vue').default);
Vue.component('catalogo', require('./components/Consumidor/Catalogo.vue').default);
Vue.component('informacion-personal', require('./components/Consumidor/InfoPersonal.vue').default);
Vue.component('historial-listas', require('./components/Consumidor/Historial.vue').default);
Vue.component('notificaciones-consumidor', require('./components/Consumidor/NotificacionesConsumidor.vue').default);
Vue.component('reglas', require('./components/Consumidor/Reglas.vue').default);

//REGISTRO DE COMPONENTES SOLO PARA EL ADMINISTRADOR
Vue.component('consumidores', require('./components/Administrador/Consumidores.vue').default);
Vue.component('comerciantes', require('./components/Administrador/Comerciantes.vue').default);
Vue.component('precios-admin', require('./components/Administrador/Precios.vue').default);
Vue.component('subida', require('./components/Administrador/SubidaMasiva.vue').default);
Vue.component('reporte-admin', require('./components/Administrador/Reporte-Administrador.vue').default);


const app = new Vue({
    el: '#app',
    //añade la instancia de Vuetify como parámetro en la de Vue
    vuetify: new Vuetify(),
    props: {
        showPassword: false,
        showValidatePassword: false
    },
    data: () => ({
        mostrar_inicio_sesion: true,
        drawer: null,
        dialog: false,
        btn_registro: true,
        snackbar: true,
    }),
    methods: {
        tyc(bool1, bool2) {
            let me = this;
            me.dialog = bool1;
            me.btn_registro = bool2;
        }
    }
});
