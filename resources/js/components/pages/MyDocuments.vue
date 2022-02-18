<template>
    <div>
        <div>
            <div class="relative w-full px-4 pb-3 max-w-full flex-grow flex-1 text-right">
                <button
                    @click="uploadDocument()"
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
                    loading
                    loading-text="Loading users... Please wait">
                    <template v-slot:item.actions="{ item }">
                        <font-awesome-icon icon="edit" @click="showModal(item)" class="cursor-pointer text-blue-700"/>
                        <font-awesome-icon icon="trash" @click="deleteDocument(item)" class="cursor-pointer text-red-700"/>
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
                                <form @submit.prevent="editDocument(editedDocument)">
                                    <div class="md:flex mt-8">
                                        <div class="w-full flex flex-col">
                                            <label class="font-semibold leading-none">Name</label>
                                            <input v-model="editedDocument.name" type="text" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200" />
                                        </div>
                                    </div>
                                    <div class="md:flex mt-8">
                                        <div class="w-full flex flex-col">
                                            <label class="font-semibold leading-none">Category</label>
                                            <select v-model="editedDocument.department_id" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200">
                                                <option
                                                    v-for="department in departments"
                                                    :key="department.id"
                                                    v-bind:value="department.id">{{department.department_name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="md:flex items-center mt-12">
                                        <div class="w-full md:w-1/3 flex flex-col  md:mt-0 mt-4">
                                            <label class="font-semibold leading-none">Read</label>
                                            <input v-model="editedDocument.canRead" type="checkbox" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                        </div>
                                        <div class="w-full md:w-1/3 flex flex-col md:ml-6 md:mt-0 mt-4">
                                            <label class="font-semibold leading-none">Write</label>
                                            <input v-model="editedDocument.canWrite" type="checkbox" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                        </div>
                                        <div class="w-full md:w-1/3 flex flex-col md:ml-6 md:mt-0 mt-4">
                                            <label class="font-semibold leading-none">Delete</label>
                                            <input v-model="editedDocument.canDelete" type="checkbox" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                                        </div>
                                    </div>
                                    <div class="md:flex mt-8 mb-9 w-full text-white">
                                        <button type="submit" class="mt-9 font-semibold leading-none py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                                            Update Document
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

    export default {
        name: "MyDocuments",
        data(){
            return{
                myDocuments:[],
                myDocument:{}
            }
        },
        beforeMount(){
            url.get("user-documents/",)
                .then((response)=>
                {
                    this.users = response.data;
                })
        },
    }
</script>

<style scoped>

</style>
