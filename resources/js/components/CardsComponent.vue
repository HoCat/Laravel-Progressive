<template>
    <div class="md:flex rounded-lg p-6">
        <div class="shadow-lg leading-normal self-end bg-gray-900 w-1/4  rounded-lg ml-20 relative">
            <div class="md:flex rounded-lg p-6 shadow-md" style="color: #fff">
                <img src="../../img/default_head.png" alt="" class="h-24 w-24  border-2 block mr-8 mt-2 rounded-full">
                <div class="text-center md:text-left">
                    <h2 style="font-size: 1.6rem" class="text-lg">{{ user.username }}</h2>
                    <div class="text-green-300">{{ user.signature }}</div>
                    <div class="text-gray-400">{{ user.email }}</div>
                    <div class="text-gray-400">{{ user.phone }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['usermodel'],
        data() {
            return {
                user: this.usermodel
            }
        },
        methods: {
        },
        sockets: {
            message(data) {
                console.log(data);
            },
        }
    }
</script>



<style >

</style>
