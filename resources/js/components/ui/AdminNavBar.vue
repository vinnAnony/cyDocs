<template>
    <nav class="absolute top-0 left-0 w-full z-10 bg-indigo-500 md:flex-row md:flex-nowrap md:justify-start flex items-center p-2">
        <div class="w-full mx-auto items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
            <p class="font-semibold text-white">Dashboard</p>
            <ul class="float-right flex-col md:flex-row list-none items-center hidden md:flex">
                <admin-user-dropdown/>
            </ul>
        </div>
    </nav>
</template>

<script>
    import AdminUserDropdown from "./AdminUserDropdown";
    export default {
        name: "AdminNavBar",
        components: {AdminUserDropdown}
    }
</script>

<style scoped>

</style>