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
                            <input type="date" v-model="filters.date" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2 col-12">
                            <input type="date" v-model="filters.date_writing" placeholder="Data wpisania" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2 col-12">
                            <select class="form-control-sm form-control form-control-alt" v-model="filters.type_id">
                                <option value="" selected>Osoba kontaktowa</option>

                            </select>
                        </div>
                        <div class="col-md-3">
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

            <div class="alert alert-danger text-center" v-if="data.data.length < 1">Brak danych do wyświetlenia</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ApplicationIncidentsListComponent",
    data() {
        return {
            data: {},
            filters: {
                number: '',
                date: '',
                date_writing: '',
                user_id: '',
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
        loadTypes() {
            this.$axios.get(`/administration/api/settings/types?resource_type=incident`)
                .then((data) => {
                    this.types = data.data.data;
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
        loadItems(page = 1){
            this.$axios.get(this.list_url+`?page=${page}&id=${this.filters.id}&number=${this.filters.number}&date=${this.filters.date}&date_writing=${this.filters.date_writing}&user_id=${this.filters.user_id}&type_id=${this.filters.type_id}&status_id=${this.filters.status_id}&pagination=${this.filters.pagination}`)
                .then((data) => {
                    this.data = data.data;
                })
        },
        remove(id) {
            this.$swal.fire({
                type: 'warning',
                title: 'Jesteś pewien?',
                text: 'Czy na pewno chcesz usunąć incydent?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tak!',
                cancelButtonText: 'Nie!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$axios.delete(`/inspector/api/applications/incidents/remove/${id}`)
                        .then((data) => {
                            if (data.data.success === 1) {
                                this.$swal.fire({
                                    type: 'success',
                                    title: data.data.message
                                });

                                this.loadItems();
                            } else {
                                this.$swal.fire({
                                    type: 'error',
                                    title: data.data.message
                                })
                            }
                        })
                }
            })
        }
    },
    created() {
        this.loadItems();
        this.loadStatuses();
    }
}
</script>

<style scoped>

</style>
