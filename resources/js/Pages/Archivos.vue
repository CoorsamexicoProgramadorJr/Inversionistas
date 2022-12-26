<script setup>
import { ref } from 'vue';
import { useForm, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Create from './Docs/Create.vue';
import DangerButton from '../Components/DangerButton.vue';
import DialogModal from '../Components/DialogModal.vue';
import ThirdButton from './../Components/ThirdButton.vue';
import InputLabel from '../Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps(['categories', 'documents','datos']);
const modal = ref(false);
const del = ref(false);

const dform = useForm({
    id:'',
});
const elimianr = () => {
    dform.transform(data => ({
        ...data,
    })).post(route('archivos.delete'));
};
</script>
<template>
    <AppLayout title="Archivos">
        <template #header>
            <h1 class="text-xl font-bold">Archivos</h1>
        </template>
        <template #>
            <Create :modal="modal"/>
            <div class="max-w-7xl mx-auto sm:px-2 md:px-4">
                <div class="max-w-full bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 md:grid md:justify-center md:items-center">
                    <div class="flex flex-col w-full gap-2 justify-end mb-2">
                        <div class="flex justify-end">
                            <ThirdButton class="max-w-fit" @click="modal = true">Agregar Archivo</ThirdButton>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Show</span>
                            <form>
                                <label class="mr-2" for="search">Busqueda</label>
                                <input type="text" id="search" class="max-h-min text-xs">
                            </form>
                        </div>
                    </div>
                    <div>
                        <table>
                            <thead
                                class="grid text-sm text-center justify-center shadow-md border-b-2 border-gray-400 grid-cols-5 px-3 py-1 gap-2 items-center">
                                <th>ID</th>
                                <th>Nombre de Archivo</th>
                                <th>Categoria</th>
                                <th>Autor</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody class="grid grid-cols-5 w-full justify-center text-center mx-2 py-1 gap-2 items-center">
                                <template v-for="doc in documents">
                                    <td class="px-1">{{doc.id}}</td>
                                    <td class="px-1">{{doc.nombre}}</td>
                                    <td class="px-1">{{doc.category_id}}</td>
                                    <td class="px-1">{{ doc.user_id }}</td>
                                    <td class="px-1 grid w-full gap-2">
                                        <Link :href="route('archivos.download', doc.id)">
                                            <ThirdButton :type="'submit'">Descargar Archivo</ThirdButton>
                                        </Link>
                                        <Link class="grid" :href="route('archivos.find', doc.id)">
                                            <ThirdButton @click="modal = !modal">Editar</ThirdButton>
                                        </Link>
                                        <div class="grid">
                                            <DialogModal :show="del">
                                                <template #title>
                                                    <div class="flex justify-end w-full pt-2 pr-2">
                                                        <button
                                                            class="inline-flex items-center justify-center rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                                                            @click="del = !del">
                                                            <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                <h1 class="font-semibold text-2xl text-gray-600 text-center">Eliminar archivo</h1>
                                                </template>
                                                <template #content>
                                                    <p class="text-center font-semibold text-lg text-gray-500">Estas seguro que deseas eliminar el archivo <span class="font-bold">{{ doc.nombre }}</span> despues de esto no podras recuperarlo</p>
                                                </template>
                                                <template #footer>
                                                    <form @submit.prevent="elimianr">
                                                        <TextInput :value="doc.id" type="hidden" v-model="dform.id" />
                                                        <DangerButton class="col-start-2" :type="'submit'" :class="{ 'opacity-25': dform.processing }" :disabled="dform.processing">Eliminar archivo</DangerButton>
                                                    </form>
                                                </template>
                                            </DialogModal>
                                            <ThirdButton :type="'buton'" @click="del = !del">Delete</ThirdButton>
                                        </div>
                                    </td>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>