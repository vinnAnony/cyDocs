<template>
    <div>
        <a class="text-blueGray-500 block cursor-pointer"
                v-on:click="toggleDropdown($event)"
                ref="btnDropdownRef">
            <div class="flex items-center">
                <span class="h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full">
                  <p class="w-full rounded-full align-middle border-none shadow-lg select-none">
                      {{user.name}} <font-awesome-icon icon="angle-down" />
                  </p>
                </span>
            </div>
        </a>
        <div ref="popoverDropdownRef"
                class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1 min-width-12"
                v-bind:class="{
                hidden: !dropdownPopoverShow,
                block: dropdownPopoverShow}">
            <a v-if="authState.loggedIn" @click="logOut"
               class="cursor-pointer hover:bg-indigo-100 text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
                Logout
            </a>
<!--            <div class="h-0 my-2 border border-solid border-blueGray-100" />-->
        </div>
    </div>
</template>

<script>
    import { createPopper } from "@popperjs/core";
    import {mapGetters} from "vuex";
    import {cyDocsAlert} from "../../utils/alert";
    export default {
        name: "UserDropdown",
        data(){
            return{
                dropdownPopoverShow: false
            }
        },
        methods: {
            toggleDropdown: function(event) {
                event.preventDefault();
                if (this.dropdownPopoverShow) {
                    this.dropdownPopoverShow = false;
                } else {
                    this.dropdownPopoverShow = true;
                    createPopper(this.$refs.btnDropdownRef, this.$refs.popoverDropdownRef, {
                        placement: "bottom-end"
                    });
                }
            },
            logOut(){
                Vue.swal({
                    text: "Are you sure you want to logout?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#57d675',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$store.dispatch('auth/logout');
                        this.$router.push({ name: 'welcome' });

                        cyDocsAlert('success','Successfully logged out.');
                    }
                });
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
