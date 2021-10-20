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
                <label for="date_application" class="form-label">Data i godzina złożenia</label>
                <input type="datetime-local" id="date_application" class="form-control" v-model="data.date_application">
            </div>
            <div class="col-md-3 col-12">
                <label for="date_receipt_company" class="form-label">Data wpływu do firmy</label>
                <input type="date" id="date_receipt_company" class="form-control" v-model="data.date_receipt_company">
            </div>
            <div class="col-md-3 col-12">
                <label for="type_author" class="form-label">Rodzaj osoby zgłaszającej</label>
                <select class="form-control" id="type_author" v-model="data.type_author">
                    <option v-for="(typeAuthor, key) in typesAuthor" :value="typeAuthor.key">{{ typeAuthor.name }}</option>
                </select>
            </div>
            <div class="col-md-3 col-12" v-if="data.type_author != 'employee'">
                <label for="author_name" class="form-label">Nazwa osoby zgłaszającej</label>
                <input id="author_name" class="form-control" v-model="data.author_name">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4 col-12">
                <label for="employees" class="form-label">Osoby biorące udział w incydencie</label>
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
            <div class="col-md-4 col-12">
                <label for="activities" class="form-label">Czynności</label>
                <multiselect
                    v-model="data.activities"
                    :options="activities"
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
            <div class="col-md-4 col-12">
                <label for="attachments" class="form-label">Załączniki</label>
                <input type="file" class="form-control" id="attachments" multiple="multiple">
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
    name: "ApplicationIncidentsFormComponent",
    components: { Multiselect },
    data() {
        return {
            data: {
                date_application: '',
                date_receipt_company: '',
                date_writing: '',
                type_author: 'employee',
                author_name: '',
                title: '',
                content: '',
                type_id: '',
                status_id: '',
                activities: [],
                employes: []
            },
            statuses: [],
            types: [],
            typesAuthor: [
                {key: 'employee', name: 'Pracownik'},
                {key: 'subcontractor', name: 'Podwykonawca'},
                {key: 'media', name: 'Media'},
                {key: 'business_partner', name: 'Partner biznesowy'},
                {key: 'third_party', name: 'Osoba trzecia'},
            ],
            employees: [],
            editor: ClassicEditor,
            activities: []
        }
    },
    props: {
        save_url: '',
    },
    methods: {
        save() {
            this.$axios.post(this.save_url, this.data)
            .then((data) => {

            })
        },
        loadStatuses() {
            this.$axios.get(`/inspector/api/get-statuses?resource_type=incident`)
                .then((data) => {
                    this.statuses = data.data.data;
                }).catch((error) => {
                //
            })
        },
        loadTypes() {
            this.$axios.get(`/administration/api/settings/types?resource_type=incident`)
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
    }
}
</script>

<style scoped>

</style>
