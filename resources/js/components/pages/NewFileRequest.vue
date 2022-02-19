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

                            <p class="text-3xl font-bold leading-7 text-center">Create File Request</p>
                            <form @submit.prevent="createFileRequest">
                                <div class="md:flex mt-8">
                                    <div class="w-full flex flex-col text-left">
                                        <label class="font-semibold leading-none">Department</label>
                                        <select v-model="fileRequest.department_id"
                                                @change="loadCategories"
                                                class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200">
                                            <option
                                                v-for="department in departments"
                                                :key="department.id"
                                                v-bind:value="department.id">{{department.department_name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:flex mt-8">
                                    <div class="w-full flex flex-col text-left">
                                        <label class="font-semibold leading-none">Category</label>
                                        <select v-model="fileRequest.category_id"
                                                @change="loadDocuments"
                                                class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200">
                                            <option
                                                v-for="category in categories"
                                                :key="category.id"
                                                v-bind:value="category.id">{{category.category_name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:flex mt-8">
                                    <div class="w-full flex flex-col text-left">
                                        <label class="font-semibold leading-none">File Name</label>
                                        <select v-model="fileRequest.document_id" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200">
                                            <option
                                                v-for="document in documents"
                                                :key="document.id"
                                                v-bind:value="document.id">{{document.document_title}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:flex mt-8">
                                    <div class="w-full flex flex-col text-left">
                                        <label class="font-semibold leading-none">Description</label>
                                        <textarea v-model="fileRequest.requester_message"
                                                  type="text"
                                                  class="h-40 text-base leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200"/>
                                    </div>
                                </div>
                                <div class="flex mt-8 mb-9 w-full text-white justify-center">
                                    <button
                                        @click="responseErrors=[]"
                                        type="submit" class="mt-9 font-semibold leading-none py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                                        Request File
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
    import {cyDocsAlert} from "../../utils/alert";
    export default {
        name: "NewFileRequest",
        data(){
            return{
                responseErrors:[],
                isError:false,
                departments:[],
                categories:[],
                documents:[],
                fileRequest:{},
            }
        },
        beforeMount() {
            url.get("departments/",)
                .then((response) => {
                    this.departments = response.data;
                });
        },
        methods: {
          loadDocuments(){
              console.log('load');
              if (this.fileRequest.length!==0 && this.fileRequest.department_id && this.fileRequest.category_id){
                  url.get("department-category-documents/",
                      {
                          params:{
                              department_id:this.fileRequest.department_id,
                              category_id:this.fileRequest.category_id,
                          }
                      })
                      .then((response) => {
                          this.documents = response.data;
                          if(this.documents.length===0) {
                              delete this.fileRequest.document_id;
                          }
                      });
              }

          },
            createFileRequest(){
                this.fileRequest.requester_id = this.$store.getters['auth/user'].id;
                url.post("file-requests",this.fileRequest)
                    .then(response => {
                        cyDocsAlert(response.data.success ? 'success' : 'error',response.data.message);
                        if (response.data.success){
                            this.$router.push({name:'file-requests'});
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
            },
            loadCategories(){
                url.get("department-categories/"+ this.fileRequest.department_id,)
                    .then((response)=>
                    {
                        this.categories = response.data;
                    });
            }
        },
    }
</script>

<style scoped>

</style>
