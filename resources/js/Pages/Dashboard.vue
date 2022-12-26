<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import CategoriasVue from "@/Components/Categorias.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ThirdButton from "../Components/ThirdButton.vue";
import Docs from "@/Components/Docs.vue";
import Calendar from "@/Components/Calendar.vue";
import Modal from "../Components/Modal.vue";
import InputLabel from "../Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps(["categories", "documents"]);

const modal = ref(false);
const form = useForm({
    category: "",
});
const submit = () => {
    form.transform((data) => ({
        ...data,
    })).post(route("dashboard"), {
        onSuccess: () => [
            form.reset("category"),
            closeModal(),
        ]
    });
};
const closeModal = () => {
    modal.value = false;

    form.reset();
};
</script>

<template>
    <AppLayout title="Inicio">
        <template #header>
            <h1 class="text-xl font-bold">Documentos</h1>
        </template>
        <template #>
            <div class="grid w-full h-full justify-center items-center">
                <Modal :show="modal" :max-width="'sm'" @close="closeModal">
                    <div class="flex justify-end w-full pt-2 pr-2">
                        <button
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                            @click="(modal = false), form.reset()"
                        >
                            <svg
                                class="h-5 w-5"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                    <form class="p-2 grid gap-2" @submit.prevent="submit">
                        <InputLabel
                            for="categoria"
                            value="Nueva Categoria"
                            class="text-md font-semibold"
                        />
                        <TextInput
                            id="categoria"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            v-model="form.category"
                        />
                        <ThirdButton
                            :type="'submit'"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            >Agregar Categoria</ThirdButton
                        >
                    </form>
                </Modal>
            </div>
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
                                <div class="flex justify-between items-center">
                                    <h2
                                        class="font-bold text-gray-600 uppercase text-sm text-center my-4"
                                    >
                                        Categorias
                                    </h2>
                                    <PrimaryButton @click="modal = true">
                                        Agregar Categoria
                                    </PrimaryButton>
                                </div>
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
