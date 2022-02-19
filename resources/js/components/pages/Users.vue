<template>
    <div>
<!--        <div>-->
<!--            <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">-->
<!--                <button-->
<!--                    class="bg-green-500 text-white active:bg-green-600 text-xs font-bold px-6 py-2 my-3 rounded outline-none focus:outline-none mr-1 mb-1"-->
<!--                    type="button"-->
<!--                    style="transition:all .15s ease">-->
<!--                    <font-awesome-icon icon="plus" class="text-white md"/>-->
<!--                </button>-->
<!--            </div>-->
<!--        </div>-->
        <div data-app>
            <v-card>
                <v-card-title>
                    Users
                    <v-spacer/>
                    <v-text-field
                        v-model="searchKeyword"
                        label="Search"
                        single-line
                        hide-details/>
                </v-card-title>
                <v-data-table
                    :headers="headers"
                    :items="users"
                    :search="searchKeyword"
                    loading
                    loading-text="Loading users... Please wait"
                >
                    <template v-slot:item.actions="{ item }">
                        <font-awesome-icon icon="edit" @click="showModal(item)" class="cursor-pointer text-blue-700"/>
                        <font-awesome-icon icon="trash" @click="deleteUser(item)" class="cursor-pointer text-red-700"/>
                    </template>
                </v-data-table>
            </v-card>
        </div>

        <sweet-modal ref="userModal">
            <div class="flex flex-wrap mt-4">
                <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                        <div class="rounded-t mb-0 px-4 py-3 border-0">
                            <div class="flex flex-col">
                                <p class="text-3xl font-bold leading-7 text-center">User Info</p>
                                <form @submit.prevent="editUser(editedUser)">
                                    <div class="md:flex mt-8">
                                        <div class="w-full flex flex-col text-left">
                                            <label class="font-semibold leading-none">Name</label>
                                            <input v-model="editedUser.name" type="text" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200" />
                                        </div>
                                    </div>
                                    <div class="md:flex mt-8">
                                        <div class="w-full flex flex-col text-left">
                                            <label class="font-semibold leading-none">Department</label>
                                            <select v-model="editedUser.department_id" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200">
                                                <option
                                                    v-for="department in departments"
                                                    :key="department.id"
                                                    v-bind:value="department.id">{{department.department_name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="md:flex mt-8  mb-9">
                                        <div class="w-full flex flex-col text-left">
                                            <label class="font-semibold leading-none">Role</label>
                                            <select v-model="editedUser.role_id" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200">
                                                <option
                                                    v-for="role in roles"
                                                    :key="role.id"
                                                    v-bind:value="role.id">{{role.role_name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex mt-8 mb-9 w-full text-white justify-center">
                                        <button type="submit" class="mt-9 font-semibold leading-none py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                                            Update User
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
    import url from "../../utils/http";
    import {cyDocsAlert} from "../../utils/alert";
    export default {
        name: "Users",
        data(){
            return{
                departments:[],
                roles:[
                    {
                        id:1,
                        role_name:'Staff'
                    },
                    {
                        id:2,
                        role_name:'Supervisor'
                    },
                    {
                        id:3,
                        role_name:'Manager'
                    }
                ],
                searchKeyword:'',
                editedIndex: -1,
                editedUser:{},
                users:[],
                headers:[
                    {
                        text: 'Name',
                        align: 'start',
                        value: 'name',
                    },
                    { text: 'Email', value: 'email', sortable: false,},
                    { text: 'Department', value: 'department.department_name' },
                    { text: 'Role', value: 'role_id' },
                    { text: 'Actions', value: 'actions', sortable: false },
                ]
            }
        },
        beforeMount(){
            url.get("users/",)
                .then((response)=>
                {
                    this.users = response.data;
                });
            url.get("departments/",)
                .then((response)=>
                {
                    this.departments = response.data;
                });
        },
        methods: {
            showModal(user){
                this.editedUser=user;
                this.$refs.userModal.open();
            },
            closeModal(){
                this.$refs.userModal.close();
                this.editedUser={};
                this.editedIndex = -1;
            },
            editUser (user) {
                url.put("users/" + user.id,user)
                    .then(response => {
                        if (response.data.success)
                        {
                            cyDocsAlert('success',response.data.message);
                            this.closeModal();
                            this.editedIndex = this.users.indexOf(user);
                            this.editedUser = Object.assign({}, user);
                        }
                    })
                    .catch(error => {
                        let errors = error.response.data.errors;
                        for (const error of errors){
                            cyDocsAlert('error',error.msg);
                        }
                    });
            },

            deleteUser (user) {
                this.editedIndex = this.users.indexOf(user);
                this.editedUser = Object.assign({}, user);
                //
            },

        },
    }
</script>

<style scoped>

</style>
