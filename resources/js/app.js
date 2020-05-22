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

Vue.component('navbar-component', require('./components/NavBarComponent.vue').default);
Vue.component('inicio', require('./components/Inicio.vue').default);
Vue.component('pie', require('./components/Footer.vue').default);
Vue.component('perfil', require('./components/Perfil.vue').default);
Vue.component('inicio-sesion', require('./components/Inicio-sesion.vue').default);
Vue.component('registro', require('./components/Registro.vue').default);
Vue.component('registro-puesto', require('./components/RegistroPuesto.vue').default);
Vue.component('consumidores', require('./components/Administrador/Consumidores.vue').default);
Vue.component('comerciantes', require('./components/Administrador/Comerciantes.vue').default);
Vue.component('home-consumidor', require('./components/Consumidor/Home.vue').default);
Vue.component('home-comerciante', require('./components/Comerciante/Home.vue').default);


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
    }),
    methods: {
        tyc(bool1, bool2) {
            let me = this;
            me.dialog = bool1;
            me.btn_registro = bool2;
        }
    }
});
