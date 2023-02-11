<template>
    <div>
        <h2 class="text-center my-4">current date in calender</h2>
        <ul class="grid gap-4 grid-cols-2">
            <li class="li">10:00 - 11:00</li>
            <li class="li">11:00 - 12:00</li>
            <li class="li">12:00 - 13:00</li>
            <li class="li">13:00 - 14:00</li>
            <li class="li">14:00 - 15:00</li>
            <li class="li">15:00 - 16:00</li>
            <li class="li">16:00 - 17:00</li>
            <li class="li">18:00 - 18:00</li>
        </ul>
    </div>
</template>

<script>
export default {
    name : 'Time',
    data() {
        return {
            
        }
    },
}
</script>

<style>
    .li {
        @apply text-white font-semibold border border-black text-center px-4 py-2 cursor-pointer bg-gradient-to-r from-red-800 via-yellow-600 to-yellow-500 hover:bg-gradient-to-br rounded-lg
    }
</style>