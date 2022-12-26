<script setup>
import { ref } from 'vue';
import { useForm, Link } from '@inertiajs/inertia-vue3';
import DialogModal from '../../Components/DialogModal.vue';
import ThirdButton from '../../Components/ThirdButton.vue';
import InputLabel from '../../Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps(['modal']);
const modal = modal;
const form = useForm({
    nombre: '',
    path: '',
    category: '',
});
const submit = () => {
    form.transform(data => ({
        ...data,
    })).post(route('archivos.index'), {
        onSuccess: () => form.reset(),
        onCancel: () => form.reset(),
    });
};
</script>

<template>
    <DialogModal :show="modal" :max-width="lg">
        <template #title>
            <div class="flex justify-end w-full pt-2 pr-2">
                <button
                    class="inline-flex items-center justify-center rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                    @click="modal = false, form.reset()">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <h1 class="font-semibold text-center">Subir un nuevo Archivo</h1>
        </template>
        <template #content>
            <div>
                <form class="p-2 grid grid-cols-2 gap-2" @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Nombre del Documento" class=" text-md font-semibold" />
                        <TextInput id="name" type="text" class="mt-1 block w-full" required autofocus
                            v-model="form.nombre" />
                    </div>
                    <div>
                        <InputLabel for="categoria" value="Seleccione una categoria" class=" text-md font-semibold" />
                        <select id="categoria"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mt-1 block"
                            required v-model="form.category">
                            <option value="" disabled selected>Selecione</option>
                            <template v-for="cats in categories">
                                <option :value="cats.id">{{ cats.nombre }}</option>
                            </template>
                        </select>
                    </div>
                    <div class=" col-span-2">
                        <InputLabel for="arch" value="Seleccione una archivo" class=" text-md font-semibold" />
                        <TextInput id="name" type="file" class="mt-1 block w-full" required
                            @input="form.path = $event.target.files[0]" />
                    </div>
                    <ThirdButton class="col-start-2" :type="'submit'" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">Subir Documento</ThirdButton>
                </form>
            </div>
        </template>
    </DialogModal>
</template>