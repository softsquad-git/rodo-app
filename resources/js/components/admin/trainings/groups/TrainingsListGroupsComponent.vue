<template>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <div class="block-title"></div>
            <div class="block-options">
                <button type="button" title="Szukaj" class="btn-block-option float-right w-auto">
                    <i class="si si-magnifier"></i>
                </button>
                <a :href="create_url" title="Dodaj" class="btn-block-option float-right w-auto">
                    <i class="si si-plus"></i>
                </a>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table v-if="data.data.length > 0 " class="table table-bordered table-striped table-vcenter">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Numer</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Nazwa</th>
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
                    <td class="text-right">
                        <div class="btn-group">
                            <a :href="`/administration/trainings/groups/update/${item.id}`" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title=""
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
    name: "TrainingsListGroupsComponent",
    data() {
        return {
            data: {}
        }
    },
    props: {
        list_url: '',
        create_url: ''
    },
    methods: {
        loadData(page = 1) {
            this.$axios.get(this.list_url + `?page=${page}`)
                .then((data) => {
                    this.data = data.data;
                })
        },
        remove(id) {
            this.$swal.fire({
                type: 'warning',
                title: 'Jesteś pewien?',
                text: 'Czy na pewno chcesz usunąć grupę?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tak!',
                cancelButtonText: 'Nie!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$axios.delete(`/administration/api/trainings/groups/remove/${id}`)
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

</style>
