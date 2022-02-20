<template>
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
                                <p v-for="error in responseErrors" :key="error">
                                    {{error}}
                                </p>
                            </v-alert>
                        </v-app>

                        <p class="text-3xl font-bold leading-7 text-center">New File Upload</p>
                        <form @submit.prevent="isEdit ? editDocument(editedDocument) : uploadDocument(editedDocument)">
                            <div class="md:flex mt-8">
                                <div class="w-full flex flex-col text-left">
                                    <label class="font-semibold leading-none">Name</label>
                                    <input
                                        type="text"
                                        v-model="docName"
                                        required
                                        class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200" />
                                </div>
                            </div>
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
                                    <label class="font-semibold leading-none">Min. Access Level</label>
                                    <select v-model="editedDocument.role_id" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200">
                                        <option
                                            v-for="role in userRoles"
                                            :key="role.id"
                                            v-bind:value="role.id">{{role.role_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex mt-8 mb-9 w-full text-white justify-center">
                                <button
                                    @click="responseErrors=[]"
                                    type="submit" class="mt-9 font-semibold leading-none py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                                    {{isEdit ? 'Edit' : 'Upload' }} Document
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import url from "../../utils/http";
    import _ from "lodash";
    import axios from "axios";
    import {cyDocsAlert} from "../../utils/alert";

    export default {
        name: "NewFileUpload",
        data() {
            return {
                isError:false,
                responseErrors:[],
                isEdit: false,
                categories:[],
                userRoles:[],
                editedIndex: -1,
                editedDocument:{},
                docFile: null,
                docName: null,
            }
        },
        beforeMount() {
            url.get("department-categories/"+ this.$store.getters['auth/user'].department_id,)
                .then((response)=>
                {
                    this.categories = response.data;
                });

            url.get("user-roles/",)
                .then((response)=>
                {
                    this.userRoles = response.data;
                });
        },
        methods: {
            handleFileObject() {
                this.docFile = this.$refs.file.files[0];
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
                    if (response.data.success){
                        this.$router.push({name:'file-manager'});
                    }
                }).catch(err => {
                    let errors = err.response.data.errors;
                    Object.entries(errors).map(error => {
                        error[1].forEach(err => {
                            this.isError = true;
                            this.responseErrors.push(err);
                            cyDocsAlert('error',err);
                        })
                    });
                });
            },
        }
    }
</script>

<style scoped>

</style>
