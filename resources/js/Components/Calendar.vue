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
    <Datepicker
        class="cal"
        v-model="month"
        :year-range="[2020, new Date().getFullYear() + 2]"
        locale="es-MX"
        month-picker
        select-text="Selecionar"
        cancel-text="Cancelar"
        teleport-center
        mode-height="200"
    />

    <div>{{ month }}</div>
</template>
