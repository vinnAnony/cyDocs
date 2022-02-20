<template>
    <div class="flex flex-col">
        <div class="justify-center items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
            <router-link :to="{name:'departments'}"
                         class="w-full min-w-200  flex bg-indigo-600 hover:bg-indigo-500 focus:ring-4 focus:ring-indigo-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <div class="text-center">
                    <div class="mb-2 text-md">Departments</div>
                </div>
            </router-link>
            <router-link :to="{name:'categories'}"
                         class="w-full min-w-200  flex bg-indigo-600 hover:bg-indigo-500 focus:ring-4 focus:ring-indigo-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <div class="text-center">
                    <div class="mb-2 text-md">Categories</div>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Configuration"
    }
</script>

<style scoped>

</style>
