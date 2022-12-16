<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-4xl uppercase font-black">Coorsa Mexico</h1>
            <h1 class="text-2xl font-bold">Inversionistas</h1>
        </div>
    </header>
    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10"></h2>
        <slot name="contenido"/>
    </main>
    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        Coorsa Mexico - Todos los derechos Reservados
    </footer>
</template>
