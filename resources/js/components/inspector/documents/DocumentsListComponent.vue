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
                            <input type="text" v-model="filters.name" placeholder="Nazwa" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2">
                            <input type="datetime-local" v-model="filters.valid_from" placeholder="Obowiązuje od" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2">
                            <select v-model="filters.type_id" class="form-control-sm form-control form-control-alt">
                                <option value="" selected>Rodzaj dokumentu</option>
                                <option v-for="type in types" :value="type.id">{{ type.name }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select v-model="filters.status_id" class="form-control-sm form-control form-control-alt">
                                <option value="" selected>Status</option>
                                <option v-for="status in statuses" :value="status.id">{{ status.name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="documents-list">
                <div class="row" style="margin-bottom: 20px;border-bottom: 1px solid #ebeef2;padding-bottom: 5px;">
                    <div class="col-md-1 header">Numer</div>
                    <div class="col-md-2 header">Nazwa</div>
                    <div class="col-md-2 header">Typ</div>
                    <div class="col-md-2 header">Obowiązauje do</div>
                    <div class="col-md-2 header">Status</div>
                    <div class="col-md-1 header">Wymaga przeczytania</div>
                    <div class="col-md-2"></div>
                </div>

                <div class="single-row" v-for="(item, index) in data.data">
                    <div class="row">
                        <div class="col-md-1 single-col">{{ item.number }}</div>
                        <div class="col-md-2 single-col">{{ item.name }}</div>
                        <div class="col-md-2 single-col">{{ item.type }}</div>
                        <div class="col-md-2 single-col">{{ item.valid_to }}</div>
                        <div class="col-md-2 single-col">
                            <select class="form-control form-control-alt form-control-sm">
                                <option v-for="status in statuses" v-model="item.status.id" :selected="item.status.id == status.id ? true : false" :value="status.id">{{ status.name }}</option>
                            </select>
                        </div>
                        <div class="col-md-1 single-col">
                            <i :class="item.required_confirmation.code ? 'fa fa-eye' : 'fa fa-eye-slash'"></i> {{ item.required_confirmation.name }}
                        </div>
                        <div class="col-md-2 single-col" style="text-align: right!important;">
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
                        </div>
                    </div>
                    <div class="row" v-if="item.attachments.length > 0">
                        <div class="col-md-10 offset-md-1">
                            <div class="attachments-block">
                                <div class="row">
                                    <div class="col-md-3 header-attachment">
                                        Rodzaj załącznika
                                    </div>
                                    <div class="col-md-7 header-attachment">
                                        Załącznik
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>

                                <div v-for="attachment in item.attachments" class="single-row-attachment">
                                    <div class="row">
                                        <div class="col-md-3 single-col-attachment">
                                            {{ attachment.type }}
                                        </div>
                                        <div class="col-md-7 single-col-attachment">
                                            {{ attachment.file.file }}
                                        </div>
                                        <div class="col-md-2 single-col-attachment">
                                            <div class="btn-group">
                                                <button @click="download(attachment.file.url, attachment.file.file)" type="button"
                                                        class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip"
                                                        title="" data-bs-original-title="Pobierz">
                                                    <i class="fa fa-fw fa-download"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-danger text-center" v-if="data.data.length < 1">Brak danych do wyśietlenia</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DocumentsListComponent",
    data() {
        return {
            data: {},
            filters: {
                id: '',
                number: '',
                name: '',
                type_id: '',
                pagination: 20,
                valid_from: '',
                is_required_confirmation: '',
                status_id: ''
            },
            paginationNumbers: [5, 10, 20, 30, 50],
            isSearchBox: false,
            types: [],
            statuses: []
        }
    },
    props: {
        list_url: '',
        save_url: '',
        create_url: ''
    },
    methods: {
        loadItems(page = 1) {
            this.$axios.get(this.list_url+`?page=${page}`)
            .then((data) => {
                this.data = data.data;
            })
        },
        loadTypes() {
            this.$axios.get(`/administration/api/settings/types?resource_type=document`)
                .then((data) => {
                    this.types = data.data.data;
                })
        },
        loadStatuses() {
            this.$axios.get(`/inspector/api/get-statuses?resource_type=document`)
                .then((data) => {
                    this.statuses = data.data.data;
                }).catch((error) => {
                //
            })
        },
        download (url, file) {
            window.location.href = url;
        }
    },
    created() {
        this.loadItems();
        this.loadTypes();
        this.loadStatuses();
    }
}
</script>

<style scoped lang="scss">
.documents-list {
    .header {
        font-size: .875rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .single-row {
        margin-top: 10px;
        border-bottom: 1px solid #ebf0f5;
        padding-bottom: 5px;

        .single-col {
            text-align: left!important;
        }
    }

    .attachments-block {
        background: #ebeef2;
        padding: 5px;
        border-radius: 3px;
        margin-top: 4px;
    }
}
.header-attachment {
    font-size: 14px!important;
    color: #5d5d5d!important;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.single-row-attachment {
    margin-top: 8px;

    .single-col-attachment {
        font-size: 14px!important;
    }
}
</style>
