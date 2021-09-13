<template>
    <div class="block-content block-content-full">
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
</template>

<script>
export default {
    name: "List",
    data() {
        return {
            data: {}
        }
    },
    props: {
        list_url: ''
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
        }
    },
    created() {
        this.loadData()
    }
}
</script>

<style scoped>

</style>
