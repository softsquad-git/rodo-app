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

        <div class="modal fade" id="createItem" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Dodaj typ klienta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <input type="text" v-model="data.name" aria-label="Nazwa" placeholder="Nazwa" class="form-control form-control-alt">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button @click="createType" type="button" class="btn btn-outline-primary btn-sm">Zapisz</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ListTypesComponent",
    data() {
        return {
            types: [],
            ids: [],
            data: {
                name: '',
                resource_type: 'client'
            }
        }
    },
    methods: {
        getList() {
            this.$axios.get('/administration/api/settings/types')
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
                        const modal = new bootstrap.Modal(document.getElementById('createItem'), {
                            keyboard: false
                        });
                        console.log(modal)
                        modal.dispose();
                        this.data.name = '';
                        this.$swal.fire(
                            'Typ klienta został dodany', '', 'success'
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
