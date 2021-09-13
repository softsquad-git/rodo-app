<template>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <div class="block-title"></div>
            <div class="block-options">
                <button type="button" title="Szukaj" class="btn-block-option float-right w-auto">
                    <i class="si si-magnifier"></i>
                </button>
                <a :href="create_url" title="Dodaj" class="btn-block-option float-right w-auto">
                    <i class="si si-plus"></i>
                </a>
            </div>
        </div>
        <list :list_url="list_url"></list>
    </div>
</template>

<script>
import List from "./List";
export default {
    name: "UsersListComponent",
    components: {List},
    data() {
        return {
            data: {}
        }
    },
    props: {
        list_url: '',
        create_url: ''
    }
}
</script>

<style scoped>
.text-right {text-align: right!important;}
</style>
