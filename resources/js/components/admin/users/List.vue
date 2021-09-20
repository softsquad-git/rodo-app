<template>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <div class="block-title"></div>
            <div class="block-options">
                <button @click="isSearchBox ^= true" type="button" title="Szukaj"
                        class="btn-block-option float-right w-auto">
                    <i class="si" :class="isSearchBox ? 'si-magnifier-remove' : 'si-magnifier-add'"></i>
                </button>
                <a href="/administration/users/create" title="Dodaj" class="btn-block-option float-right w-auto">
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
                            <div class="col-md-1">
                                <input type="text" class="form-control form-control-alt form-control-sm" v-model="filters.id" placeholder="ID">
                            </div>
                            <div class="col-md-2 col-6">
                                <input type="text" class="form-control-alt form-control form-control-sm" v-model="filters.number" placeholder="Numer">
                            </div>
                            <div class="col-md-3 col-6">
                                <input type="text" class="form-control form-control-alt form-control-sm" v-model="filters.name" placeholder="Imię i nazwisko">
                            </div>
                            <div class="col-md-2 col-6">
                                <input type="text" class="form-control-sm form-control form-control-alt" v-model="filters.email" placeholder="Email">
                            </div>
                            <div class="col-md-2 col-6">
                                <select class="form-control form-control-sm form-control-alt" v-model="filters.role">
                                    <option value="" selected>Typ konta</option>
                                    <option value="INSPECTOR">Inspektor</option>
                                    <option value="EMPLOYEE">Pracownik</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-6">
                                <select class="form-control form-control-sm form-control-alt" v-model="filters.status_id">
                                    <option value="" selected>Status</option>
                                    <option v-for="status in statuses" :value="status.id">{{ status.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <table v-if="data.data.length > 0 "  class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Numer</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">E-mail</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Imię i nazwisko</th>
                        <th style="width: 15%;">Typ konta</th>
                        <th style="width: 15%;">Klient</th>
                        <th style="width: 15%;">Status</th>
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
                            {{ item.email }}
                        </td>
                        <td class="fs-sm">
                            {{ item.name }}
                        </td>
                        <td class="fs-sm">
                            {{ item.type }}
                        </td>
                        <td class="fs-sm">

                        </td>
                        <td class="fs-sm">
                            {{ item.status }}
                        </td>
                        <td class="text-right">
                            <div class="btn-group">
                                <a href="" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="" data-bs-original-title="Edytuj">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </a>
                                <a href="" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="" data-bs-original-title="Szczegóły">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                                <button @click="remove(item.id)" type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Usuń">
                                    <i class="fa fa-fw fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div v-if="data.data.length < 1" class="alert alert-danger text-center">Brak danych do wyświetlenia</div>
            </div>
    </div>
</template>

<script>
export default {
    name: "List",
    data() {
        return {
            data: {},
            filters: {
                id: '',
                number: '',
                name: '',
                email: '',
                role: '',
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
            this.$axios.get(this.list_url+`?page=${page}`)
                .then((data) => {
                    this.data =data.data;
                }).catch((error) => {})
        },
        remove(id) {
            this.$swal.fire({
                type: 'warning',
                title: 'Jesteś pewien?',
                text: 'Czy na pewno chcesz usunąć użytkownika?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tak!',
                cancelButtonText: 'Nie!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$axios.delete(`/administration/api/users/remove/${id}`)
                        .then((data) => {
                            if(data.data.success === 1) {
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
    },
    created() {
        this.loadData();
        this.loadStatuses();
    }
}
</script>

<style scoped>

</style>
