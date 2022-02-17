<template>
<div>
    <div class="bg-gray-100"  v-if="authState.loggedIn">
        <sidebar-component/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <navbar-component class="sticky"/>
            <div class="relative  md:pt-10 pb-10 pt-12">
                <div class="px-1 md:px-10 mx-auto w-full">
                    <div>
                        <router-view>

                        </router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-100"  v-else>
        <default-navbar/>
        <router-view>

        </router-view>
    </div>
</div>
</template>

<script>
    import {mapGetters} from "vuex";
    import DefaultNavbar from "./ui/DefaultNavbar";

    export default {
        name: "App",
        components: {DefaultNavbar,},
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
