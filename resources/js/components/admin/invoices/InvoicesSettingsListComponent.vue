<template>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <div class="block-title"></div>
            <div class="block-options">
            </div>
        </div>
        <div class="block-content block-content-full">
            <table v-if="data.length > 0 " class="table table-bordered table-striped table-vcenter">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Nazwa</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Wartość</th>
                    <th style="width: 15%;"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in data">
                    <td class="text-center fs-sm">{{ index + 1 }}</td>
                    <td class="fs-sm">
                        {{ item.name.name }}
                    </td>
                    <td class="fs-sm">
                        {{ item.value }}
                    </td>
                    <td class="text-right">
                        <div class="btn-group">
                            <button @click="edit(item)" type="button"
                                    class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip"
                                    title="Edytuj" data-bs-original-title="Edytuj">
                                <i class="fa fa-fw fa-edit"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="alert alert-danger text-center" v-if="data.length < 1">Brak danych do wyśietlenia</div>
        </div>

        <b-modal id="updateSettingModal" title="Zmień dane" hide-header hide-footer>
            <label for="value" class="form-label">{{ item.name ? item.name.name : ''}}</label>
            <input type="text" v-model="updateData.value" class="form-control form-control-alt" id="value">

            <button @click="saveUpdateData" class="btn btn-sm btn-outline-primary mt-3">Zapisz</button>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "InvoicesSettingsListComponent",
    data() {
        return {
            data: [],
            item: {},
            updateData: {
                id: '',
                value: ''
            }
        }
    },
    props: {
        list_url: ''
    },
    methods: {
        loadItems() {
            this.$axios.get(this.list_url)
            .then((data) => {
                this.data = data.data.data;
            }).catch((error) => {

            })
        },
        edit(item) {
            this.updateData.id = item.id;
            this.updateData.value = item.value;
            this.item = item;
            if (this.item) {
                this.$bvModal.show('updateSettingModal');
            }
        },
        saveUpdateData() {
            this.$axios.patch(`/administration/api/invoices/settings/update/${this.updateData.id}`, this.updateData)
            .then((data) => {
                if (data.data.success === 1) {
                    this.loadItems();
                    this.$bvModal.hide('updateSettingModal');
                    this.$swal.fire(
                        'Dane zostały zapisane', '', 'success'
                    );
                }
            }).catch((error) => {

            })
        }
    },
    created() {
        this.loadItems();
    }
}
</script>

<style scoped>

</style>
