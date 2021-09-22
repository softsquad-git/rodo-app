<template>
    <div class="block-content block-content-full">
        <div class="header">
            <b-dropdown text="Wybierz" size="sm" variant="outline-primary">
                <b-dropdown-item @click="selectDropdown('status')">Statusy</b-dropdown-item>
                <b-dropdown-item @click="selectDropdown('types_clients')">Typ klienta</b-dropdown-item>
                <b-dropdown-item @click="selectDropdown('types_contracts')">Typ umowy</b-dropdown-item>
                <b-dropdown-item @click="selectDropdown('types_attachments')">Rodzaj załącznika</b-dropdown-item>
                <b-dropdown-item @click="selectDropdown('document')">Rodzaj dokumentu</b-dropdown-item>
                <b-dropdown-item @click="selectDropdown('conclusion')">Rodzaje wniosków</b-dropdown-item>
                <b-dropdown-item @click="selectDropdown('issue')">Rodzaje spraw</b-dropdown-item>
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
import ListTypesAccountComponent from "./ListTypesAccountComponent";
import ListTypesContractComponent from "./ListTypesContractComponent";
import ListTypesAttachmentsComponent from "./ListTypesAttachmentsComponent";
import ListTypesDocumentComponent from "./ListTypesDocumentComponent";
import ListTypesConclusionComponent from "./ListTypesConclusionComponent";
import ListTypesIssueComponent from "./ListTypesIssueComponent";

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
            if(type === 'types_inspector') {
                return this.dataCurrentComponent = ListTypesAccountComponent
            }
            if (type === 'types_contracts') {
                return this.dataCurrentComponent = ListTypesContractComponent
            }
            if (type === 'types_attachments') {
                return this.dataCurrentComponent = ListTypesAttachmentsComponent
            }
            if (type === 'document') {
                return this.dataCurrentComponent = ListTypesDocumentComponent;
            }
            if (type === 'conclusion') {
                return this.dataCurrentComponent = ListTypesConclusionComponent;
            }
            if (type === 'issue') {
                return this.dataCurrentComponent = ListTypesIssueComponent
            }
        },
        remove() {
            this.$emit('remove')
        },
        create() {
            this.$bvModal.show('createModal');
        }
    }
}
</script>

<style scoped>

</style>
