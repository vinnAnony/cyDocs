<template>
    <div class="bg-gray-800">
        <nav class=" 2xl:mx-auto sm:py-6 sm:px-7 py-5 px-4">

            <div class="flex justify-between">
                <div class="hidden sm:flex flex-row items-center space-x-6">
                    <ul class="hidden md:flex flex-auto space-x-2">
                        <router-link :to="{name:'welcome'}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            Home
                        </router-link>
                    </ul>
                </div>
                <div class="flex space-x-3 items-center justify-center">
                    <h1 class=" font-normal text-2xl leading-6 text-white" >CyDocs</h1>
                </div>
                <div class="hidden sm:flex flex-row space-x-4">
                    <router-link v-if="!authState.loggedIn" :to="{name:'signup'}">
                        <button class="rounded-md flex space-x-2 w-24 h-10 font-normal text-sm leading-3 text-white bg-transparent border border-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 focus:bg-indigo-600 hover:bg-indigo-600 duration-150 justify-center items-center" >
                            Sign Up
                        </button>
                    </router-link>
                    <router-link v-if="!authState.loggedIn" :to="{name:'login'}">
                        <button class="rounded-md flex space-x-2 w-24 h-10 font-normal text-sm leading-3 text-white bg-transparent border border-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 focus:bg-indigo-600 hover:bg-indigo-600 duration-150 justify-center items-center">
                            Sign In
                        </button>
                    </router-link>
                </div>

                <div id="bgIcon" @click="toggleMenu()"  class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800  flex justify-center items-center sm:hidden cursor-pointer">
                    <font-awesome-icon icon="bars" class="text-white text-lg"/>
                    <font-awesome-icon icon="times" class="hidden text-white text-lg"/>
                </div>
            </div>
            <!--      Mobile navigation          -->
            <div id="MobileNavigation" class="hidden sm:hidden mt-4 mx-auto">
                <div class="flex flex-col gap-4 mt-4 w-full mx-2 mx-auto">
                    <ul id="list" class="flex flex-col gap-1 w-full mx-2 mx-auto">
                        <router-link :to="{name:'welcome'}" class="px-4 py-3 h-10 text-gray-300 bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            Home
                        </router-link>
                    </ul>
                </div>
                <div class="flex flex-col gap-4 mt-4 w-full mx-2 mx-auto">
                    <router-link :to="{name:'signup'}">
                        <button class="rounded-md flex space-x-2 w-full h-10 font-normal text-sm leading-3 text-white bg-transparent border border-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 focus:bg-indigo-600 hover:bg-indigo-600 duration-150 justify-center items-center">
                            Sign Up
                        </button>
                    </router-link>
                    <router-link :to="{name:'login'}">
                        <button class="rounded-md flex space-x-2 w-full h-10 font-normal text-sm leading-3 text-white bg-transparent border border-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 focus:bg-indigo-600 hover:bg-indigo-600 duration-150 justify-center items-center">
                            Log In
                        </button>
                    </router-link>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    export default {
        name: "DefaultNavbar",
        data(){
            return{}
        },
        methods:{
            toggleMenu(){

                let icon = document.getElementById('bgIcon');
                const childEle = icon.children;

                childEle[0].classList.toggle('hidden');
                childEle[1].classList.toggle('hidden');

                let mobileNav = document.getElementById('MobileNavigation').classList.toggle('hidden');

            },
        },
        computed:{
            ...mapGetters('auth', {
                authState: 'authState'
            })
        },
    }
</script>

<style>

</style>
