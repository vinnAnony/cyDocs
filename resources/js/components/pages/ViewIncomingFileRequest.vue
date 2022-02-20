<template>
    <div class="flex flex-wrap mt-4">
        <div class="w-full xl:w-8/12 mb-6 xl:mb-0 px-4 mx-auto">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-3 shadow-lg rounded">
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

                        <p class="text-xl font-bold leading-7 text-center">File Request info</p>
                        <div>
                            <div class="md:flex mt-8">
                                <div class="w-full flex flex-col text-left">
                                    <p>
                                        <span class="font-semibold">File Name:</span>
                                        <span class="font-normal">{{currentFileRequest.document.document_title}}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="md:flex mt-8">
                                <div class="w-full flex flex-col text-left">
                                    <p>
                                        <span class="font-semibold">Requester:</span>
                                        <span class="font-normal">{{currentFileRequest.requester.name}}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="md:flex mt-8">
                                <div class="w-full flex flex-col text-left">
                                    <p>
                                        <span class="font-semibold">Role:</span>
                                        <span class="font-normal">{{currentFileRequest.requester.role_id}}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="md:flex mt-8">
                                <div class="w-full flex flex-col text-left">
                                    <p>
                                        <span class="font-semibold">Department:</span>
                                        <span class="font-normal">{{currentFileRequest.requester.department_id}}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="md:flex mt-8">
                                <div class="w-full flex flex-col text-left">
                                    <p>
                                        <span class="font-semibold">Request Message:</span>
                                        <span class="font-normal bg-gray-200">{{currentFileRequest.requester_message}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-col">
                        <div class="flex mt-8 mb-9 w-full justify-start gap-2">
                            <div class="flex flex-row gap-2 items-center text-left">
                                <label class="font-semibold leading-none">Expiration Date:</label>
                                <datetime
                                        type="datetime"
                                        zone="Africa/Nairobi"
                                        v-model="fileRequestResponse.expires_at"
                                        class="bg-gray-400 py-3 pl-1 rounded"
                                        :auto="true"
                                        :minute-step="15"
                                        :min-datetime="currentDateTime"/>
                            </div>
                        </div>
                        <div class="w-full flex flex-col text-left mt-4">
                            <label class="font-semibold leading-none">Message</label>
                            <textarea v-model="fileRequestResponse.approver_message"
                                      type="text"
                                      placeholder="Leave a message"
                                      class="h-40 text-base leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-400 border rounded border-gray-200"/>
                        </div>
                    </div>
                        <div class="flex mt-8 mb-9 w-full text-white justify-end gap-2">
                            <button
                                @click="acceptFileRequest"
                                type="submit" class="mt-9 font-semibold leading-none py-4 px-10 bg-green-700 rounded hover:bg-green-600 focus:ring-2 focus:ring-offset-2 focus:ring-green-700 focus:outline-none">
                                Accept
                            </button>
                            <button
                                @click="rejectFileRequest"
                                type="submit" class="mt-9 font-semibold leading-none py-4 px-10 bg-red-700 rounded hover:bg-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:outline-none">
                                Reject
                            </button>
                        </div>
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
        name: "ViewIncomingFileRequest",
        data(){
          return {
              isError:false,
              responseErrors:[],
              currentDateTime:new Date().toLocaleString().replace(',',''),
              currentFileRequest:{},
              fileRequestResponse:{},
          }
        },
        beforeMount() {
            url.get("file-request/"+this.$route.params.id,)
                .then((response) => {
                    this.isTableLoading = false;
                    this.currentFileRequest = response.data;
                });
        },
        methods:{
            acceptFileRequest(){
                this.fileRequestResponse.status = 2;
                this.fileRequestResponse.approver_id = this.$store.getters['auth/user'].id;
                if(this.fileRequestResponse.expires_at){
                    url.put("file-requests/" + this.$route.params.id,this.fileRequestResponse)
                        .then(response => {
                            cyDocsAlert(response.data.success ? 'success' : 'error',response.data.message);
                            if (response.data.success){
                                this.$router.push({name:'incoming-file-requests'});
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
                }else{
                    cyDocsAlert('error','Expiry date required!');
                }

            },
            rejectFileRequest(){
                this.fileRequestResponse.status = 3;
                this.fileRequestResponse.approver_id = this.$store.getters['auth/user'].id;
                if(this.fileRequestResponse.approver_message){
                    url.put("file-requests/" + this.$route.params.id,this.fileRequestResponse)
                        .then(response => {
                            if (response.data.success)
                            {

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
                }else{
                    cyDocsAlert('error','Reason for rejecting request is required!');
                }

            },
        }
    }
</script>

<style scoped>

</style>
