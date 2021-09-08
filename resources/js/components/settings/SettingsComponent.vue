<template>
    <div class="block block-rounded">
        <div class="block-header block-header-default d-block">
            <button class="btn btn-sm" :class="type == 'app' ? 'btn-primary' : 'btn-outline-primary'" @click="check('app')">Ustawienia aplikacji</button>
            <button class="btn btn-sm" :class="type == 'data' ? 'btn-primary' : 'btn-outline-primary'" @click="check('data')">Dane</button>
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
import SettingsData from "./partials/SettingsDataComponent";

export default {
    name: "SettingsComponent",
    data() {
        return {
            currentComponent: SettingApp,
            type: 'app',
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
            if (type === 'data') {
                return this.currentComponent = SettingsData;
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
