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
            <label for="category_people" class="form-label">Kategoria osób</label>
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
            <multiselect
                v-model="data.processing_area_ids"
                label="name"
                :multiple="true"
                placeholder="Wybierz"
                :internal-search="false"
                track-by="name"
                :options="processingAreas">
            </multiselect>
        </div>
        <div class="col-md-3 col-12">
            <label for="system_it" class="form-label">System IT</label>
            <multiselect
                v-model="data.system_it_ids"
                label="name"
                :multiple="true"
                placeholder="Wybierz"
                :internal-search="false"
                track-by="name"
                :options="systemsId">
            </multiselect>
        </div>
        <div class="col-md-3 col-12">
            <label for="resources" class="form-label">Zasoby</label>
            <multiselect
                v-model="data.resource_ids"
                label="name"
                :multiple="true"
                placeholder="Wybierz"
                :internal-search="false"
                track-by="name"
                :options="resources">
            </multiselect>
        </div>
        <div class="col-md-3 col-12">
            <label for="law_basics" class="form-label">Podstawy prawne</label>
            <multiselect
                v-model="data.law_basic_ids"
                label="name"
                :multiple="true"
                placeholder="Wybierz"
                :internal-search="false"
                track-by="name"
                :options="basicLaw">
            </multiselect>
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
import Multiselect from 'vue-multiselect'
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
                system_it_ids: '',
                processing_area_ids: [],
                law_basic_ids: [],
                resource_ids: []
            },
            types: [],
            types2: [],
            categoriesPeople: [],
            statuses: [],
            editor: ClassicEditor,
            systemsId: [],
            processingAreas: [],
            basicLaw: [],
            resources: []
        }
    },
    components: {
        Multiselect
    },
    props: {
        save_url: '',
        categories_data: '',
        processing: ''
    },
    methods: {
        save() {
            console.log(this.data.processing_area_ids)
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
        loadProcessingAreas() {
            this.$axios.get('/inspector/api/processing-areas')
                .then((data) => {
                    this.processingAreas = data.data.data;
                })
        },
        loadItSystems() {
            this.$axios.get(`/inspector/api/assets/system-it`)
            .then((data) => {
                this.systemsId = data.data.data;
            })
        },
        loadLawBasic() {
            this.$axios.get(`/inspector/api/rcp/law-basic`)
            .then((data) => {
                this.basicLaw = data.data.data;
            })
        },
        loadResources() {
            this.$axios.get(`/inspector/api/assets/resources?type=`)
            .then((data) => {
                this.resources = data.data.data;
            })
        }
    },
    created() {
        this.processing = JSON.parse(this.processing);
        this.loadProcessingAreas();
        this.loadItSystems();
        this.loadLawBasic();
        this.loadResources();
    }
}
</script>

<style scoped>

</style>
