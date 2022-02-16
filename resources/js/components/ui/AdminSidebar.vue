<template>
    <nav class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
        <div class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">

            <button
                    class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                    type="button"
                    v-on:click="toggleCollapseShow('bg-white m-2 py-3 px-6')">
                <font-awesome-icon icon="bars" />
            </button>

            <a class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                    href="javascript:void(0)">
                Tv Shower
            </a>

            <ul class="md:hidden items-center flex flex-wrap list-none">
                <li class="inline-block relative">
                    {{user.username}}
                </li>
            </ul>

            <div class="mx-1 md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded"
                    v-bind:class="collapseShow">

                <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200">
                    <div class="flex flex-wrap">
                        <div class="w-6/12">
                            <a class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                                    href="javascript:void(0)">
                                Tv Shower
                            </a>
                        </div>
                        <div class="w-6/12 flex justify-end">
                            <button
                                    type="button"
                                    class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                                    v-on:click="toggleCollapseShow('hidden')">
                                <font-awesome-icon icon="times" />
                            </button>
                        </div>
                    </div>
                </div>

                <ul class="mt-10 md:mt-0 md:flex-col md:min-w-full flex flex-col list-none">
                    <li class="items-center">
                        <router-link :to="{name:'dashboard'}" class="px-2 text-blueGray-700 hover:text-purple-500 outline outline-offset-2 outline-blue-500 text-xs uppercase py-3 font-bold block">
                            <font-awesome-icon icon="tachometer-alt" class="opacity-75 mr-2 text-sm"/>
                            Dashboard
                        </router-link>
                    </li>
                    <li class="items-center">
                        <router-link :to="{name:'admin-movies'}" class="px-2 text-blueGray-700 hover:text-purple-500 text-xs uppercase py-3 font-bold block">
                            <font-awesome-icon icon="tv" class="opacity-75 mr-2 text-sm"/>
                            Movies
                        </router-link>
                    </li>
                    <li class="items-center">
                        <router-link :to="{name:'admin-genres'}" class="px-2 text-blueGray-700 hover:text-purple-500 text-xs uppercase py-3 font-bold block">
                            <font-awesome-icon icon="film" class="opacity-75 mr-2 text-sm"/>
                            Genres
                        </router-link>
                    </li>
                    <li class="items-center">
                        <router-link :to="{name:'admin-subscriptions'}" class="px-2 text-blueGray-700 hover:text-purple-500 text-xs uppercase py-3 font-bold block">
                            <font-awesome-icon icon="rocket" class="opacity-75 mr-2 text-sm"/>
                            Subscriptions
                        </router-link>
                    </li>
                </ul>

                <hr class="my-4 md:min-w-full" />

                <h6 class="ml-2 md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                    System
                </h6>

                <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                    <li class="items-center">
                        <router-link :to="{name:'admin-users'}" class="px-2 text-blueGray-700 hover:text-purple-500 outline outline-offset-2 outline-blue-500 text-xs uppercase py-3 font-bold block">
                            <font-awesome-icon icon="paint-brush" class="opacity-75 mr-2 text-sm"/>
                            Users
                        </router-link>
                    </li>
                </ul>
                <hr class="md:hidden my-4 md:min-w-full" />
                <ul class="md:hidden md:flex-col md:min-w-full flex flex-col list-none">
                    <li class="items-center">
                        <div class="cursor-pointer px-2 text-blueGray-700 hover:text-purple-500 outline outline-offset-2 outline-blue-500 text-xs uppercase py-3 font-bold block"
                             v-if="authState.loggedIn" @click="logOut">
                            <font-awesome-icon icon="sign-out-alt" class="opacity-75 mr-2 text-sm"/>
                            Logout
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "AdminSidebar",
        data() {
            return {
                collapseShow: "hidden"
            };
        },
        methods: {
            toggleCollapseShow: function(classes) {
                this.collapseShow = classes;
            },
            logOut(){
                // Vue.swal({
                //     text: "Are you sure you want to logout?",
                //     icon: 'warning',
                //     showCancelButton: true,
                //     confirmButtonColor: '#57d675',
                //     cancelButtonColor: '#d33',
                //     confirmButtonText: 'Yes'
                // }).then((result) => {
                //     if (result.isConfirmed) {
                //         this.$router.push('/');
                //         this.$store.dispatch('auth/logout');
                //
                //         Vue.swal({
                //             toast: true,
                //             position: 'top-end',
                //             showConfirmButton: false,
                //             timer: 3000,
                //             icon: 'success',
                //             title: 'Successfully logged out.'
                //         });
                //     }
                // });
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
