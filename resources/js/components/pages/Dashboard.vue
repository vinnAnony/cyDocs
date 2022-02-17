<template>
    <div>
        <div class="justify-center items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
            <router-link :to="{name:'my-documents'}"
                         class="w-full min-w-200  flex bg-indigo-600 hover:bg-indigo-500 focus:ring-4 focus:ring-indigo-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <div class="text-center">
                    <div class="mb-2 text-md">My Documents</div>
                    <div class="-mt-1 font-sans text-sm font-semibold">5</div>
                </div>
            </router-link>
            <router-link :to="{name:'file-requests'}"
                         class="w-full min-w-200  flex bg-indigo-600 hover:bg-indigo-500 focus:ring-4 focus:ring-indigo-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <div class="text-center">
                    <div class="mb-2 text-md">File Requests</div>
                    <div class="-mt-1 font-sans text-sm font-semibold">4</div>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dashboard"
    }
</script>

<style scoped>

</style>
