<template>
    <div>
        <div>
            <div class="relative w-full px-4 pb-3 max-w-full flex-grow flex-1 text-right">
                    <button
                        @click="showModal"
                        class="bg-green-500 text-white active:bg-green-600 text-xs font-bold px-6 py-2 my-3 rounded outline-none focus:outline-none mb-1"
                        type="button"
                        style="transition:all .15s ease">
                        <div class="text-white">Add Category <font-awesome-icon icon="plus" class="md"/></div>
                    </button>

            </div>
        </div>
        <div data-app>
            <v-card>
                <v-card-title>
                    Categories
                    <v-spacer/>
                    <v-text-field
                        v-model="searchKeyword"
                        label="Search"
                        single-line
                        hide-details/>
                </v-card-title>
                <v-data-table
                    :headers="headers"
                    :items="categories"
                    :search="searchKeyword"
                    loading
                    loading-text="Loading departments... Please wait"
                >
                    <template v-slot:item.actions="{ item }">
<!--                        <font-awesome-icon icon="edit" @click="showModal(item)" class="cursor-pointer text-blue-700"/>-->
                        <font-awesome-icon icon="trash" @click="deleteCategory(item)" class="cursor-pointer text-red-700"/>
                    </template>
                </v-data-table>
            </v-card>
        </div>

        <sweet-modal ref="categoryModal">
            <div class="flex flex-wrap mt-4">
                <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                        <div class="rounded-t mb-0 px-4 py-3 border-0">
                            <div class="flex flex-col">
                                <p class="text-3xl font-bold leading-7 text-center">New Category</p>
                                <form @submit.prevent="createCategory(editedCategory)">
                                    <div class="md:flex mt-8">
                                        <div class="w-full flex flex-col text-left">
                                            <label class="font-semibold leading-none">Category Name</label>
                                            <input v-model="editedCategory.category_name" type="text" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200" />
                                        </div>
                                    </div>
                                    <div class="md:flex mt-8">
                                        <div class="w-full flex flex-col text-left">
                                            <label class="font-semibold leading-none">Department</label>
                                            <select v-model="editedCategory.department_id" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200">
                                                <option
                                                    v-for="department in departments"
                                                    :key="department.id"
                                                    v-bind:value="department.id">{{department.department_name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex mt-8 mb-9 w-full text-white justify-center">
                                        <button type="submit" class="mt-9 font-semibold leading-none py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                                            Add Category
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
        name: "Categories",
        data(){
            return{
                isEdit:false,
                departments:[],
                categories:[],
                searchKeyword:'',
                editedCategory:{},
                headers:[
                    {
                        text: 'Category Name',
                        align: 'start',
                        value: 'category_name',
                    },
                    { text: 'Department',align: 'center', value: 'department.department_name'},
                    { text: 'Actions', align: 'center', value: 'actions', sortable: false },
                ],
            }
        },
        beforeMount(){
            this.loadCategories();

            url.get("departments/",)
                .then((response)=>
                {
                    this.departments = response.data;
                });
        },
        methods: {
            loadCategories(){
                url.get("categories/",)
                    .then((response)=>
                    {
                        this.categories = response.data;
                    });
            },
            showModal(category){
                this.editedCategory=category;
                this.$refs.categoryModal.open();
            },
            closeModal(){
                this.$refs.categoryModal.close();
                this.editedCategory={};
            },
            createCategory (category) {
                url.post("categories",category)
                    .then(response => {
                        if (response.data.success)
                        {
                            this.loadCategories();
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

            deleteCategory (category) {
                Vue.swal({
                    text: `Are you sure you want to delete ${category.category_name}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#57d675',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        url.delete(
                            "categories/" + category.id
                        ).then(response => {
                            if (response.data.success)
                            {
                                this.loadCategories();
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
