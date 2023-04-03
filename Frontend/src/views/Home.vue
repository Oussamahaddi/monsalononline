<template>
    <div class="mx-auto h-screen grid items-center">
        <img src="../assets/img/background.jpg" alt="" class="absolute w-full h-full -z-10">
        <div class="flex justify-between items-center px-2 w-5/6 mx-auto">
            <img src="../assets/img/logo.png" alt="" class="w-24">
            <div>
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class=" rounded-full" type="button"><img src="../assets/img/avatar.jpg" alt="" class="w-10 border-[3px] border-orange-500 rounded-full"></button>
                <!-- Dropdown menu -->
                <div  id="dropdown" class="z-10 hidden relative bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdownDefaultButton">
                        <li class="p-2 cursor-pointer hover:bg-gray-300">
                            My Appointement
                        </li>
                        <li @click="getDate" class="p-2 cursor-pointer hover:bg-gray-300">
                            Logout
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <Calendar @onChange="setDate($event)" />
    </div>
</template>

<script>
    import axios from 'axios';
    import Calendar from '../components/Calendar.vue';
    export default {
        name : 'Home',
        data() {
            return {
                appDate : '',
                appTime : ''
            }
        },
        components: {
            Calendar,
        },
        methods: {
            async setDate(param) {
                this.appDate = param.date;
                this.appTime = param.time;
                let response = await axios.post('http://localhost/monsalonline/Appoinements/addApp', {
                    date : param.date,
                    time : param.time,
                    id_client : JSON.parse(localStorage.getItem('userToken')).id,
                });
                this.$swal({
                    icon: "success",
                    title : `Appoinetement reserved at ${this.appDate} ${this.appTime}`
                });
                if (response.data.seted) {
                    this.$router.push('/Home');
                }
            },
        },
    }
</script>