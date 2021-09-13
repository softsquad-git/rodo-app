<template>
    <div class="block-content block-content-full">
        <table v-if="data.data.length > 0" class="table table-bordered table-striped table-vcenter js-dataTable-full">
            <thead>
            <tr>
                <th class="text-center" style="width: 80px;">#</th>
                <th>Numer</th>
                <th class="d-none d-sm-table-cell" style="width: 30%;">Skrót</th>
                <th class="d-none d-sm-table-cell" style="width: 15%;">Nazwa</th>
                <th style="width: 15%;">Typ</th>
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
                        <a :href="`/administration/clients/update/${item.id}`" class="btn btn-sm btn-alt-secondary" title="Edytuj">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                        </a>
                        <a href="" class="btn btn-sm btn-alt-secondary" title="Szczegóły">
                            <i class="fa fa-fw fa-eye"></i>
                        </a>
                        <button @click="archive(item.id)" type="button" class="btn btn-sm btn-alt-secondary" title="Archiwizuj">
                            <i class="fa fa-fw fa-archive"></i>
                        </button>
                        <button @click="remove(item.id)" type="button" class="btn btn-sm btn-alt-secondary" title="Usuń">
                            <i class="fa fa-fw fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="alert alert-danger text-center" v-if="data.data.length < 1">Brak danych do wyświetlenia</div>
    </div>
</template>

<script>
export default {
    name: "ClientsListComponent",
    data() {
        return {
            data: {},
            filters: {
                is_archive: 0
            }
        }
    },
    props: {
        list_url: ''
    },
    methods:{
        loadData(page = 1) {
            this.$axios.get(this.list_url+`?page=${page}&is_archive=${this.filters.is_archive}`)
            .then((data) => {
                this.data =data.data;
            }).catch((error) => {})
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
        }
    },
    created() {
        this.loadData();
    }
}
</script>

<style scoped>
.text-right {text-align: right!important;}
</style>
