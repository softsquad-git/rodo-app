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
        loadItems(page = 1) {

        }
    },
    created() {
        this.loadItems();
    }
}
</script>

<style scoped>

</style>
