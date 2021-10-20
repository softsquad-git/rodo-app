<template>
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4 col-12">
                <label for="first_name" class="form-label">Imię</label>
                <input type="text" class="form-control" v-model="data.first_name" id="first_name">
            </div>
            <div class="col-md-4 col-12">
                <label for="last_name" class="form-label">Nazwisko</label>
                <input type="text" class="form-control" v-model="data.last_name" id="last_name">
            </div>
            <div class="col-md-4 col-12">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" v-model="data.email" id="email">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4 col-12">
                <label for="hr_id" class="form-label">Identyfikator kadrowy</label>
                <input type="text" class="form-control" v-model="data.hr_id" id="hr_id">
            </div>
            <div class="col-md-4 col-12">
                <label for="it_id" class="form-label">Identyfikator IT</label>
                <input type="text" class="form-control" v-model="data.it_id" id="it_id">
            </div>
            <div class="col-md-4 col-12">
                <label for="position" class="form-label">Stanowisko</label>
                <input type="text" class="form-control" v-model="data.position" id="position">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-9 col-12">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <label for="client" class="form-label">Klient</label>
                        <select class="form-control" v-model="data.client_id" id="client">
                            <option v-for="client in clients" :value="client.id">{{ client.name }}</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="role" class="form-label">Rola</label>
                        <select class="form-control" v-model="data.role_id" id="role">
                            <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="type_contract" class="form-label">Rodzaj umowy</label>
                        <select class="form-control" v-model="data.type_contract_id" id="type_contract">
                            <option v-for="typeContract in typesContract" :value="typeContract.id">{{ typeContract.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-7 col-12">
                        <label for="comments" class="form-label">Komentarz</label>
                        <textarea v-model="data.comments" rows="4" id="comments" class="form-control"></textarea>
                    </div>
                    <div class="col-md-5 col-12">
                        <label for="end_date_contract" class="form-label">Data końca umowy</label>
                        <input type="date" class="form-control form-control-sm" :readonly="!!data.is_contract_indefinite_period" v-model="data.end_date_contract" id="end_date_contract">
                        <label for="is_contract_indefinite_period" class="w-100"><input type="checkbox" value="1" id="is_contract_indefinite_period" v-model="data.is_contract_indefinite_period"> Umowa na czas nieokreślony</label>

                        <!--attachments-->
                        <label for="docs" class="form-label mt-3">Dokumenty</label>
                        <div v-for="(doc, index) in data.attachments" class="row mb-1">
                            <div class="col-sm-12">
                                <input type="text" class="form-control-alt form-control br-0 form-control-sm" placeholder="Tytuł" v-model="doc.title">
                            </div>
                            <div class="col-sm-4 pr-0">
                                <select v-model="doc.type_id" class="form-control br-0 form-control-alt form-control-sm">
                                    <option value="" selected>Rodzaj</option>
                                    <option v-for="typeDoc in typesAttachment" :value="typeDoc.id">{{ typeDoc.name }}</option>
                                </select>
                            </div>
                            <div class="col-sm-8 pl-0">
                                <input type="file" class="form-control-sm br-0 form-control form-control-alt">
                            </div>
                            <span class="cursor" v-if="data.attachments.length > 1" @click="removeAttachment(index)" style="font-size: 13px;color: #f83e3e;"> <i class="fa fa-trash"></i> Usuń</span>
                        </div>
                        <span class="cursor" @click="addAttachment" style="font-size: 13px;color: #4c78dd;"> <i class="fa fa-plus"></i> Dodaj</span>

                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <label for="departments" class="form-label mt-3">Przypisane działy</label>
                <label v-for="department in departments" class="form-check-label w-100" :for="'department'+department.id"><input type="checkbox" class="form-check-input" v-model="data.department_ids" :value="department.id" :id="'department'+department.id"> {{ department.name }}</label>
            </div>

        </div>
        <div class="row mt-3">
            <div class="col-12">
                <button type="button" @click="save" class="btn btn-outline-primary btn-sm">Zapisz</button>
                <a href="/inspector/employees/" class="btn btn-outline-danger btn-sm">Anuluj</a>
            </div>
        </div>
    </form>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
    name: "EmployeesFormComponent",
    components: { Multiselect },
    data() {
        return {
            data: {
                first_name: '',
                last_name: '',
                email: '',
                hr_id: '',
                it_id: '',
                role_id: '',
                position: '',
                client_id: '',
                department_ids: [],
                type_contract_id: '', // rodzaj umowy,
                end_date_contract: '',
                is_contract_indefinite_period: '',
                comments: '',
                attachments: [{
                    title: '',
                    type_id: '',
                    file: ''
                }]
            },
            roles: [],
            clients: [],
            departments: [],
            typesContract: [],
            typesAttachment: []
        }
    },
    props: {
        type: '',
        save_url: '',
        redirect_url: ''
    },
    methods: {
        save() {
            this.$axios.post(this.save_url, this.data)
            .then((data) => {
                if (data.data.success === 1) {
                    return window.location.href = this.redirect_url;
                }
            }).catch((error) => {
                //
            })
        },
        loadRoles() {
            this.$axios.get('/administration/api/roles')
            .then((data) => {
                this.roles = data.data.data;
            })
        },
        loadClients() {
            this.$axios.get(`/administration/api/clients`)
            .then((data) => {
                this.clients = data.data.data;
            })
        },
        loadDepartments() {
            this.$axios.get('/inspector/api/departments/')
            .then((data) => {
                this.departments = data.data.data;
            })
        },
        loadTypesContract() {
            this.$axios.get(`/administration/api/settings/types?resource_type=contract`)
            .then((data) => {
                this.typesContract = data.data.data;
            }).catch((error) => {

            })
        },
        loadTypesAttachment() {
            this.$axios.get(`/administration/api/settings/types?resource_type=employee_attachment`)
                .then((data) => {
                    this.typesAttachment = data.data.data;
                }).catch((error) => {

            })
        },
        addAttachment() {
            this.data.attachments.push({
                title: '',
                file: '',
                type_id: ''
            })
        },
        removeAttachment(index) {
            this.data.attachments.splice(index, 1);
        }
    },
    created() {
        this.loadRoles();
        this.loadClients();
        this.loadDepartments();
        this.loadTypesContract();
        this.loadTypesAttachment();
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.pr-0{padding-right: 0!important;}
.pl-0{padding-left: 0!important;}
.br-0{border-radius: 0!important;}
.cursor:hover{cursor: pointer!important;}

</style>
