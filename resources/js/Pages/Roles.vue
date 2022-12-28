<script setup>
import AppLayout from "../Layouts/AppLayout.vue";
//Propiedades
defineProps(["permisos", "roles"]);
</script>

<template>
    <AppLayout title="Roles">
        <template #header>
            <h1 class="text-xl font-bold">Roles</h1>
        </template>

        <template #>
            <div></div>
        </template>
    </AppLayout>
</template>
