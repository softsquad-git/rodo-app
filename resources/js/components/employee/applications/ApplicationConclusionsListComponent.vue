<template>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <div class="block-title"></div>
            <div class="block-options">
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
                <div class="col-md-11 col-12">
                    <div class="row" v-if="isSearchBox">
                        <div class="col-md-1">
                            <input type="text" v-model="filters.id" placeholder="ID" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2">
                            <input type="text" v-model="filters.number" placeholder="Numer" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-3 col-12">
                            <input type="text" v-model="filters.title" placeholder="Tytuł" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2">
                            <select class="form-control form-control-alt form-control-sm" v-model="filters.status_id">
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
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Temat</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Status</th>
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
                        <select class="form-control form-control-alt form-control-sm">
                            <option v-for="status in statuses" v-model="item.status.id" :selected="item.status.id == status.id ? true : false" :value="status.id">{{ status.name }}</option>
                        </select>
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
    name: "ApplicationConclusionsListComponent",
    data() {
        return {
            data: {},
            filters: {
                id: '',
                pagination: 20,
                number: '',
                title: '',
                status_id: ''
            },
            statuses: [],
            paginationNumbers: [5, 10, 20, 30, 50],
            isSearchBox: false,
        }
    },
    props: {
        list_url: ''
    },
    methods: {
        loadData(page = 1) {
            this.$axios.get(this.list_url+`?page=${page}&id=${this.filters.id}&pagination=${this.filters.pagination}&number=${this.filters.number}&status_id=${this.filters.status_id}&title=${this.filters.title}`)
            .then((data) => {
                this.data = data.data;
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
