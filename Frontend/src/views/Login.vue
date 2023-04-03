<template>
    <div class="h-screen relative flex justify-center items-center">

    
        <div class="p-8 absolute w-5/6 bg-black/30 h-5/6 text-white rounded shadow-[0_0_20px_3px] shadow-black">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 place-items-center h-full ">
                <div class="h-full flex flex-col justify-around items-center sm:items-start p-4">
                    <div class="w-fit">
                        <router-link to="/"><img src="../assets/img/logo.png" alt="" class="w-20"></router-link>
                    </div>
                    <div class="mb-4">
                        <h1 class="text-6xl font-bold relative after:content-[''] after:absolute after:bg-white after:h-[1px] after:w-10 after:left-2 after:-bottom-8">Welcome!</h1>
                    </div>
                    <p class="text-gray-300 my-8">hello you need to login to access the barber if u dont have account ?</p>
                    <div class="w-full flex justify-center">
                        <router-link to="/Register"><button type="button" class="text-white bg-gradient-to-r from-red-800 via-yellow-600 to-yellow-500 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center">Register Now</button></router-link>
                    </div>
                </div>
                <div class="w-full mx-auto bg-white/20 p-4 sm:w-5/6 sm:h-5/6 grid items-center">
                    <h2 class="text-center font-bold text-4xl">Sign <span class="relative after:content-[''] after:absolute after:bg-white after:h-[2px] after:w-8 after:right-0 after:bottom-0">In</span></h2>
                    <form  @submit.prevent="login" class="flex flex-col items-center justify-around gap-10">
                        <div>
                            <label for="token" class="font-semibold block mb-2 text-sm">Token</label>
                            <input type="text" name="token" v-model="token" id="token" class="text-center bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-full block w-full p-2.5 outline-none" placeholder="------">
                        </div>
                        <div>
                            <button class="text-white bg-gradient-to-r from-red-800 via-yellow-600 to-yellow-500 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Login',
    data() {
        return {
            token : '',
            error : ''
        }
    },
    methods: {
        async login() {
            const response = await axios.post("/Users/login", {
                token_input : this.token
            })
            // console.log(response.data.message.token);
            // redirect
            if (response.data.message) {
                // redirect to home page
                localStorage.setItem("userToken", JSON.stringify(response.data.message));
                this.$router.push('/Home');
                this.$swal({
                    icon:'success',
                    title: `Welcome back ${response.data.message.first_name} ${response.data.message.last_name}`,
                })
            } else {
                this.$swal({
                    icon:'error',
                    title: 'User not found',
                    background:'',
                    footer: 'You dont have account ? <a href="/Register"><span class="text-blue-500">Register</span></a>',
                })
            }
        }
    }
}
</script>