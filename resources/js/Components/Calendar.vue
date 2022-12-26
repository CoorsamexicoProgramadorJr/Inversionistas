<script setup>
import { ref } from "vue";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

const month = ref({
    month: new Date().getMonth(),
    year: new Date().getFullYear(),
});
</script>

<template>
    <Datepicker v-model="month" month-picker />
</template>
