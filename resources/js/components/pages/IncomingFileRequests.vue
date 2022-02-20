<template>
    <div>
        <div data-app>
            <v-card>
                <v-card-title>
                    Incoming File Requests
                    <v-spacer/>
                    <v-text-field
                        v-model="searchKeyword"
                        label="Search"
                        single-line
                        hide-details/>
                </v-card-title>
                <v-data-table
                    :headers="headers"
                    :items="incomingFileRequests"
                    :search="searchKeyword"
                    :loading="isTableLoading"
                    loading-text="Loading file requests... Please wait">
                    <template v-slot:item.actions="{ item }">
                        <router-link :to="{name:'view-incoming-file-request',params:{id: item.id}}">
                            <font-awesome-icon icon="eye" class="cursor-pointer text-blue-700"/>
                        </router-link>
                    </template>
                    <template v-if="!isTableLoading && incomingFileRequests.length===0" v-slot:no-data>
                        Oops! No incoming file requests found.
                    </template>
                </v-data-table>
            </v-card>
        </div>
    </div>
</template>

<script>
    import url from "../../utils/http";

    export default {
        name: "IncomingFileRequests",
        data(){
            return{
                isError:false,
                isTableLoading:true,
                searchKeyword:'',
                incomingFileRequests:[],
                headers:[
                    {
                        text: 'File Name',
                        align: 'start',
                        value: 'document.document_title',
                    },
                    { text: 'Requester', value: 'requester.name' },
                    { text: 'Status', value: 'status'},
                    { text: 'Expiry', value: 'expires_at'},
                    { text: 'Actions', value: 'actions', sortable: false },
                ],
            }
        },
        beforeMount() {
            url.get("department-file-requests/"+this.$store.getters['auth/user'].department_id,)
                .then((response) => {
                    this.isTableLoading = false;
                    this.incomingFileRequests = response.data;
                });
        },
    }
</script>

<style scoped>

</style>
