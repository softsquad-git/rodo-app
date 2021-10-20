<template>
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-5 col-12">
                <label for="name" class="form-label">Nazwa</label>
                <input type="text" class="form-control" v-model="data.name" id="name">
            </div>
            <div class="col-md-3 col-12">
                <label for="type" class="form-label">Rodzaj dokumentu</label>
                <select class="form-control" id="type" v-model="data.type_id">
                    <option v-for="type in types" :value="type.id">{{ type.name }}</option>
                </select>
            </div>
            <div class="col-md-2 col-12">
                <label for="valid_from" class="form-label">Ważny od</label>
                <input type="datetime-local" class="form-control" id="valid_from" v-model="data.valid_from">
            </div>
            <div class="col-md-2 col-12">
                <label for="valid_to" class="form-label">Ważny do</label>
                <input type="datetime-local" class="form-control form-control-sm" :disabled="!!data.is_indefinitely"
                       id="valid_to" v-model="data.valid_to">
                <label for="is_indefinitely" class="w-100"><input type="checkbox" id="is_indefinitely"
                                                                  v-model="data.is_indefinitely"> Ważny
                    bezterminowo</label>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-md-12">
                <label for="description" class="form-label">Opis dokumentu</label>
                <textarea v-model="data.description" class="form-control editor" id="description"></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-3 col-12">
                <label for="status" class="form-label">Status</label>
                <select v-model="data.status_id" class="form-control" id="status">
                    <option v-for="status in statuses" :value="status.id">{{ status.name }}</option>
                </select>
            </div>
            <div class="col-md-3 col-12">
                <label for="is_required_confirmation" class="form-label">Wymagane przeczytanie</label>
                <div class="mt-2">
                    <label for="confirmation_y"><input id="confirmation_y" type="radio"
                                                       v-model="data.is_required_confirmation" value="1"
                                                       name="is_required_confirmation"> Tak</label>
                    <label for="confirmation_n"><input id="confirmation_n" type="radio"
                                                       v-model="data.is_required_confirmation" value="0"
                                                       name="is_required_confirmation"> Nie</label>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <label for="department" class="form-label">Działy</label>
                <multiselect
                    :options="departments"
                    v-model="departmentModel"
                    track-by="id"
                    label="name"
                    :multiple="true"
                ></multiselect>
            </div>
            <div class="col-md-3 col-12">
                <label for="file" class="form-label">Załącznik (pdf)</label>
                <input type="file" v-on:change="changeFile" class="form-control" ref="file" id="file">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <button type="button" @click="save" class="btn btn-outline-primary btn-sm">Zapisz</button>
                <a href="/inspector/documents/" class="btn btn-outline-danger btn-sm">Anuluj</a>
            </div>
        </div>
    </form>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
    name: "DocumentFormComponent",
    components: { Multiselect },
    data() {
        return {
            data: {
                type_id: '',
                name: '',
                description: '',
                valid_from: '',
                valid_to: '',
                is_indefinitely: '',
                is_required_confirmation: '',
                status_id: '',
                file: '',
                attachments: [{
                    type_id: '',
                    file: ''
                }],
                department_ids: []
            },
            statuses: [],
            types: [],
            departments: []
        }
    },
    props: {
        save_url: ''
    },
    methods: {
        save() {
            let formData = new FormData();
            formData.append('type_id', this.data.type_id);
            formData.append('name', this.data.name);
            formData.append('description', this.data.description);
            formData.append('valid_from', this.data.valid_from);
            formData.append('valid_to', this.data.valid_to);
            formData.append('is_indefinitely', this.data.is_indefinitely);
            formData.append('is_required_confirmation', this.data.is_required_confirmation);
            formData.append('status_id', this.data.status_id);
            formData.append('file', this.data.file, this.data.file.name);
            formData.append('department_ids', JSON.stringify(this.data.department_ids));

            this.$axios.post(this.save_url, formData)
                .then((data) => {

                }).catch((error) => {

            })
        },
        loadTypes() {
            this.$axios.get(`/administration/api/settings/types?resource_type=document`)
                .then((data) => {
                    this.types = data.data.data;
                })
        },
        loadStatuses() {
            this.$axios.get(`/inspector/api/get-statuses?resource_type=document`)
                .then((data) => {
                    this.statuses = data.data.data;
                }).catch((error) => {
                //
            })
        },
        changeFile(e) {
            this.data.file = e.target.files[0]
        },
        loadDepartments() {
            this.$axios.get(`/inspector/api/departments`)
            .then((data) => {
                this.departments = data.data.data;
                console.log(data.data.data)
            })
        },
    },
    computed: {
        departmentModel: {
            get() {
                return this.departments.filter(department => this.data.department_ids.includes(department.id));
            },
            set(val) {
                this.data.department_ids = val.map(department => department.id);
            }
        }
    },
    created() {
        this.loadTypes();
        this.loadStatuses();
        this.loadDepartments();
    }
}
</script>

<style scoped>

</style>
