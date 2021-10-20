<template>

</template>

<script>
export default {
    name: "ApplicationListComponent",
    data() {
        return {
            data: {},
            filters: {
                id: '',
                pagination: '',
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
