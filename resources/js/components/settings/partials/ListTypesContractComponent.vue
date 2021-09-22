<template>
    <div class="div">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Nazwa</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="type in types" :key="type.id">
                <td>
                    <input aria-label="ID" type="checkbox" v-model="ids" :value="type.id">
                </td>
                <td>{{ type.name }}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-original-title="Edytuj">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

        <b-modal id="createModal" title="Dodaj status" hide-header hide-footer>
            <h5>Dodaj typ umowy</h5>
            <label for="name" class="form-label">Nazwa</label>
            <input type="text" v-model="data.name" class="form-control" id="name">

            <button @click="createType" class="btn btn-sm btn-outline-primary mt-3">Zapisz</button>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "ListTypesContractComponent",
    data() {
        return {
            types: [],
            ids: [],
            data: {
                name: '',
                resource_type: 'contract'
            }
        }
    },
    methods: {
        getList() {
            this.$axios.get(`/administration/api/settings/types?resource_type=contract`)
                .then((data) => {
                    this.types = data.data.data;
                })
        },
        remove() {
            this.$axios.delete(`/administration/api/settings/types/remove?ids=${JSON.stringify(this.ids)}`)
                .then((data) => {
                    if (data.data.success === 1) {
                        this.getList();
                        this.ids = [];
                    } else {
                        ///
                    }
                }).catch((error) => {
            })
        },
        createType() {
            this.$axios.post('/administration/api/settings/types/create', this.data)
                .then((data) => {
                    if (data.data.success === 1) {
                        this.$bvModal.hide('createModal');
                        this.data.name = '';
                        this.$swal.fire(
                            'Typ umowy został dodany', '', 'success'
                        );
                        this.getList();
                    }
                }).catch((error) => {

            })
        }
    },
    created() {
        this.getList()
    }
}
</script>

<style scoped>

</style>
