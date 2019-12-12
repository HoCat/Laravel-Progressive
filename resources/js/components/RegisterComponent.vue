<template>
    <div class="bg-blue-100 h-screen w-full register-card">
        <div class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0">
            <div class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white sm:mx-0" style="height: 500px">
                <div class="hidden md:block md:w-1/2 rounded-l-lg register-card-bg"></div>
                <div class="flex flex-col w-full md:w-1/2 p-4">
                    <div class="flex flex-col flex-1 justify-center mb-8">
                        <h1 class="text-4xl text-center">Register</h1>
                        <div class="w-full mt-4">
                            <form class="form-horizontal mb-6 w-3/4 mx-auto" method="POST" action="/login">
                                <input type="hidden" name="_token" :value="csrf_token">

                                <div class="flex flex-col mt-4">
                                    <input type="text" class="flex-grow h-10 px-2 border-2 rounded border-grey-400" name="username"  required  placeholder="Username">
                                </div>
                                <div class="flex flex-col mt-4">
                                    <input id="email" type="email" class="flex-grow h-10 px-2 border-2 rounded border-grey-400" name="email"  required  placeholder="Email">
                                </div>
                                <div class="flex flex-col mt-6">
                                    <input id="password" type="password" class="flex-grow h-10 px-2 rounded border-2 border-grey-400" :value="password" name="password" required placeholder="Password">
                                </div>
                                <div class="flex flex-col mt-4">
                                    <input type="text" class="flex-grow h-10 px-2 border-2 rounded border-grey-400" name="username" @focus="checkPassword"  :value="confimPassword" required  placeholder="Confim Password">
                                    {{  }}
                                </div>
                                <div class="flex flex-col mt-8">
                                    <button type="submit" @click="login()" class="bg-indigo-800 hover:bg-indigo-700 text-white text-sm font-semibold focus:shadow-outline focus:outline-none py-3 px-10 rounded">
                                        Sign up
                                    </button>
                                </div>
                            </form>
                            <hr class="w-3/4 mx-auto border-t" />
                            <div class="text-center mt-2">
                                <a class="block mb-1 no-underline hover:text-indigo-900 text-indigo-300 text-xs" href="">
                                    Forgot Your Password?
                                </a>
                                <a class="no-underline hover:text-blue-900  text-blue-700 text-xs" href="">
                                    Or Create an Account?
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LoginDialogComponent",
        data () {
            return {
                csrf_token:  document.head.querySelector('meta[name="csrf-token"]').content,
                // todo
            }
        }
    }
</script>

<style scoped>
    .register-card h1 { font-family: "Helvetica Neue",Helvetica,Arial,serif; }
    .register-card-bg {
        background: url('http://have.top/storage/images/register_left.jpg');
        background-size: cover;
        background-position: center center;
    }
</style>
