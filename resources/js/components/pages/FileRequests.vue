<template>
    <div>
        <div>
            <div class="relative w-full px-4 pb-3 max-w-full flex-grow flex-1 text-right">
                <router-link :to="{name:'new-file-request'}">
                    <button
                        class="bg-green-500 text-white active:bg-green-600 text-xs font-bold px-6 py-2 my-3 rounded outline-none focus:outline-none mb-1"
                        type="button"
                        style="transition:all .15s ease">
                        <div class="text-white">New File Request <font-awesome-icon icon="plus" class="md"/></div>
                    </button>
                </router-link>

            </div>
        </div>
        <div data-app>
            <v-card>
                <v-card-title>
                    File Requests
                    <v-spacer/>
                    <v-text-field
                        v-model="searchKeyword"
                        label="Search"
                        single-line
                        hide-details/>
                </v-card-title>
                <v-data-table
                    :headers="headers"
                    :items="fileRequests"
                    :search="searchKeyword"
                    :loading="isTableLoading"
                    loading-text="Loading file requests... Please wait">
                    <template v-slot:item.actions="{ item }">
                        <font-awesome-icon icon="eye" class="cursor-pointer text-blue-700"/>
                        <font-awesome-icon icon="download" class="cursor-pointer text-green-700"/>
                    </template>
                    <template v-if="!isTableLoading && fileRequests.length===0" v-slot:no-data>
                        Oops! No file requests for you.
                    </template>
                </v-data-table>
            </v-card>
        </div>
    </div>
</template>

<script>
    import url from "../../utils/http";
    export default {
        name: "FileRequests",
        data(){
            return{
                isError:false,
                isTableLoading:true,
                searchKeyword:'',
                fileRequests:[],
                headers:[
                    {
                        text: 'File Name',
                        align: 'start',
                        value: 'document_title',
                    },
                    { text: 'Category', value: 'category.category_name' },
                    { text: 'Department', value: 'department.department_name'},
                    { text: 'Expiry', value: 'department.department_name'},
                    { text: 'Actions', value: 'actions', sortable: false },
                ]
            }
        }
    }
</script>

<style scoped>

</style>
