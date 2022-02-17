<template>

</template>

<script>
    import url from "../../utils/http";

    export default {
        name: "MyDocuments",
        data(){
            return{
                myDocuments:[],
                myDocument:{}
            }
        },
        beforeMount(){
            url.get("user-documents/",)
                .then((response)=>
                {
                    this.users = response.data;
                })
        },
    }
</script>

<style scoped>

</style>
