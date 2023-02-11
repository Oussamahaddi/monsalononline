<template>
    <div class="w-fit">
        <!-- header of calendar -->
        <h1 class=" font-bold text-center my-4">Select a Date & Time</h1>
        <div class="bg-white w-fit flex flex-col items-center  rounded-lg shadow-[0_0_4px_black]">
            <div class="flex justify-around w-full py-2">
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
                <p v-for="date in lastDateOfMonth" :class="toDay(date), hide(date)" class="border rounded-xl cursor-pointer">{{ date }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name : 'Calendar',
    data() {
        return {
            days : ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            currentMonthNumber : new Date().getMonth(),
            currentYear : new Date().getFullYear(),
        }
    },
    methods: {
        nextMonth() {
            if (this.currentMonthNumber === 12) {
                this.currentYear++;
                this.currentMonthNumber = 0;
            } else {
                this.currentMonthNumber++;
            }
            console.log(this.currentMonthNumber);
        },
        previousMonth() {
            if (this.currentMonthNumber === 0) {
                this.currentYear--;
                this.currentMonthNumber = 11;
            } else {
                this.currentMonthNumber--;
            }
            console.log(this.currentMonthNumber);
        },
        toDay(date) {
            let calender = new Date(this.currentYear, this.currentMonthNumber, date).toDateString();
            let today = new Date().toDateString();
            return calender === today ? 'bg-blue-500 text-white font-semibold' : '';
        },
        hide(date) {
            let toDay = new Date().getDate();
            return date < toDay ? "bg-gray-100 text-gray-400 cursor-not-allowed" : "";
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

    }
}
</script>