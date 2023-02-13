<template>
    <div class="sm:flex sm:items-start sm:justify-center sm:gap-16 max-sm:mx-auto ">

        <div class="w-fit">
            <!-- header of calendar -->
            <h1 class=" font-bold text-center my-4">Select a Date & Time</h1>
            <div class="bg-white w-fit flex flex-col items-center  rounded-lg shadow-[0_0_4px_black]">
                <div class="flex justify-between w-full p-2">
                    <button @click="previousMonth">
                        <svg aria-hidden="true" class="rotate-[180deg] w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <p>{{ currentMonthName }} {{ currentYear }}</p>
                    <button @click="nextMonth">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                
                <div class="grid grid-cols-7 text-center p-2 gap-4 border-t border-t-gray-400 ">
                    <p v-for="dayName in days" class="font-semibold text-red-500">{{ dayName }}</p>
                    <p v-for="day in firstDay" class="bg-gray-200"></p>
                    <p @click="selectedDay(date), visible(), pickedDay(date)" v-for="date in lastDateOfMonth" :class="toDay(date), hidePassedDay(date), pickedDay(date)" class="border rounded-xl cursor-pointer">{{ date }}</p>
                </div>
            </div>
        </div>
        <div :class="hidden">
            <h2 class="text-center my-4 font-semibold">{{ chose }} {{ currentMonthName }}</h2>
            <ul class="grid gap-4 grid-cols-2">
                <li v-for="n of times" :id="n" class="li" @click="handleClickTime(n), selectedTime(n)">{{ 10+n-1 + ':00' }} - {{ 10+n + ':00'}}</li>
            </ul>
        </div>
    </div>
    <div class="w-full flex justify-center my-4">
        <button @click="confirmeApp()" class="text-white bg-gradient-to-r from-red-800 via-yellow-600 to-yellow-500 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center">Confirme Appointement</button>
    </div>
</template>



<!-- toDateString => give you name of day to disable it on calendar -->



<script>
export default {
    name : 'Calendar',
    data() {
        return {
            days : ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            times: 8,
            currentMonthNumber : new Date().getMonth(),
            currentYear : new Date().getFullYear(),
            currentDay : new Date().getDate(),
            chose : new Date().getDate(),
            hidden : 'hidden',
            appointementDate : '',
            appointementTime : '',
        }
    },
    methods: {
        handleClickTime(id){
            const tmp = document.getElementById(id);
            const old = document.querySelector(".clicked_li");
            this.activeTime = id;
            if(old){
                old.classList.remove(...["clicked_li","bg-blue-500", "text-white"]);
            }
            tmp.classList.add(...["clicked_li","bg-blue-500", "text-white"]);
            if (this.activeTime === id && old) {
                old.classList.remove(...["clicked_li","bg-blue-500", "text-white"]);
            }
        },
        visible() {
            this.hidden = 'block'
        },
        nextMonth() {
            if (this.currentMonthNumber === 11) {
                this.currentYear++;
                this.currentMonthNumber = 0;
            } else {
                this.currentMonthNumber++;
            }
        },
        previousMonth() {
            if (this.currentMonthNumber === 0) {
                this.currentYear--;
                this.currentMonthNumber = 11;
            } else {
                this.currentMonthNumber--;
            }
        },
        toDay(date) {
            let calender = new Date(this.currentYear, this.currentMonthNumber, date).toDateString();
            let today = new Date().toDateString();
            return calender === today ? 'bg-blue-500 text-white font-semibold' : '';
        },
        hidePassedDay(date) {
            let toDay = new Date().getDate();
            let staticMonth = new Date(this.currentYear, new Date().getMonth()).toLocaleString("default", {month:"long"});
            return date < toDay && this.currentMonthName === staticMonth ? "bg-gray-100 text-gray-400 cursor-not-allowed" : "";
        },
        selectedDay(date) {
            this.chose = date >= this.currentDay ? date : this.chose;
            this.appointementDate = new Date(this.chose, this.currentMonthNumber, date).toLocaleDateString();
        },
        selectedTime(time) {
            let tmp = document.getElementById(time);
            this.appointementTime = tmp.textContent;
        },
        pickedDay(date) {
            return date === this.chose ? "bg-red-500 text-white" : "";
        },
        confirmeApp() {
            let app = {
                "date" : this.appointementDate,
                "time" : this.appointementTime
            };
            this.$emit('onChange', app);
        }
    },
    computed: {
        currentMonthName() {
            return new Date(this.currentYear, this.currentMonthNumber).toLocaleString("default", {month:"long"});
        },
        lastDateOfMonth() {
            return new Date(this.currentYear, this.currentMonthNumber + 1, 0).getDate();
        },
        firstDay() {
            return new Date(this.currentYear, this.currentMonthNumber, 1).getDay(); 
        },
    },
    
}
</script>

<style>
    .li {
        @apply text-blue-500 font-semibold border-2 border-blue-500 text-center px-4 py-2 cursor-pointer rounded-lg hover:bg-blue-500 hover:text-white
    }
</style>