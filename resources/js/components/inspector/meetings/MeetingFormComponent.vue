<template>
    <form method="POST">
        <div class="row">
            <div class="col-md-9 col-12">
                <label for="title" class="form-label">Tytuł</label>
                <input type="text" class="form-control" v-model="data.title" id="title">

                <label for="content" class="form-label mt-3">Opis</label>
                <ckeditor :editor="editor" v-model="data.content"></ckeditor>
            </div>
            <div class="col-md-3 col-12">
                <label for="status" class="form-label">Status</label>
                <select v-model="data.status_id" class="form-control" id="status">
                    <option v-for="status in statuses" :value="status.id">{{ status.name }}</option>
                </select>

                <label for="participants" class="form-label mt-3">Uczestnicy</label>
                <multiselect
                    v-model="data.participants"
                    :options="participants"
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
                <a href="/inspector/meetings/" class="btn btn-outline-danger btn-sm">Anuluj</a>
            </div>
        </div>
    </form>
</template>

<script>
import Multiselect from 'vue-multiselect'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    name: "MeetingFormComponent",
    components: { Multiselect },
    data() {
        return {
            data: {
                title: '',
                content: '',
                status_id: '',
                participants: []
            },
            statuses: [],
            participants: [],
            editor: ClassicEditor
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
                        window.location.href = '/inspector/meetings'
                    }
                })
        },
        loadStatuses() {
            this.$axios.get(`/inspector/api/get-statuses?resource_type=meeting`)
                .then((data) => {
                    this.statuses = data.data.data;
                }).catch((error) => {
                //
            })
        },
        loadParticipants() {
            this.$axios.get('/inspector/api/meetings/get-participants')
            .then((data) => {
                this.participants = data.data.data;
            })
        }
    },
    created() {
        this.loadStatuses();
        this.loadParticipants();
    }
}
</script>

<style scoped>

</style>
