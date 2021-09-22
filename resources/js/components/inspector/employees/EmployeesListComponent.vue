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
                            <input type="text" v-model="filters.name" placeholder="Imię i nazwisko" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-3">
                            <input type="text" v-model="filters.position" placeholder="Stanowisko" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-3">
                            <select class="form-control form-control-sm form-control-alt" v-model="filters.client_id">
                                <option value="" selected>Klient</option>
                                <option v-for="client in clients" :value="client.id">{{ client.name }}</option>
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
                    <th class="d-none d-sm-table-cell">Imię i nazwisko</th>
                    <th class="d-none d-sm-table-cell">Klient</th>
                    <th class="d-none d-sm-table-cell">Stanowisko</th>
                    <th class="d-none d-sm-table-cell">Działy</th>
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
                        {{ item.client }}
                    </td>
                    <td class="fs-sm">
                        {{ item.position }}
                    </td>
                    <td class="fs-sm">
                        <ul>
                            <li v-for="department in item.departments">{{ department.name }}</li>
                        </ul>
                    </td>
                    <td class="text-right">
                        <div class="btn-group">
                            <a :href="`/inspector/employees/update/${item.id}`"
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
    name: "EmployeesListComponent",
    data() {
        return {
            data: {},
            filters: {
                id: '',
                number: '',
                name: '',
                client_id: '',
                pagination: 20,
                position: ''
            },
            paginationNumbers: [5, 10, 20, 30, 50],
            isSearchBox: false,
            clients: []
        }
    },
    props: {
        list_url: '',
        create_url: ''
    },
    methods: {
        loadItems(page = 1) {
            this.$axios.get(this.list_url+`?page=${page}&pagination=${this.filters.pagination}&id=${this.filters.id}&number=${this.filters.number}&name=${this.filters.name}`)
            .then((data) => {
                this.data = data.data;
            }).catch((error) => {
               //
            });
        },
        remove() {

        },
        loadClients() {
            this.$axios.get('/administration/api/clients')
            .then((data) => {
                this.clients = data.data.data;
            })
        }
    },
    created() {
        this.loadItems();
        this.loadClients()
    }
}
</script>

<style scoped>

</style>
