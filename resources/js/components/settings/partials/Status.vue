<template>
    <div class="block-content block-content-full">
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

        <div class="modal fade" id="createItem" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Dodaj status</h5>
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
                        <button @click="createStatus" type="button" class="btn btn-outline-primary btn-sm">Zapisz</button>
                    </div>
                </div>
            </div>
        </div>
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
                name: ''
            },
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
                    const modal = new bootstrap.Modal(document.getElementById('createItem'), {
                        keyboard: false
                    });
                    console.log(modal)
                    modal.dispose();
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
