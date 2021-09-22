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
                        <div class="col-md-3">
                            <input type="text" v-model="filters.date_application" placeholder="Data złożenia" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2">
                            <input type="text" v-model="filters.name" placeholder="Imię i nazwisko" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2">
                            <input type="text" v-model="filters.title" placeholder="Tytuł" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2">
                            <select class="form-control form-control-sm form-control-alt" v-model="filters.type_id">
                                <option value="" selected>Rodzaj wniosku</option>
                                <option v-for="type in types" :value="type.id">{{ type.name }}</option>
                            </select>
                        </div>
                        <div class="col-md-2 mt-3">
                            <select class="form-control form-control-sm form-control-alt" v-model="filters.status_id">
                                <option value="" selected>Status</option>
                                <option v-for="status in statuses" :value="status.id">{{ status.name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <table v-if="data.data.length > 0 " class="table table-bordered table-striped table-vcenter">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Numer</th>
                    <th class="d-none d-sm-table-cell">Data złożenia</th>
                    <th class="d-none d-sm-table-cell">Imię i nazwisko</th>
                    <th class="d-none d-sm-table-cell">Tytuł</th>
                    <th class="d-none d-sm-table-cell">Rodzaj</th>
                    <th class="d-none d-sm-table-cell">Status</th>
                    <th class="d-none d-sm-table-cell">Osoba której akceptacja <br/>  jest wymagana</th>
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
                        {{ item.date_application }}
                    </td>
                    <td class="fs-sm">
                        {{ item.name }}
                    </td>
                    <td class="fs-sm">
                        {{ item.title }}
                    </td>
                    <td class="fs-sm">
                        {{ item.type }}
                    </td>
                    <td class="fs-sm">
                        <select class="form-control form-control-alt form-control-sm">
                            <option v-for="status in statuses" v-model="item.status_id" :selected="item.status_id == status.id ? true : false" :value="status.id">{{ status.name }}</option>
                        </select>
                    </td>
                    <td class="fs-sm">
                        {{ item.employee_accepted }}
                    </td>
                    <td class="text-right">
                        <div class="btn-group">
                            <a :href="`/inspector/applications/conclusions/update/${item.id}`"
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
    name: "ApplicationsConclusionsListComponent",
    data() {
        return {
            data: {},
            filters: {
                id: '',
                date_application: '',
                name: '',
                status_id: '',
                pagination: 20,
                title: '',
                type_id: '',
                accepted_employee_id: '',
                number: ''
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
        loadItems(page = 1) {
            this.$axios.get(this.list_url+`?page=${page}&id=${this.filters.id}&date_application=${this.filters.date_application}&name=${this.filters.name}&status_id=${this.filters.status_id}&pagination=${this.filters.pagination}&title=${this.filters.title}&type_id=${this.filters.type_id}&accepted_employee_id=${this.filters.accepted_employee_id}`)
            .then((data) => {
                this.data = data.data;
            }).catch((error) => {

            })
        },
        loadTypes() {
            this.$axios.get(`/administration/api/settings/types?resource_type=conclusion`)
                .then((data) => {
                    this.types = data.data.data;
                })
        },
        loadStatuses() {
            this.$axios.get(`/inspector/api/get-statuses?resource_type=conclusion`)
                .then((data) => {
                    this.statuses = data.data.data;
                }).catch((error) => {
                //
            })
        },
    },
    created() {
        this.loadItems();
        this.loadStatuses();
        this.loadTypes();
    }
}
</script>

<style scoped>

</style>
