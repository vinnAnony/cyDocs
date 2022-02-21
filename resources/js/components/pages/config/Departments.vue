<template>
    <div>
        <div>
            <div class="relative w-full px-4 pb-3 max-w-full flex-grow flex-1 text-right">
                    <button
                        @click="showModal"
                        class="bg-green-500 text-white active:bg-green-600 text-xs font-bold px-6 py-2 my-3 rounded outline-none focus:outline-none mb-1"
                        type="button"
                        style="transition:all .15s ease">
                        <div class="text-white">Add Department <font-awesome-icon icon="plus" class="md"/></div>
                    </button>

            </div>
        </div>
        <div data-app>
            <v-card>
                <v-card-title>
                    Departments
                    <v-spacer/>
                    <v-text-field
                        v-model="searchKeyword"
                        label="Search"
                        single-line
                        hide-details/>
                </v-card-title>
                <v-data-table
                    :headers="headers"
                    :items="departments"
                    :search="searchKeyword"
                    loading
                    loading-text="Loading departments... Please wait"
                >
                    <template v-slot:item.actions="{ item }">
<!--                        <font-awesome-icon icon="edit" @click="showModal(item)" class="cursor-pointer text-blue-700"/>-->
                        <font-awesome-icon icon="trash" @click="deleteDepartment(item)" class="cursor-pointer text-red-700"/>
                    </template>
                </v-data-table>
            </v-card>
        </div>

        <sweet-modal ref="departmentModal">
            <div class="flex flex-wrap mt-4">
                <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                        <div class="rounded-t mb-0 px-4 py-3 border-0">
                            <div class="flex flex-col">
                                <p class="text-3xl font-bold leading-7 text-center">New Department</p>
                                <form @submit.prevent="createDepartment(editedDepartment)">
                                    <div class="md:flex mt-8">
                                        <div class="w-full flex flex-col text-left">
                                            <label class="font-semibold leading-none">Department Name</label>
                                            <input v-model="editedDepartment.department_name" type="text" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200" />
                                        </div>
                                    </div>
                                    <div class="flex mt-8 mb-9 w-full text-white justify-center">
                                        <button type="submit" class="mt-9 font-semibold leading-none py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                                            Create Department
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </sweet-modal>

    </div>
</template>

<script>
    import url from "../../../utils/http";
    import {cyDocsAlert} from "../../../utils/alert";
    export default {
        name: "Departments",
        data(){
            return{
                departments:[],
                searchKeyword:'',
                editedDepartment:{},
                headers:[
                    {
                        text: 'Department Name',
                        align: 'start',
                        value: 'department_name',
                    },
                    { text: 'Actions',align: 'center', value: 'actions', sortable: false },
                ],
            }
        },
        beforeMount(){
            this.loadDepartments();

        },
        methods: {
            loadDepartments(){
                url.get("departments/",)
                    .then((response)=>
                    {
                        this.departments = response.data;
                    });
            },
            showModal(department){
                this.editedDepartment=department;
                this.$refs.departmentModal.open();
            },
            closeModal(){
                this.$refs.departmentModal.close();
                this.editedDepartment={};
            },
            createDepartment (department) {
                url.post("departments",department)
                    .then(response => {
                        if (response.data.success)
                        {
                            this.loadDepartments();
                            cyDocsAlert('success',response.data.message);
                            this.closeModal();
                        }
                    })
                    .catch(error => {
                        let errors = error.response.data.errors;
                        for (const error of errors){
                            cyDocsAlert('error',error.msg);
                        }
                    });
            },

            deleteDepartment (department) {
                Vue.swal({
                    text: `Are you sure you want to delete ${department.department_name}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#57d675',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        url.delete(
                            "departments/" + department.id
                        ).then(response => {
                            if (response.data.success)
                            {
                                this.loadDepartments();
                                cyDocsAlert('success','Deleted successfully.');
                            }
                        })
                            .catch(error => {
                                let errors = error.response.data.errors;
                                Object.entries(errors).map(error => {
                                    error[1].forEach(err => {
                                        this.isError = true;
                                        this.responseErrors.push(err);
                                        cyDocsAlert('error',err);
                                    })
                                });
                            });
                    }
                });

            },

        }

    }
</script>

<style scoped>

</style>
