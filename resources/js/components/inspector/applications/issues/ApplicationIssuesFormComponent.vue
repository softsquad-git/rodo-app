<template>
<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6 col-12">
            <label for="title" class="form-label">Tytuł</label>
            <input type="text" class="form-control" v-model="data.title" id="title">
        </div>
        <div class="col-md-3 col-12">
            <label for="status" class="form-label">Status</label>
            <select id="status" class="form-control" v-model="data.status_id">
                <option v-for="status in statuses" :value="status.id">{{ status.name }}</option>
            </select>
        </div>
        <div class="col-md-3 col-12">
            <label for="type" class="form-label">Rodzaj</label>
            <select id="type" class="form-control" v-model="data.type_id">
                <option v-for="type in types" :value="type.id">{{ type.name }}</option>
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <label for="content" class="form-label">Opis</label>
            <ckeditor :editor="editor" v-model="data.content"></ckeditor>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-3 col-12">
            <label for="date_application" class="form-label">Data złożenia</label>
            <input type="date" class="form-control" id="date_application" v-model="data.date_application">
        </div>
        <div class="col-md-3 col-12">
            <label for="date_show_writing" class="form-label">Data na piśmie inicjującym sprawę</label>
            <input type="date" class="form-control" id="date_show_writing" v-model="data.date_show_writing">
        </div>
        <div class="col-md-3 col-12">
            <label for="date_receipt_company" class="form-label">Data wpływu do firmy</label>
            <input type="date" class="form-control" id="date_receipt_company" v-model="data.date_receipt_company">
        </div>
        <div class="col-md-3 col-12">
            <label for="name" class="form-label">Imię i nazwisko</label>
            <input type="text" v-model="data.name" class="form-control" id="name">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-3 col-12">
            <label for="number_issue" class="form-label">Numer sprawy</label>
            <input type="text" v-model="data.number_issue" class="form-control" id="number_issue">
        </div>
        <div class="col-md-9 col-12">
            <label for="employees" class="form-label">Osoby biorące udział w sprawie</label>
            <multiselect
                v-model="data.employees"
                :options="employees"
                :multiple="true"
                :close-on-select="false"
                :clear-on-select="false"
                :preserve-search="true"
                label="name"
                track-by="id"
                placeholder="Wybierz z listy"
                :preselect-first="true">
            </multiselect>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <button type="button" @click="save" class="btn btn-outline-primary btn-sm">Zapisz</button>
            <a href="/inspector/applications/issues/" class="btn btn-outline-danger btn-sm">Anuluj</a>
        </div>
    </div>
</form>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import Multiselect from 'vue-multiselect'
export default {
    name: "ApplicationIssuesFormComponent",
    components: { Multiselect },
    data() {
        return {
            data: {
                date_application: '',
                date_show_writing: '',
                date_receipt_company: '',
                name: '',
                title: '',
                number_issue: '',
                status_id: '',
                type_id: '',
                content: '',
                file: '',
                attachments: [],
                employees: []
            },
            statuses: [],
            types: [],
            editor: ClassicEditor,
            employees: []
        }
    },
    props: {
        save_url: ''
    },
    methods: {
        save() {
            this.$axios.post(this.save_url, this.data)
            .then((data) => {
                if (data.data.success === 1) {

                }
            })
        },
        loadStatuses() {
            this.$axios.get(`/inspector/api/get-statuses?resource_type=issues`)
                .then((data) => {
                    this.statuses = data.data.data;
                }).catch((error) => {
                //
            })
        },
        loadTypes() {
            this.$axios.get(`/administration/api/settings/types?resource_type=issues`)
                .then((data) => {
                    this.types = data.data.data;
                })
        },
        loadEmployees() {
            this.$axios.get(`/inspector/api/employees`)
            .then((data) => {
                this.employees =data.data.data;
            })
        }
    },
    created() {
        this.loadStatuses();
        this.loadTypes();
        this.loadEmployees();
    },
}
</script>

<style>
.multiselect__tags {
    display: block;
    padding: 8px 40px 0 8px;
    border-radius: 5px;
    border: 1px solid #e8e8e8;
    background: #fff;
    font-size: 14px;
    height: 38px!important;
    line-height: 18px;
}
</style>
