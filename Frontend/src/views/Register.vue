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
                        <router-link to="/"><button type="button" class="text-white bg-gradient-to-r from-red-800 via-yellow-600 to-yellow-500 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sign in</button></router-link>
                    </div>
                </div>
                <div class="w-full mx-auto bg-white/20 p-4 sm:w-5/6 sm:h-5/6 grid items-center">
                    <h2 class="text-center font-bold text-4xl">Sign <span class="relative after:content-[''] after:absolute after:bg-white after:h-[2px] after:w-8 after:right-0 after:bottom-0">In</span></h2>
                    <form @submit.prevent="handleSubmit" class="flex flex-col items-center gap-4">
                        <div> 
                            <label for="fname" class="font-semibold block mb-2 text-sm">First Name</label>
                            <input type="text" name="first_name" v-model="fname" class="text-center bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-full block w-full p-2.5 outline-none" placeholder="First Name">
                        </div>
                        <div>
                            <label for="lname" class="font-semibold block mb-2 text-sm">Last Name</label>
                            <input type="text" name="last_name" v-model="lname" class="text-center bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-full block w-full p-2.5 outline-none" placeholder="Last Name">
                        </div>
                        <div>
                            <label for="tel" class="font-semibold block mb-2 text-sm">Phone Number</label>
                            <input type="tel" name="phone" v-model="phone" class="text-center bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-full block w-full p-2.5 outline-none" placeholder="Phone number">
                            <span class="text-red-500 bg-red-200">{{ error }}</span>
                        </div>
                        <div>
                            <button class="text-white bg-gradient-to-r from-red-800 via-yellow-600 to-yellow-500 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // import axios from node model
    import axios from 'axios';
    export default {
        name: 'Register',
        data() {
            return {
                fname : '',
                lname : '',
                phone : '',
                token : '',
                error : ''
            }
        },
        methods:{
            async handleSubmit(){
                const response = await axios.post("/Users/registre", {
                    first_name : this.fname,
                    last_name : this.lname,
                    phone : this.phone
                });
                console.log(response);
                if (response.data.message === false) {
                    this.error = 'this number already exist';
                } else {
                    // redirect to login page
                    this.$router.push('/');
                    this.token = response.data.message;
                    this.$swal(`Register Done this is your Token : ${this.token}`);
                }
            },
        }
    }
</script>