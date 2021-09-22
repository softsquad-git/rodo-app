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
                        <div class="col-md-2">
                            <input type="text" v-model="filters.title" placeholder="Tytuł" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2">
                            <input type="date" v-model="filters.from" placeholder="Ważny od" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2">
                            <input type="date" v-model="filters.to" placeholder="Ważny do" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-3">
                            <select v-model="filters.status_id" class="form-control form-control-sm form-control-alt">
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
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Tytuł</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Ważny od</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Ważny do</th>
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
                        {{ item.title }}
                    </td>
                    <td class="fs-sm">
                        {{ item.from }}
                    </td>
                    <td class="fs-sm">
                        {{ item.to }}
                    </td>
                    <td class="fs-sm">
                        {{ item.status }}
                    </td>
                    <td class="text-right">
                        <div class="btn-group">
                            <a :href="`/inspector/newsletter/update/${item.id}`"
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
    name: "NewsletterListComponent",
    data() {
        return {
            data: {},
            filters: {
                id: '',
                number: '',
                title: '',
                from: '',
                to: '',
                status_id: '',
                pagination: 20
            },
            statuses: [],
            paginationNumbers: [5, 10, 20, 30, 50],
            isSearchBox: false,
        }
    },
    props: {
        list_url: '',
        create_url: ''
    },
    methods: {
        loadItems(page = 1) {
            this.$axios.get(this.list_url+`?page=${page}&id=${this.filters.id}&number=${this.filters.number}&title=${this.filters.title}&from=${this.filters.from}&to=${this.filters.to}&status_id=${this.filters.status_id}&pagination=${this.filters.pagination}`)
            .then((data) => {
                this.data = data.data;
            }).catch((error) => {

            })
        },
        loadStatuses() {
            this.$axios.get(`/inspector/api/get-statuses?resource_type=post_newsletter`)
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
    }
}
</script>

<style scoped>

</style>
