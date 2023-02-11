<template>
    <div class="flex items-center justify-evenly mx-auto w-4/6 bg-white/50 rounded-xl">
        <Calendar />
        <Time />
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
            
        }
    }
</script>