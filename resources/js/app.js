/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('departamento-component', require('./components/Departamento.vue').default);
Vue.component('sucursal-component', require('./components/Sucursal.vue').default);
Vue.component('empresa-component', require('./components/Empresa.vue').default);
Vue.component('usuario-component', require('./components/Usuario.vue').default);
Vue.component('equipo-component', require('./components/Equipo.vue').default);
Vue.component('cuenta-component', require('./components/Cuenta.vue').default);
Vue.component('categoria-component', require('./components/Categoria.vue').default);
Vue.component('principal-component', require('./components/Principal.vue').default);
Vue.component('administradores-component', require('./components/Administradores.vue').default);
Vue.component('nota-component', require('./components/Nota.vue').default);
Vue.component('servicio-component', require('./components/Servicio.vue').default);
Vue.component('servidores-component', require('./components/Servidores.vue').default);

Vue.component('wifi-component', require('./components/Wifi.vue').default);
Vue.component('red-component', require('./components/Red.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    data: {
        menu: 0,
    }
});