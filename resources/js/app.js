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

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('menu-principal', require('./components/Menu.vue').default);
Vue.component('entidad', require('./components/Entidad.vue').default);
Vue.component('facturacion', require('./components/Facturacion.vue').default);
Vue.component('contabilidad', require('./components/Contabilidad.vue').default);
Vue.component('personas', require('./components/Personas.vue').default);
Vue.component('activos', require('./components/contabilidad/Activos.vue').default);
Vue.component('Proveedores', require('./components/facturacion/Proveedores.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
        menu:0
    }
});
