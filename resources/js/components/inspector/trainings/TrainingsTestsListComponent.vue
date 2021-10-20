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
                    <b-form-select v-model="filters.pagination" class="form-control form-control-sm form-control-alt" :options="paginationNumbers"
                                   size="sm"></b-form-select>
                </div>
                <div class="col-md-11 col-12">
                    <div class="row" v-if="isSearchBox">
                        <div class="col-md-1">
                            <input type="text" v-model="filters.id" placeholder="ID" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-2">
                            <input type="text" v-model="filters.number" placeholder="Numer" class="form-control form-control-sm form-control-alt">
                        </div>
                        <div class="col-md-3">
                            <input type="text" v-model="filters.name" placeholder="Nazwa" class="form-control form-control-sm form-control-alt">
                        </div>
                    </div>
                </div>
            </div>

            <table v-if="data.data.length > 0 " class="table table-bordered table-striped table-vcenter">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Numer</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Nazwa</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Działy</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in data.data">
                    <td class="text-center fs-sm">{{ index + 1 }}</td>
                    <td class="fs-sm">
                        {{ item.number }}
                    </td>
                    <td class="fs-sm">
                        {{ item.name }}
                    </td>
                    <td class="fs-sm">
                        <ul style="padding-left: 15px" v-if="item.departments.length > 0">
                            <li v-for="department in item.departments"> {{ department.name }}</li>
                        </ul>
                        <span class="small-no-item" v-if="item.departments.length < 1">Brak przypisanych działów</span>
                        <button @click="attachDepartmentModal(item)" class="btn-link" style="display: block;padding-left: 0;margin-top: 5px">przypisz dział</button>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>

        <b-modal ref="attach-department-modal" title="Przypisz dział do testu" hide-footer="true">
            <label v-for="department in departments" :for="'department-'+department.id" class="form-check-label"><input type="checkbox" :id="'department-'+department.id" :value="department.id" v-model="selectedTestDepartments"> {{ department.name }} </label>
            <button class="btn btn-sm btn-outline-primary d-block mt-3" @click="assignTestDepartment">Zapisz</button>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "TrainingsTestsListComponent",
    data() {
        return {
            data: {},
            filters: {
                id: '',
                name: '',
                number: '',
                status_id: '',
                pagination: 20
            },
            paginationNumbers: [5, 10, 20, 30, 50],
            isSearchBox: false,
            statuses: [],
            departments: [],
            selectedTestId: '',
            selectedTestDepartments: []
        }
    },
    props: {
        list_url: '',
    },
    methods: {
        loadData(page = 1) {
            this.$axios.get(this.list_url + `?page=${page}&name=${this.filters.name}&number=${this.filters.number}&status_id=${this.filters.status_id}`)
                .then((data) => {
                    this.data = data.data;
                })
        },
        assignTestDepartment() {
            this.$axios.patch(`/inspector/api/trainings/tests/assign-test-department/${this.selectedTestId}`, this.selectedTestDepartments)
                .then((data) => {
                    if (data.data.success === 1) {
                        this.loadData();
                        this.$refs['attach-department-modal'].hide();
                        this.selectedTestId = '';
                        this.selectedTestDepartments = [];
                    }
                })
        },
        attachDepartmentModal(item) {
            this.loadDepartments();
            this.selectedTestId = item.id;
            this.selectedTestDepartments = item.departments;
            this.$refs['attach-department-modal'].show();
        },
        loadDepartments() {
            this.$axios.get('/inspector/api/departments/')
                .then((data) => {
                    this.departments = data.data.data;
                })
        },
    },
    created() {
        this.loadData();
    }
}
</script>

<style scoped>

</style>
