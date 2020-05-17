require('./bootstrap');

window.Vue = require('vue');

// LOAD VUETIFY
import Vuetify from 'vuetify'
Vue.use(Vuetify);
// import BootstrapVue from 'bootstrap-vue' //Importing

// Vue.use(BootstrapVue) // Telling Vue to use this in whole application

//REGISTRO DE COMPONENTES
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('navbar-component', require('./components/NavBarComponent.vue').default);
Vue.component('inicio', require('./components/Inicio.vue').default);
Vue.component('pie', require('./components/Footer.vue').default);
Vue.component('perfil', require('./components/Perfil.vue').default);
Vue.component('inicio-sesion', require('./components/Inicio-sesion.vue').default);
Vue.component('registro', require('./components/Registro.vue').default);


const app = new Vue({
    el: '#app',
    //añade la instancia de Vuetify como parámetro en la de Vue
    vuetify: new Vuetify(),
});
