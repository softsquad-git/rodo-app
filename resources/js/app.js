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
Vue.component('clients-list-component', require('./components/admin/clients/ClientsListComponent.vue').default);
Vue.component('users-list-component', require('./components/admin/users/UsersListComponent.vue').default);
Vue.component('trainings-list-groups-component', require('./components/admin/trainings/groups/TrainingsListGroupsComponent.vue').default);
Vue.component('roles-list-component', require('./components/admin/roles/RolesListComponent.vue').default);
Vue.component('trainings-list-component', require('./components/admin/trainings/TrainingsListComponent.vue').default);
Vue.component('admin-tests-list-component', require('./components/admin/trainings/tests/AdminTestsListComponent.vue').default);
Vue.component('admin-test-questions-list-component', require('./components/admin/trainings/tests/questions/AdminTestQuestionsListComponent.vue').default);
Vue.component('admin-test-question-form-component', require('./components/admin/trainings/tests/questions/AdminTestQuestionFormComponent.vue').default);
Vue.component('certificates-patters-list-component', require('./components/admin/certificates/CertificatesPattersListComponent.vue').default);
Vue.component('certificates-list-component', require('./components/admin/certificates/CertificatesListComponent.vue').default);
Vue.component('invoices-list-component', require('./components/admin/invoices/InvoicesListComponent.vue').default);
Vue.component('invoices-settings-list-component', require('./components/admin/invoices/InvoicesSettingsListComponent.vue').default);

Vue.component('inspector-tasks-list-component', require('./components/inspector/tasks/TasksListComponent.vue').default);

const app = new Vue({
    el: '#app',
});
