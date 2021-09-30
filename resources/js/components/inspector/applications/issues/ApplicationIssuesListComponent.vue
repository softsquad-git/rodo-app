<template>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <div class="block-title"></div>
            <div class="block-options">
                <button @click="isSearchBox ^= true" type="button" title="Szukaj"
                        class="btn-block-option float-right w-auto">
                    <i class="si" :class="isSearchBox ? 'si-magnifier-remove' : 'si-magnifier-add'"></i>
                </button>
                <a :href="create_url" title="Dodaj" class="btn-block-option float-right w-auto">
                    <i class="si si-plus"></i>
                </a>
            </div>
        </div>
        <div class="block-content block-content-full">
            <div class="row mb-3">
                <div class="col-md-1 col-12">
                    <b-form-select v-model="filters.pagination" class="form-control form-control-sm form-control-alt" :options="paginationNumbers"
                                   size="sm"></b-form-select>
                </div>
                <div class="col-md-11 col-12">
                    <div class="row" v-if="isSearchBox">
                        <div class="col-md-1">
                            <input type="text" v-model="filters.id" placeholder="ID" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2">
                            <input type="text" v-model="filters.number" placeholder="Numer" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2 col-12">
                            <input type="date" v-model="filters.date_application" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2 col-12">
                            <input type="text" v-model="filters.name" placeholder="Imię i nazwisko" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-3 col-12">
                            <input type="text" v-model="filters.title" placeholder="Tytuł" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2 col-12">
                            <input type="text" v-model="filters.number_issue" placeholder="Numer sprawy" class="form-control form-control-alt form-control-sm">
                        </div>
                        <div class="col-md-2 mt-3">
                            <select class="form-control-sm form-control form-control-alt" v-model="filters.type_id">
                                <option value="" selected>Rodzaj sprawy</option>
                                <option v-for="type in types" :value="type.id">{{ type.name }}</option>
                            </select>
                        </div>
                        <div class="col-md-2 mt-3">
                            <select class="form-control form-control-alt form-control-sm" v-model="filters.status_id">
                                <option value="" selected>Status</option>
                                <option v-for="status in statuses" :value="status.id">{{ status.name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-danger text-center" v-if="data.data.length < 1">Brak danych do wyśietlenia</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ApplicationIssuesListComponent",
    data() {
        return {
            data: {},
            filters: {
                id: '',
                number: '',
                date_application: '',
                name: '',
                title: '',
                number_issue: '',
                type_id: '',
                status_id: '',
                pagination: 20
            },
            paginationNumbers: [5, 10, 20, 30, 50],
            isSearchBox: false,
            statuses: [],
            types: []
        }
    },
    props: {
        list_url: '',
        create_url: ''
    },
    methods: {
        loadItems(page = 1){
            this.$axios.get(this.list_url+`?page=${page}&id=${this.filters.id}&number=${this.filters.number}&date_application=${this.filters.date_application}&name=${this.filters.name}&title=${this.filters.title}&number_issue=${this.filters.number_issue}&type_id=${this.filters.type_id}&status_id=${this.filters.status_id}&pagination=${this.filters.pagination}`)
            .then((data) => {
                this.data = data.data;
            })
        }
    },
    created() {
        this.loadItems();
    }
}
</script>

<style scoped>

</style>
