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
                    <b-form-select v-model="filters.pagination" class="form-control" :options="paginationNumbers"
                                   size="sm"></b-form-select>
                </div>
                <div class="col-md-11 col-12">
                    <div class="row" v-if="isSearchBox">
                        <div class="col-md-1">
                            <input type="number" v-model="filters.id" placeholder="ID" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <input type="text" v-model="filters.number" placeholder="Numer" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="text" v-model="filters.name" placeholder="Nazwa" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" v-model="filters.status_id">
                                <option value="" selected>Status</option>
                                <option v-for="status in statuses" :value="status.id">{{ status.name }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                </div>
            </div>
            <table v-if="data.data.length > 0 " class="table table-bordered table-striped table-vcenter">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Numer</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Nazwa</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Grupa</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Statystyki</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Status</th>
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
                        {{ item.name }}
                    </td>
                    <td class="fs-sm">
                        <ul>
                            <li v-for="group in item.groups">{{ group.name }}</li>
                        </ul>
                    </td>
                    <td class="fs-sm">

                    </td>
                    <td class="fs-sm">
                        {{ item.status }}
                    </td>
                    <td class="text-right">
                        <div class="btn-group">
                            <a :href="`/administration/trainings/update/${item.id}`"
                               class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title=""
                               data-bs-original-title="Edytuj">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </a>
                            <button @click="remove(item.id)" type="button"
                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip"
                                    title="" data-bs-original-title="Usuń">
                                <i class="fa fa-fw fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="alert alert-danger text-center" v-if="data.data.length < 1">Brak danych do wyśietlenia</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "TrainingsListComponent",
    data() {
        return {
            data: {},
            filters: {
                id: '',
                name: '',
                number: '',
                status_id: '',
                pagination: 20
            },
            paginationNumbers: [5, 10, 20, 30, 50],
            isSearchBox: false,
            statuses: []
        }
    },
    props: {
        list_url: '',
        create_url: ''
    },
    methods: {
        loadData(page = 1) {
            this.$axios.get(this.list_url + `?page=${page}&name=${this.filters.name}&number=${this.filters.number}&status_id=${this.filters.status_id}`)
                .then((data) => {
                    this.data = data.data;
                })
        },
        remove(id) {
            this.$swal.fire({
                type: 'warning',
                title: 'Jesteś pewien?',
                text: 'Czy na pewno chcesz usunąć szkolenie?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tak!',
                cancelButtonText: 'Nie!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$axios.delete(`/administration/api/trainings/remove/${id}`)
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
            this.$axios.get(`/administration/api/get-statuses?resource_type=training`)
                .then((data) => {
                    this.statuses = data.data.data;
                }).catch((error) => {
                //
            })
        }
    },
    watch: {
        'filters.pagination'() {
            this.loadData();
        },
        'filters.status_id' () {
            this.loadData();
        }
    },
    created() {
        this.loadData();
        this.loadStatuses();
    }
}
</script>

<style scoped>

</style>
