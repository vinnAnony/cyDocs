<template>
    <div>
        <div>
            <div class="relative w-full px-4 pb-3 max-w-full flex-grow flex-1 text-right">
                <router-link :to="{name:'new-file-upload'}">
                    <button
                        class="bg-green-500 text-white active:bg-green-600 text-xs font-bold px-6 py-2 my-3 rounded outline-none focus:outline-none mb-1"
                        type="button"
                        style="transition:all .15s ease">
                        <div class="text-white">New Upload <font-awesome-icon icon="plus" class="md"/></div>
                    </button>
                </router-link>

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
<!--                        <font-awesome-icon icon="eye" class="cursor-pointer text-blue-700"/>-->
                        <font-awesome-icon icon="download"
                                           v-if="userRoleId>=2"
                                           class="cursor-pointer text-green-700" @click="downloadDocument(item)"/>
                        <font-awesome-icon icon="trash" @click="deleteDocument(item)"
                                           v-if="userRoleId>=3"
                                           class="cursor-pointer text-red-700"/>
                    </template>
                    <template v-if="!isTableLoading && documents.length===0" v-slot:no-data>
                        Oops! No documents for you.
                    </template>
                </v-data-table>
            </v-card>
        </div>

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
                userRoleId: null,
                isTableLoading:true,
                searchKeyword:'',
                documents:[],
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
            this.userRoleId = this.$store.getters['auth/user'].role_id;
            this.loadUserDocuments();
        },
        methods: {
            loadUserDocuments(){
                this.isTableLoading = true;
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
            downloadDocument(document){
                url.get("download-document/" + document.id,{
                    responseType: 'arraybuffer'
                })
                    .then((response)=>
                    {
                        console.log(response)

                        let blob = new Blob([response.data], { type: 'application/docx' }),
                            url = window.URL.createObjectURL(blob)

                        window.open(url)
                    });
            },
            deleteDocument(document){
                Vue.swal({
                    text: `Are you sure you want to delete ${document.document_title}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#57d675',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        url.delete(
                            "document/" + document.id
                        ).then(response => {
                                if (response.data.success)
                                {
                                    this.loadUserDocuments();
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
                console.log(document.id)
            }
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
