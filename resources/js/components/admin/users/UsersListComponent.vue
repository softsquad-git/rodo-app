<template>
    <div class="block block-rounded">
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
