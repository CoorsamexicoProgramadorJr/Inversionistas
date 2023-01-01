<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CategoriasVue from "@/Components/Categorias.vue";
import Docs from "@/Components/Docs.vue";
import Calendar from "@/Components/Calendar.vue";

defineProps(["categories", "documents"]);
</script>

<template>
    <AppLayout title="Inicio">
        <template #header>
            <h1 class="text-xl font-bold">Documentos</h1>
        </template>
        <template #>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-2 md:px-4">
                    <div
                        class="max-w-full bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 md:flex md:justify-between md:items-center"
                    >
                        <div class="flex flex-col justify-between items-center">
                            <div class="grid gap-2 w-full items-center">
                                <div class="flex justify-center text-gray-500">
                                    <Calendar />
                                </div>
                                <!-- Categorias -->
                                <h2
                                    class="font-bold text-gray-600 uppercase text-sm text-center my-4"
                                >
                                    Categorias
                                </h2>
                                <CategoriasVue :categories="categories" />

                                <!-- Documentos -->
                                <h2
                                    class="font-bold text-gray-600 uppercase text-sm text-center my-2"
                                >
                                    Documentos
                                </h2>
                                <div
                                    class="grid md:grid-cols-4 lg:grid-cols-6 grid-cols-2 w-full gap-2 items-center p-2"
                                >
                                    <Docs :documents="documents" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>
