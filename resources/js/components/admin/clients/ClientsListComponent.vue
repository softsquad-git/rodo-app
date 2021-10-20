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
                    <b-form-select v-model="filters.pagination" class="form-control form-control-alt form-control-sm" :options="paginationNumbers"
                                   size="sm"></b-form-select>
                </div>
                <div class="col-md-11 col-12">
                    <div class="row" v-if="isSearchBox">
                        <div class="col-md-2 col-6">
                            <input type="text" class="form-control-alt form-control form-control-sm" v-model="filters.number" placeholder="Numer">
                        </div>
                        <div class="col-md-3 col-6">
                            <input type="date" class="form-control form-control-alt form-control-sm" v-model="filters.short" placeholder="Skrót">
                        </div>
                        <div class="col-md-3 col-6">
                            <input type="text" class="form-control-sm form-control form-control-alt" v-model="filters.name" placeholder="Nazwa">
                        </div>
                        <div class="col-md-2 col-6">
                            <select class="form-control form-control-sm form-control-alt" v-model="filters.status_id">
                                <option value="" selected>Status</option>
                                <option v-for="status in statuses" :value="status.id">{{ status.name }}</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-6">
                            <select class="form-control form-control-sm form-control-alt" v-model="filters.type_id">
                                <option value="" selected>Typ klienta</option>
                                <option v-for="type in types" :value="type.id">{{ type.name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <table v-if="data.data.length > 0"
                   class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">
                        #
                        <div class="ordering">
                            <span class="fa fa-sort-up position-absolute cursor" style="top: 2px" @click="ordering('created_at', 'DESC')"></span>
                            <span class="fa fa-sort-down sort-down cursor" @click="ordering('created_at', 'ASC')"></span>
                        </div>
                    </th>
                    <th style="width: 100px">
                        Numer
                        <div class="ordering">
                            <span class="fa fa-sort-up position-absolute cursor" style="top: 2px" @click="ordering('number', 'DESC')"></span>
                            <span class="fa fa-sort-down sort-down cursor" @click="ordering('number', 'ASC')"></span>
                        </div>
                    </th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">
                        Skrót
                        <div class="ordering">
                            <span class="fa fa-sort-up position-absolute cursor" style="top: 2px" @click="ordering('number', 'DESC')"></span>
                            <span class="fa fa-sort-down sort-down cursor" @click="ordering('number', 'ASC')"></span>
                        </div>
                    </th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">
                        Nazwa
                        <div class="ordering">
                            <span class="fa fa-sort-up position-absolute cursor" style="top: 2px" @click="ordering('name', 'DESC')"></span>
                            <span class="fa fa-sort-down sort-down cursor" @click="ordering('name', 'ASC')"></span>
                        </div>
                    </th>
                    <th style="width: 15%;">
                        Typ
                        <div class="ordering">
                            <span class="fa fa-sort-up position-absolute cursor" style="top: 2px" @click="ordering('type_id', 'DESC')"></span>
                            <span class="fa fa-sort-down sort-down cursor" @click="ordering('type_id', 'ASC')"></span>
                        </div>
                    </th>
                    <th style="width: 15%;">
                        Status
                        <div class="ordering">
                            <span class="fa fa-sort-up position-absolute cursor" style="top: 2px" @click="ordering('status_id', 'DESC')"></span>
                            <span class="fa fa-sort-down sort-down cursor" @click="ordering('status_id', 'ASC')"></span>
                        </div>
                    </th>
                    <th style="width: 15%;"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in data.data">
                    <td class="text-center fs-sm">{{ index + 1 }}</td>
                    <td class="fs-sm">
                        {{ item.number }}
                    </td>
                    <td class="fs-sm">
                        {{ item.short }}
                    </td>
                    <td class="fs-sm">
                        {{ item.name }}
                    </td>
                    <td class="fs-sm">
                        {{ item.type }}
                    </td>
                    <td class="fs-sm">
                        {{ item.status }}
                    </td>
                    <td class="text-right">
                        <div class="btn-group">
                            <a :href="`/administration/clients/update/${item.id}`" class="btn btn-sm btn-alt-secondary"
                               title="Edytuj">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </a>
                            <a href="" class="btn btn-sm btn-alt-secondary" title="Szczegóły">
                                <i class="fa fa-fw fa-eye"></i>
                            </a>
                            <button @click="archive(item.id)" type="button" class="btn btn-sm btn-alt-secondary"
                                    title="Archiwizuj">
                                <i class="fa fa-fw fa-archive"></i>
                            </button>
                            <button @click="remove(item.id)" type="button" class="btn btn-sm btn-alt-secondary"
                                    title="Usuń">
                                <i class="fa fa-fw fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="alert alert-danger text-center" v-if="data.data.length < 1">Brak danych do wyświetlenia</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ClientsListComponent",
    data() {
        return {
            data: {},
            filters: {
                id: '',
                number: '',
                short: '',
                name: '',
                type_id: '',
                status_id: '',
                pagination: 20,
                is_archive: 0,
                ordering_column: 'id',
                ordering_sort: 'desc'
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
        loadData(page = 1) {
            this.$axios.get(this.list_url + `?page=${page}&is_archive=${this.filters.is_archive}&pagination=${this.filters.pagination}&ordering_column=${this.filters.ordering_column}&ordering_sort=${this.filters.ordering_sort}`)
                .then((data) => {
                    this.data = data.data;
                }).catch((error) => {
            })
        },
        remove(id) {
            this.$swal.fire({
                type: 'warning',
                title: 'Jesteś pewien?',
                text: 'Czy na pewno chcesz usunąć klienta?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tak!',
                cancelButtonText: 'Nie!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$axios.delete(`/administration/api/clients/remove/${id}`)
                        .then((data) => {
                            if (data.data.success === 1) {
                                this.$swal.fire({
                                    type: 'success',
                                    title: data.data.message
                                });

                                this.loadData();
                            } else {
                                this.$swal.fire({
                                    type: 'error',
                                    title: data.data.message
                                })
                            }
                        })
                }
            })
        },
        archive(id) {
            this.$swal.fire({
                type: 'warning',
                title: 'Jesteś pewien?',
                text: 'Czy na pewno chcesz zarchiwizować klienta?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tak!',
                cancelButtonText: 'Nie!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$axios.patch(`/administration/api/clients/archive/${id}`)
                        .then((data) => {
                            if (data.data.success === 1) {
                                this.$swal.fire({
                                    type: 'success',
                                    title: data.data.message
                                });

                                this.loadData();
                            } else {
                                this.$swal.fire({
                                    type: 'error',
                                    title: data.data.message
                                })
                            }
                        })
                }
            })
        },
        loadStatuses() {
            this.$axios.get(`/administration/api/get-statuses?resource_type=client`)
                .then((data) => {
                    this.statuses = data.data.data;
                }).catch((error) => {
                //
            })
        },
        loadTypes() {
            this.$axios.get(`/administration/api/settings/types?resource_type=client`)
            .then((data) => {
                this.types = data.data.data;
            })
        },
        ordering(column, sort) {
            this.filters.ordering_sort = sort;
            this.filters.ordering_column = column;
            this.loadData();
        }
    },
    created() {
        this.loadData();
        this.loadStatuses();
        this.loadTypes();
    }
}
</script>

<style scoped>
.text-right {
    text-align: right !important;
}
</style>
