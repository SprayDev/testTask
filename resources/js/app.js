/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue'; //Importing
import Vuelidate from 'vuelidate';
import VueHtml2Canvas from 'vue-html2canvas';
import '@babel/polyfill';

Vue.use(BootstrapVue); // Telling Vue to use this in whole application
Vue.use(Vuelidate);
Vue.use(VueHtml2Canvas);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('table-docs', require('./components/TableDocs.vue').default);
Vue.component('calculator', require('./components/caclulator.vue').default);
Vue.component('tracking', require('./components/tracking.vue').default);
Vue.component('add-doc', require('./components/addDocument.vue').default);
Vue.component('get-doc', require('./components/getDocument.vue').default);
Vue.component('profile', require('./components/profile.vue').default);
Vue.component('message', require('./components/message.vue').default);
Vue.component('vuetify-select', require('./components/VuetifySelect.vue').default);
Vue.component('print-doc', require('./components/printedDoc.vue').default);
Vue.component('tabtest', require('./components/tabtest.vue').default);
Vue.component('graph', require('./components/graph.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import vuetify from './vuetify';

const app = new Vue({
    el: '#app'
});
