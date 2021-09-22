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
            <tr v-for="statusItem in status" :key="statusItem.id">
                <td>
                    <input aria-label="ID" type="checkbox" v-model="ids" :value="statusItem.id">
                </td>
                <td>{{ statusItem.name }}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-original-title="Edytuj">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

        <b-modal id="createModal" title="Dodaj status" hide-header hide-footer>
            <h5>Dodaj status</h5>
            <label for="name" class="form-label">Nazwa</label>
            <input type="text" v-model="data.name" class="form-control" id="name">

            <label for="resource_type" class="form-label mt-3">Tabela</label>
            <select id="resource_type" class="form-control" v-model="data.resource_type">
                <option v-for="resource in resources" :value="resource.type">{{ resource.name }}</option>
            </select>

            <button @click="createStatus" class="btn btn-sm btn-outline-primary mt-3">Zapisz</button>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "Status",
    data() {
        return {
            status: [],
            ids: [],
            data: {
                name: '',
                resource_type: ''
            },
            resources: [
                {
                    type: 'client',
                    name: 'Klient'
                },
                {
                    type: 'training',
                    name: 'Szkolenie'
                },
                {
                    type: 'inspector',
                    name: 'Inspektor'
                },
                {
                    type: 'certificate_patter',
                    name: 'Szablony certyfikatów'
                },
                {
                    type: 'post_newsletter',
                    name: 'Posty newsletter'
                },
                {
                    type: 'document',
                    name: 'Statusy dokumentów'
                },
                {
                    type: 'conclusion',
                    name: 'Statusy wniosków'
                },
                {
                    type: 'issue',
                    name: 'Statusy spraw'
                }
            ]
        }
    },
    props: {
        url_status_list: '',
        url_status_find: '',
        url_status_create: '',
        url_status_update: '',
        url_status_remove: ''
    },
    methods: {
        getList() {
            this.$axios.get(this.url_status_list)
                .then((data) => {
                    this.status = data.data.data;
                }).catch((error) => {
            })
        },
        remove() {
            this.$axios.delete(this.url_status_remove + `?ids=${JSON.stringify(this.ids)}`)
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
        createStatus() {
            this.$axios.post(this.url_status_create, this.data)
            .then((data) => {
                if (data.data.success === 1) {
                    this.$bvModal.hide('createModal');
                    this.data.name = '';
                    this.$swal.fire(
                        'Status został dodany', '', 'success'
                    );
                    this.getList();
                }
            }).catch((error) => {

            })
        }
    },
    created() {
        this.getList();
        this.$parent.isShowAdd = true;
    },
    watch: {
        'ids'() {
            if (this.ids.length > 0) {
                this.$parent.isShowTrash = true;
            } else {
                this.$parent.isShowTrash = false;
            }
        }
    }
}
</script>

<style scoped>

</style>
