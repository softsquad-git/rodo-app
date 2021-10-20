<template>
<form method="post">
    <div class="row">
        <div class="col-md-5 col-12">
            <label for="name" class="form-label">Nazwa</label>
            <input type="text" id="name" class="form-control" v-model="data.name">
        </div>
        <div class="col-md-3 col-12">
            <label for="location" class="form-label">Obszar nadrzędny</label>
            <select id="location" class="form-control" v-model="data.location_id">
                <option v-for="processingArea in processing_areas" :value="processingArea.id">{{ processingArea.name }}</option>
            </select>
        </div>
        <div class="col-md-4 col-12">
            <label class="form-label">Zabezpieczenia</label>
            <label class="w-100 form-check-label" v-for="security in securities" :for="security.id"><input :id="security.id" type="checkbox" v-model="data.security_ids" class="form-check-input" :value="security.id"> {{ security.name }}</label>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <button type="button" @click="save" class="btn btn-outline-primary btn-sm">Zapisz</button>
            <a href="/inspector/processing-areas/" class="btn btn-outline-danger btn-sm">Anuluj</a>
        </div>
    </div>
</form>
</template>

<script>
export default {
    name: "ProcessingAreaFormComponent",
    data() {
        return {
            data: {
                name: '',
                security_ids: [],
                location_id: ''
            },
            processing_areas: []
        }
    },
    props: {
        securities: '',
        save_url: ''
    },
    methods: {
        save() {
            this.$axios.post(this.save_url, this.data)
            .then((data) => {
                if (data.data.success === 1) {

                }
            }).catch((error) => {

            })
        },
        loadProcessingAreas() {
            this.$axios.get('/inspector/api/processing-areas')
            .then((data) => {
                this.processing_areas = data.data.data;
            })
        }
    },
    created() {
        this.securities = JSON.parse(this.securities);
        this.loadProcessingAreas();
    }
}
</script>

<style scoped>

</style>
