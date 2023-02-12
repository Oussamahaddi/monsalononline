<template>
    <div class="mx-auto bg-white h-screen grid items-center">
        <Calendar @selectedDay="test" />
        <div class="w-full flex justify-center my-4">
            <button @click="" class="text-white bg-gradient-to-r from-red-800 via-yellow-600 to-yellow-500 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center">Confirme Appointement</button>
        </div>
    </div>
</template>

<script>
    import Calendar from '../components/Calendar.vue'
    import Time from '../components/Time.vue'
    export default {
        name : 'Home',
        data() {
            return {

            }
        },
        components: {
            Calendar,
            Time,
        },
        methods: {
            test(date) {
                console.log(date);
            }
        },
    }
</script>