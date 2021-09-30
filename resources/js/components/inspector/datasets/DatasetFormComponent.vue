<template>
<form method="POST">
    <div class="row">
        <div class="col-md-4 col-12">
            <label for="name" class="form-label">Nazwa</label>
            <input type="text" class="form-control" id="name" v-model="data.name">
        </div>
        <div class="col-md-3 col-12">
            <label for="type" class="form-label">Typ</label>
            <select id="type" class="form-control" v-model="data.type_id">
                <option v-for="type in types" :value="type.id">{{ type.name }}</option>
            </select>
        </div>
        <div class="col-md-3 col-12">
            <label for="type2" class="form-label">Rodzaj</label>
            <select id="type2" class="form-control" v-model="data.type_2_id">
                <option v-for="type2 in types2" :value="type2.id">{{ type2.name }}</option>
            </select>
        </div>
        <div class="col-md-2 col-12">
            <label for="status" class="form-label">Status</label>
            <select id="status" class="form-control" v-model="data.status_id">
                <option v-for="status in statuses" :value="status.id">{{ status.name }}</option>
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3 col-12">
            <label for="category_people" class="form-label">Kategoria osoób</label>
            <select class="form-control" id="category_people" v-model="data.category_people_id">
                <option v-for="categoryPeople in categoriesPeople" :value="categoryPeople.id">{{ categoryPeople.name }}</option>
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <label for="content" class="form-label">Opis zbioru</label>
            <ckeditor :editor="editor" v-model="data.description"></ckeditor>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3 col-12">
            <label for="areas_processing" class="form-label">Obszary przetwarzania</label>

        </div>
        <div class="col-md-3 col-12">
            <label for="system_it" class="form-label">System IT</label>
            <select id="system_id" class="form-control" v-model="data.system_id">
                <option v-for="system in systemsId" :value="system.id">{{ system.name }}</option>
            </select>
        </div>
        <div class="col-md-3 col-12">
            <label for="resources" class="form-label">Zasoby</label>

        </div>
        <div class="col-md-3 col-12">
            <label for="law_basics" class="form-label">Podstawy prawne</label>

        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3 col-12">
            <label for="processing" class="form-label">Przetwarzanie</label>
            <select class="form-control" id="processing" v-model="data.processing">
                <option v-for="(process, key) in processing" :value="key">{{ process }}</option>
            </select>
        </div>
        <div class="col-md-3 col-12">
            <label for="data_retention" class="form-label">Retencja danych</label>
            <input type="text" class="form-control" id="data_retention" v-model="data.data_retention_set">
        </div>
        <div class="col-md-4 col-12">
            <label for="data_source" class="form-label">Źródło danych</label>
            <input type="text" class="form-control" id="data_source" v-model="data.data_source">
        </div>
        <div class="col-md-2 col-12">
            <label for="estimated_data" class="form-label">Szacowana ilość danych</label>
            <input type="text" class="form-control" id="estimated_data" v-model="data.estimated_data">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6 col-12">
            <label for="purpose_processing" class="form-label">Cel przetwarzania</label>
            <textarea id="purpose_processing" v-model="data.purpose_processing" rows="3" class="form-control"></textarea>
        </div>
        <div class="col-md-6 col-12">
            <label for="attachments" class="form-label">Załączniki</label>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <button type="button" @click="save" class="btn btn-outline-primary btn-sm">Zapisz</button>
            <a href="/inspector/datasets/" class="btn btn-outline-danger btn-sm">Anuluj</a>
        </div>
    </div>
</form>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    name: "DatasetFormComponent",
    data() {
        return {
            data: {
                name: '',
                type_id: '',
                type_2_id: '',
                category_people_id: '',
                category_data: '',
                category_data_description: '',
                description: '',
                purpose_processing: '',
                data_retention_set: '',
                data_source: '',
                processing: '',
                estimated_data: '',
                status_id: '',
                system_id: ''
            },
            types: [],
            types2: [],
            categoriesPeople: [],
            statuses: [],
            editor: ClassicEditor,
            systemsId: []
        }
    },
    props: {
        save_url: '',
        categories_data: '',
        processing: ''
    },
    methods: {
        save() {

        },
        loadStatuses() {
            this.$axios.get(`/inspector/api/get-statuses?resource_type=datasets`)
                .then((data) => {
                    this.statuses = data.data.data;
                }).catch((error) => {
                //
            })
        },
        loadTypes() {
            this.$axios.get(`/administration/api/settings/types?resource_type=datasets`)
                .then((data) => {
                    this.types = data.data.data;
                })
        },
    },
    created() {
        this.processing = JSON.parse(this.processing)
    }
}
</script>

<style scoped>

</style>
