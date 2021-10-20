<template>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <div class="block-title"></div>
            <div class="block-options">
                <a href="/administration/certificates/patters" class="btn btn-outline-primary btn-sm float-right w-auto" style="margin-left: 5px">
                    Szablony
                </a>
                <button @click="isSearchBox ^= true" type="button" title="Szukaj"
                        class="btn-block-option float-right w-auto">
                    <i class="si" :class="isSearchBox ? 'si-magnifier-remove' : 'si-magnifier-add'"></i>
                </button>
            </div>
        </div>
        <div class="block-content block-content-full">
            <div class="row mb-3">
                <div class="col-md-1 col-12">
                    <b-form-select v-model="filters.pagination" class="form-control form-control-sm form-control-alt" :options="paginationNumbers"
                                   size="sm"></b-form-select>
                </div>
            </div>

            <table v-if="data.data.length > 0 " class="table table-bordered table-striped table-vcenter">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Numer</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Imię i nazwisko</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Klient</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Data wydania</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in data.data">
                    <td class="text-center fs-sm">{{ index + 1 }}</td>
                    <td class="fs-sm">
                        {{ item.number }}
                    </td>
                    <td class="fs-sm">
                        {{ item.employee_name }}
                    </td>
                    <td class="fs-sm">
                        {{ item.client_name }}
                    </td>
                    <td class="fs-sm">
                        {{ item.release_date }}
                    </td>
                    <td class="fs-sm">
                        <button @click="download(item.id)" class="btn btn-sm btn-outline-primary float-right">
                            <i class="fa fa-download"></i>  Pobierz plik
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "CertificatesListComponent",
    data() {
        return {
            data: {},
            filters: {
                id: '',
                name: '',
                number: '',
                client_id: '',
                pagination: 20,
                ordering_column: '',
                ordering_sort: '',
                release_date: ''
            },
            paginationNumbers: [5, 10, 20, 30, 50],
            isSearchBox: false,
            statuses: []
        }
    },
    props: {
        list_url: ''
    },
    methods: {
        loadData(page = 1) {
            this.$axios.get(this.list_url+`?page=${page}`)
            .then((data) => {
                this.data = data.data;
            })
        },
        download(id) {
            this.$axios.get(`/employee/trainings/certificates/download/${id}`, {responseType: 'arraybuffer'})
                .then(response => {
                    let blob = new Blob([response.data], { type: 'application/pdf' })
                    let link = document.createElement('a')
                    link.href = window.URL.createObjectURL(blob)
                    link.download = 'certificate.pdf'
                    link.click()
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
