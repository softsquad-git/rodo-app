require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { BootstrapVue } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(BootstrapVue)
Vue.use(VueSweetalert2);
Vue.prototype.$axios = window.axios;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('settings-component', require('./components/settings/SettingsComponent.vue').default);

const app = new Vue({
    el: '#app',
});
