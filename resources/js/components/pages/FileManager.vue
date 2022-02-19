<template>
    <div>
        <div>
            <div class="relative w-full px-4 pb-3 max-w-full flex-grow flex-1 text-right">
                <button
                    @click="showModal()"
                    class="bg-green-500 text-white active:bg-green-600 text-xs font-bold px-6 py-2 my-3 rounded outline-none focus:outline-none mb-1"
                    type="button"
                    style="transition:all .15s ease">
                    <div class="text-white">New Upload <font-awesome-icon icon="plus" class="md"/></div>
                </button>
            </div>
        </div>
        <div data-app>
            <v-card>
                <v-card-title>
                    Documents
                    <v-spacer/>
                    <v-text-field
                        v-model="searchKeyword"
                        label="Search"
                        single-line
                        hide-details/>
                </v-card-title>
                <v-data-table
                    :headers="headers"
                    :items="documents"
                    :search="searchKeyword"
                    :loading="isTableLoading"
                    loading-text="Loading documents... Please wait">
                    <template v-slot:item.actions="{ item }">
                        <font-awesome-icon icon="eye" class="cursor-pointer text-blue-700"/>
                        <font-awesome-icon icon="download" class="cursor-pointer text-green-700"/>
                        <font-awesome-icon icon="trash" @click="deleteDocument(item)" class="cursor-pointer text-red-700"/>
                    </template>
                    <template v-if="!isTableLoading && documents.length===0" v-slot:no-data>
                        Oops! No documents for you.
                    </template>
                </v-data-table>
            </v-card>
        </div>

        <sweet-modal ref="documentModal">
            <div class="flex flex-wrap mt-4">
                <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                        <div class="rounded-t mb-0 px-4 py-3 border-0">
                            <div class="flex flex-col">
                                <v-app class="ma-0 pa-0">
                                    <v-alert
                                        v-if="isError"
                                        color="red"
                                        dense
                                        dismissible
                                        outlined
                                        prominent>
                                        There are issues with your inputs
                                    </v-alert>
                                </v-app>

                                <p class="text-3xl font-bold leading-7 text-center">Document Upload</p>
                                <form @submit.prevent="isEdit ? editDocument(editedDocument) : uploadDocument(editedDocument)">
                                    <div class="md:flex mt-8">
                                        <div class="w-full flex flex-col text-left">
                                            <label class="font-semibold leading-none">Name</label>
                                            <input type="file"
                                                   ref="file" @change="handleFileObject()"
                                                   class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200" />
                                        </div>
                                    </div>
                                    <div class="md:flex mt-8">
                                        <div class="w-full flex flex-col text-left">
                                            <label class="font-semibold leading-none">Category</label>
                                            <select v-model="editedDocument.category_id" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200">
                                                <option
                                                    v-for="category in categories"
                                                    :key="category.id"
                                                    v-bind:value="category.id">{{category.category_name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="md:flex mt-8">
                                        <div class="w-full flex flex-col text-left">
                                            <label class="font-semibold leading-none">Role</label>
                                            <select v-model="editedDocument.role_id" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200">
                                                <option
                                                    v-for="role in userRoles"
                                                    :key="role.id"
                                                    v-bind:value="role.id">{{role.role_name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex mt-8 mb-9 w-full text-white justify-center">
                                        <button type="submit" class="mt-9 font-semibold leading-none py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                                            {{isEdit ? 'Edit' : 'Upload' }} Document
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
    import {mapGetters} from "vuex";
    import axios from 'axios'
    import _ from 'lodash'
    import {cyDocsAlert} from "../../utils/alert";

    export default {
        name: "FileManager",
        data(){
            return{
                isError:false,
                isEdit: false,
                isTableLoading:true,
                departments:[],
                categories:[],
                userRoles:[],
                searchKeyword:'',
                editedIndex: -1,
                editedDocument:{},
                documents:[],
                docFile: null,
                docName: null,
                headers:[
                    {
                        text: 'Name',
                        align: 'start',
                        value: 'document_title',
                    },
                    { text: 'Category', value: 'category.category_name' },
                    { text: 'Department', value: 'department.department_name'},
                    { text: 'Min. Access', value: 'access_role.role_name', sortable: false,},
                    { text: 'Date created', value: 'created_at' },
                    { text: 'Created by', value: 'creator.name' },
                    { text: 'Actions', value: 'actions', sortable: false },
                ]
            }
        },
        beforeMount(){
            url.get("departments/",)
                .then((response)=>
                {
                    this.departments = response.data;
                });
            url.get("categories/",)
                .then((response)=>
                {
                    this.categories = response.data;
                });

            url.get("user-roles/",)
                .then((response)=>
                {
                    this.userRoles = response.data;
                });

            url.get("user-documents/" ,
                {
                    params:{
                        department_id:this.$store.getters['auth/user'].department_id,
                        role_id:this.$store.getters['auth/user'].role_id,
                    }
                })
                .then((response)=>
                {
                    this.isTableLoading = false;
                    this.documents = response.data;
                });
        },
        methods: {
            showModal() {
                this.$refs.documentModal.open();
            },
            editModal(document){
                this.isEdit = true;
                this.editedDocument = document;
                this.showModal();
            },
            closeModal() {
                this.$refs.documentModal.close();
                this.editedUser = {};
                this.editedIndex = -1;
            },
            handleFileObject() {
                this.docFile = this.$refs.file.files[0];
                this.docName = this.docFile.name;
            },
            uploadDocument(){
                let formData = new FormData();
                formData.append('document_title', this.docName);
                formData.append('doc_file', this.docFile);
                formData.append('created_by', this.$store.getters['auth/user'].id);
                formData.append('department_id', this.$store.getters['auth/user'].department_id);
                _.each(this.editedDocument, (value, key) => {
                    formData.append(key, value)
                });
                axios.post('/api/documents', formData, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${localStorage.getItem('user') != null ? JSON.parse(localStorage.getItem('cyDocsToken')) : null}`,
                            'Content-Type': "multipart/form-data "
                        }
                    }
                ).then(response => {
                    cyDocsAlert(response.data.success ? 'success' : 'error',response.data.message);
                    this.closeModal();
                    this.editedDocument = {};
                }).catch(err => {
                    let errors = err.response.data.errors;
                    Object.entries(errors).map(error => {
                        error[1].forEach(err => {
                            this.isError = true;
                            cyDocsAlert('error',err);
                        })
                    });
                });
            },
        },
        computed:{
            ...mapGetters('auth', {
                authState: 'authState',
                user: 'user'
            })
        },
    }
</script>

<style scoped>

</style>
