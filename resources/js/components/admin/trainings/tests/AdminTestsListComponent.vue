<template>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <div class="block-title"></div>
            <div class="block-options">
                <a :href="questions_list" class="btn btn-outline-primary btn-sm float-right w-auto" style="margin-left: 5px">
                    Pytania
                </a>
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
                        <div class="col-sm-2">
                            <input type="text" v-model="filters.id" placeholder="ID" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" v-model="filters.number" placeholder="Numer" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" v-model="filters.name" placeholder="Nazwa" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-sm-3">

                        </div>
                    </div>
                </div>
            </div>
            <table v-if="data.data.length > 0 " class="table table-bordered table-striped table-vcenter">
                <thead>
                <tr>
                    <th class="text-left" style="width: 80px;">#</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Numer</th>
                    <th class="d-none d-sm-table-cell">Nazwa</th>
                    <th class="d-none d-sm-table-cell">Opis</th>
                    <th class="d-none d-sm-table-cell">Grupa</th>
                    <th class="d-none d-sm-table-cell">Statystyki</th>
                    <th style="width: 15%;"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in data.data">
                    <td class="text-left fs-sm">{{ index + 1 }}</td>
                    <td class="fs-sm">{{ item.number }}</td>
                    <td class="fs-sm">{{ item.name }}</td>
                    <td class="fs-sm" v-html="item.description"></td>
                    <td class="fs-sm">{{ item.group }}</td>
                    <td class="fs-sm">
                        Pytań: {{ item.questions_count }} <br/>
                        Zaliczenie: {{ item.pass_threshold }}%
                    </td>
                    <td class="text-right">
                        <div class="btn-group">
                            <a :href="`/administration/trainings/tests/update/${item.id}`"
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
        </div>
        <div class="alert alert-danger text-center" v-if="data.data.length < 1">Brak danych do wyśietlenia</div>

    </div>
</template>

<script>
export default {
    name: "AdminTestsListComponent",
    data() {
        return {
            paginationNumbers: [5, 10, 20, 30, 50],
            isSearchBox: false,
            filters: {
                id: '',
                pagination: 20,
                name: '',
                number: '',
                group_id: ''
            },
            data: {}
        }
    },
    props:{
        list_url: '',
        create_url: '',
        questions_list: ''
    },
    methods: {
        loadData(page = 1) {
            this.$axios.get(this.list_url+`?page=${page}`)
            .then((data) => {
                this.data = data.data;
            }).catch((error) => {

            })
        },
        remove(id) {
            this.$swal.fire({
                type: 'warning',
                title: 'Jesteś pewien?',
                text: 'Czy na pewno chcesz usunąć test?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tak!',
                cancelButtonText: 'Nie!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$axios.delete(`/administration/api/trainings/tests/remove/${id}`)
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
