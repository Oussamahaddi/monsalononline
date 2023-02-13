<template>
    <div class="mx-auto bg-white h-screen grid items-center">
        <Calendar @onChange="setDate($event)" />
    </div>
</template>

<script>
    import axios from 'axios';
    import Calendar from '../components/Calendar.vue'
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
                    time : param.time
                });
                this.$swal({
                    icon: "success",
                    title : `Appoinetement reserved at ${this.appDate} ${this.appTime}`
                });
                this.$router.push('/Home');
                console.log(this.appDate, this.appTime);
            }
        },
    }
</script>