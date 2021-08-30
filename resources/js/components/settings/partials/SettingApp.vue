<template>
    <div class="block-content block-content-full">
        <table class="table">
            <thead>
            <tr>
            </tr>
            </thead>
            <tbody>
            <tr v-for="setting in settings" :key="setting.id">
                <td>{{ setting.name }}</td>
                <td>{{ setting.value }}</td>
                <td>
                    <button class="btn btn-sm btn-alt-secondary">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "SettingApp",
    data() {
        return {
            settings: [],
        }
    },
    props: {
        url_settings_list: ''
    },
    methods: {
        getSettingsList() {
            this.$axios.get(this.url_settings_list)
                .then((data) => {
                    this.settings = data.data.data;
                }).catch((error) => {
                //
            })
        }
    },
    created() {
        this.getSettingsList();
        this.$parent.isShowTrash = false;
        this.$parent.isShowAdd = false;
    }
}
</script>

<style scoped>

</style>
