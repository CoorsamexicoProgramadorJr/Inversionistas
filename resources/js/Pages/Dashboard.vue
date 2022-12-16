<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CategoriasVue from '@/Components/Categorias.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Docs from '@/Components/Docs.vue';
</script>

<template>
    <AppLayout title="Inicio">
        <template #header>
                <h1 class="text-xl font-bold">Documentos</h1>
        </template>
        <template #>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-2 md:px-4">
                    <div class="max-w-full bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 md:flex md:justify-between md:items-center">

                        <!-- Calendario -->
                        <div class="md:w-2/12 h-2/6 bg-gray-100 border-gray-100 max-w-7xl shadow-md">
                        </div>
                        <div class="md:w-10/12 h-4/6 flex flex-col justify-between items-center">
                            <div class="grid gap-2 w-full items-center">

                                <!-- Categorias -->
                                <div class="flex justify-between items-center">
                                    <h2 class="font-bold text-gray-600 uppercase text-sm text-center my-4">Categorias</h2>
                                    <PrimaryButton>
                                        Agregar Categoria
                                    </PrimaryButton>
                                </div>
                                <CategoriasVue />

                                <!-- Documentos -->
                                <h2 class="font-bold text-gray-600 uppercase text-sm text-center my-2">Documentos</h2>
                                <div class="grid md:grid-cols-4 grid-cols-2 w-full gap-2 items-center p-2">
                                    <Docs/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>
