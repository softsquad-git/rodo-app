require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import {BootstrapVue} from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(VueSweetalert2);
Vue.prototype.$axios = window.axios;

import CKEditor from '@ckeditor/ckeditor5-vue2';

Vue.use(CKEditor);

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
Vue.component('inspector-departments-list-component', require('./components/inspector/departments/DepartmentsListComponent.vue').default);
Vue.component('inspector-employees-list-component', require('./components/inspector/employees/EmployeesListComponent.vue').default);
Vue.component('inspector-employees-form-component', require('./components/inspector/employees/EmployeesFormComponent.vue').default);
Vue.component('inspector-newsletter-list-component', require('./components/inspector/newsletter/NewsletterListComponent.vue').default);
Vue.component('inspector-documents-list-component', require('./components/inspector/documents/DocumentsListComponent.vue').default);
Vue.component('inspector-documents-form-component', require('./components/inspector/documents/DocumentFormComponent.vue').default);
Vue.component('inspector-applications-conclusions-list-component', require('./components/inspector/applications/ApplicationsConclusionsListComponent.vue').default);
Vue.component('inspector-applications-issues-list-component', require('./components/inspector/applications/issues/ApplicationIssuesListComponent.vue').default);
Vue.component('inspector-applications-issues-form-component', require('./components/inspector/applications/issues/ApplicationIssuesFormComponent.vue').default);
Vue.component('inspector-applications-incidents-list-component', require('./components/inspector/applications/incidents/ApplicationIncidentsListComponent.vue').default);
Vue.component('inspector-applications-incidents-form-component', require('./components/inspector/applications/incidents/ApplicationIncidentsFormComponent.vue').default);
Vue.component('inspector-meetings-list-component', require('./components/inspector/meetings/MeetingListComponent.vue').default);
Vue.component('inspector-meetings-form-component', require('./components/inspector/meetings/MeetingFormComponent.vue').default);
Vue.component('inspector-datasets-form-component', require('./components/inspector/datasets/DatasetFormComponent.vue').default);
Vue.component('inspector-datasets-list-component', require('./components/inspector/datasets/DatasetsListComponent.vue').default);
Vue.component('inspector-risk-analysis-security-list-component', require('./components/inspector/risk_analysis/SecurityListComponent.vue').default);
Vue.component('inspector-assets-system-it-list-component', require('./components/inspector/assets/SystemItListComponent.vue').default);
Vue.component('inspector-rcp-law-basic-list-component', require('./components/inspector/rcp/LawBasicListComponent.vue').default);
Vue.component('inspector-rcp-activity-list-component', require('./components/inspector/rcp/RCPActivityListComponent.vue').default);
Vue.component('inspector-rcp-data-retention-list-component', require('./components/inspector/rcp/RCPDataRetentionListComponent.vue').default);
Vue.component('inspector-processing-areas-list-component', require('./components/inspector/processing_areas/ProcessingAreasListComponent.vue').default);
Vue.component('inspector-processing-area-form-component', require('./components/inspector/processing_areas/ProcessingAreaFormComponent.vue').default);
Vue.component('inspector-trainings-list-component', require('./components/inspector/trainings/TrainingsListComponent.vue').default);
Vue.component('inspector-trainings-tests-list-component', require('./components/inspector/trainings/TrainingsTestsListComponent.vue').default);
Vue.component('inspector-assets-resources-list-component', require('./components/inspector/assets/ResourcesListComponent.vue').default);
Vue.component('inspector-newsletter-mailbox-list-component', require('./components/inspector/newsletter/NewsletterMailboxListComponent.vue').default);

Vue.component('employee-applications-list-component', require('./components/employee/applications/ApplicationListComponent.vue').default);
Vue.component('employee-applications-conclusions-list-component', require('./components/employee/applications/ApplicationConclusionsListComponent.vue').default);
Vue.component('employee-applications-issues-list-component', require('./components/employee/applications/ApplicationIssuesListComponent.vue').default);
Vue.component('employee-applications-incidents-component', require('./components/employee/applications/ApplicationIncidentsListComponent.vue').default);
Vue.component('employee-documents-list-component', require('./components/employee/documents/DocumentsListComponent.vue').default);
Vue.component('employee-permissions-list-component', require('./components/employee/permissions/PermissionsListComponent.vue').default);
Vue.component('employee-trainings-list-component', require('./components/employee/trainings/TrainingsListComponent.vue').default);
Vue.component('employee-trainings-test-list-component', require('./components/employee/trainings/TrainingTestsListComponent.vue').default);
Vue.component('employee-trainings-certificates-list-component', require('./components/employee/trainings/TrainingCertificatesListComponent.vue').default);
Vue.component('employee-training-browser-component', require('./components/employee/trainings/TrainingBrowserPdfComponent.vue').default);

const app = new Vue({
    el: '#app',
});
