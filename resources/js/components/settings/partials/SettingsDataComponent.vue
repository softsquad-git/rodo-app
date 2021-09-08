<template>
    <div class="block-content block-content-full">
        <div class="header">
            <b-dropdown text="Wybierz" size="sm" variant="outline-primary">
                <b-dropdown-item @click="selectDropdown('status')">Statusy</b-dropdown-item>
                <b-dropdown-item @click="selectDropdown('types_clients')">Typy klienta</b-dropdown-item>
            </b-dropdown>
            <button v-if="isShowTrash" @click="remove" type="button" class="btn btn-sm btn-alt-secondary" style="float: right" data-bs-original-title="Usuń">
                <i class="fa fa-fw fa-trash"></i>
            </button>
            <button v-if="isShowAdd" @click="create" data-bs-toggle="modal" data-bs-target="#createItem" type="button" class="btn btn-sm btn-alt-success" style="float: right; margin-right: 5px" title="Dodaj">
                <i class="fa fa-fw fa-plus"></i>
            </button>
        </div>
        <component
            :is="dataCurrentComponent"
            :url_settings_list="url_settings_list"
            :url_status_list="url_status_list"
            :url_status_find="url_status_find"
            :url_status_create="url_status_create"
            :url_status_update="url_status_update"
            :url_status_remove="url_status_remove">
        </component>
    </div>
</template>

<script>
import Status from "./Status";
import ListTypesComponent from "./ListTypesComponent";

export default {
    name: "SettingsDataComponent",
    data() {
        return {
            dataCurrentComponent: Status,
            isShowTrash: false,
            isShowAdd: false
        }
    },
    props: {
        url_settings_list: '',
        url_status_list: '',
        url_status_create: '',
        url_status_update: '',
        url_status_remove: '',
        url_status_find: ''
    },
    methods: {
        selectDropdown(type) {
            if(type === 'status') {
                return this.dataCurrentComponent = Status
            }
            if(type === 'types_clients') {
                return this.dataCurrentComponent = ListTypesComponent
            }
        },
        remove() {
            this.$emit('remove')
        },
        create() {
            this.$emit('create')
        }
    }
}
</script>

<style scoped>

</style>
