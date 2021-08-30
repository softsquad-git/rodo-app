<template>
    <div class="block block-rounded">
        <div class="block-header block-header-default d-block">
            <button class="btn btn-sm" :class="type == 'app' ? 'btn-primary' : 'btn-outline-primary'" @click="check('app')">Ustawienia aplikacji</button>
            <button class="btn btn-sm" :class="type == 'status' ? 'btn-primary' : 'btn-outline-primary'" @click="check('status')">Statusy</button>
            <button v-if="isShowTrash" @click="remove" type="button" class="btn btn-sm btn-alt-secondary" style="float: right" data-bs-original-title="Usuń">
                <i class="fa fa-fw fa-trash"></i>
            </button>
            <button v-if="isShowAdd" data-bs-toggle="modal" data-bs-target="#createItem" type="button" class="btn btn-sm btn-alt-success" style="float: right; margin-right: 5px" title="Dodaj">
                <i class="fa fa-fw fa-plus"></i>
            </button>
        </div>
        <component
            :is="currentComponent"
            :url_settings_list="url_settings_list"
            :url_status_list="url_status_list"
            :url_status_find="url_status_find"
            :url_status_create="url_status_create"
            :url_status_update="url_status_update"
            :url_status_remove="url_status_remove"
            ref="childComponent"
        ></component>
    </div>
</template>

<script>
import SettingApp from "./partials/SettingApp";
import Status from "./partials/Status";

export default {
    name: "SettingsComponent",
    data() {
        return {
            currentComponent: SettingApp,
            type: 'app',
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
        check(type) {
            this.type = type;
            if (type === 'app') {
                return this.currentComponent = SettingApp;
            }
            if (type === 'status') {
                return this.currentComponent = Status;
            }
        },
        remove() {
            this.$refs.childComponent.remove();
        },
    }
}
</script>

<style scoped>

</style>
