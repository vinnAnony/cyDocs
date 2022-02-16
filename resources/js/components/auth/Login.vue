<template>
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center sm:py-12">
        <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
            <h1 class="font-bold text-center text-2xl mb-5">Login</h1>
            <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
                <div class="px-5 py-4">
                    <form @submit.prevent="login">
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Username</label>
                        <input v-model="loginData.email" type="email" required class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" />
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Password</label>
                        <input v-model="loginData.password" type="password" required class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" />
                        <button type="submit" class="transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm
                        focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white w-full py-3 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                            <span class="inline-block mr-2">Login</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </button>
                    </form>

                </div>
                <div class="py-5">
                    <div class="grid grid-cols-1">
                        <div class="text-center sm:text-left whitespace-nowrap">
                            <button @click="$emit('switchView')" class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block align-text-top">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                </svg>
                                <span class="inline-block ml-1">Sign Up</span>
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
        name: "Login",
        data: () => {
            return {
                loginData:{}
            };
        },
        methods: {
            login(){
                url.post("login",this.loginData)
                    .then(response => {
                        console.log(response.data.original);

                        cyDocsAlert(response.data.original.success ? 'success' : 'error',response.data.original.message);

                        if (response.data.original.success){
                            //this.$store.dispatch('auth/login',response.data);
                            // this.$router.push('/home');
                        }

                    })
                    .catch(error => {
                        // let errors = error.response.original.errors;
                        // for (const error of errors){
                        //     cyDocsAlert('error',error.msg);
                        // }
                    });
            },
        },
    }
</script>

<style scoped>

</style>
