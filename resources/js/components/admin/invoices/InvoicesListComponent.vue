<template>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <div class="block-title"></div>
            <div class="block-options">
                <button @click="isSearchBox ^= true" type="button" title="Szukaj"
                        class="btn-block-option float-right w-auto">
                    <i class="si" :class="isSearchBox ? 'si-magnifier-remove' : 'si-magnifier-add'"></i>
                </button>
            </div>
        </div>
        <div class="block-content block-content-full">
            <div class="row mb-3">
                <div class="col-md-1 col-12">
                    <b-form-select v-model="filters.pagination" class="form-control form-control-alt form-control-sm" :options="paginationNumbers"
                                   size="sm"></b-form-select>
                </div>
                <div class="col-md-11 col-12">
                    <div class="row" v-if="isSearchBox">
                        <div class="col-md-2 col-6">
                            <input type="text" class="form-control-alt form-control form-control-sm" v-model="filters.number" placeholder="Numer faktury">
                        </div>
                        <div class="col-md-2 col-6">
                            <input type="date" class="form-control form-control-alt form-control-sm" v-model="filters.date_issue" placeholder="Data wystawienia">
                        </div>
                        <div class="col-md-2 col-6">
                            <input type="text" class="form-control-sm form-control form-control-alt" v-model="filters.client_name" placeholder="Nazwa klienta">
                        </div>
                        <div class="col-md-2 col-6">
                            <input type="text" class="form-control form-control-alt form-control-sm" v-model="filters.nip" placeholder="NIP">
                        </div>
                        <div class="col-md-2 col-6">
                            <input type="date" class="form-control form-control-alt form-control-sm" v-model="filters.payment_date" placeholder="Data płatności">
                        </div>
                        <div class="col-md-2 col-6">
                            <input type="text" class="form-control form-control-alt form-control-sm" v-model="filters.days_after_deadline" placeholder="Dni po terminie">
                        </div>
                    </div>
                </div>
            </div>
            <table v-if="data.data.length > 0 " class="table table-bordered table-striped table-vcenter">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Numer</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Data wystawienia</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Nazwa klienta</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">NIP</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Data płatności</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Wartość netto</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Dni po terminie</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in data.data">
                    <td class="text-center fs-sm">{{ index + 1 }}</td>
                    <td class="fs-sm">{{ item.number }}</td>
                    <td class="fs-sm">{{ item.date_issue }}</td>
                    <td class="fs-sm">{{ item.client_name }}</td>
                    <td class="fs-sm">{{ item.nip }}</td>
                    <td class="fs-sm">{{ item.payment_date }}</td>
                    <td class="fs-sm">{{ item.amount }}</td>
                    <td class="fs-sm">{{ item.days_after_dedline }}</td>
                </tr>
                </tbody>
            </table>
            <div class="alert alert-danger text-center" v-if="data.data.length < 1">Brak danych do wyśietlenia</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "InvoicesListComponent",
    data() {
        return {
            filters: {
                number: '',
                date_issue: '',
                client_name: '',
                nip: '',
                payment_date: '',
                days_after_deadline: '',
                pagination: 20
            },
            paginationNumbers: [5, 10, 20, 30, 50],
            isSearchBox: false,
            data: {}
        }
    },
    props: {
        list_url: ''
    },
    methods: {
        loadItems(page = 1) {
            this.$axios.get(this.list_url+`?page=${page}&number=${this.filters.number}&date_issue=${this.filters.date_issue}&client_name=${this.filters.client_name}&nip=${this.filters.nip}&payment_date=${this.filters.payment_date}&days_after_deadline=${this.filters.days_after_deadline}&pagination=${this.filters.pagination}`)
            .then((data) => {
                this.data = data.data;
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
