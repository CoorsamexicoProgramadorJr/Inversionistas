<script setup>
import { ref } from "vue";
import { useForm, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import DangerButton from "../Components/DangerButton.vue";
import DialogModal from "../Components/DialogModal.vue";
import ThirdButton from "./../Components/ThirdButton.vue";
import InputLabel from "../Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps(["categories", "documents", "datos", "usuario"]);
const modal = ref(false);
const del = ref(false);
const datos = Object;

//Formularios
const form = useForm({
    nombre: "",
    path: "",
    category: "",
});
const dform = useForm({
    id: "",
});

//Envio de la informacion pertinente
const submit = () => {
    form.transform((data) => ({
        ...data,
    })).post(route("archivos.index"), {
        onSuccess: () => closeModal(),
        onCancel: () => form.reset(),
    });
};

//Cierra el modal
const closeModal = () => {
    modal.value = false;
    del.value = false;
    form.reset();
};
</script>
<template>
    <AppLayout title="Archivos">
        <template #header>
            <h1 class="text-xl font-bold">Archivos</h1>
        </template>
        <template #>
            <!-- Modal de subida de documentos -->
            <DialogModal :show="modal" :max-width="lg" @close="closeModal">
                <template #title>
                    <div class="flex justify-end w-full pt-2 pr-2">
                        <button
                            class="inline-flex items-center justify-center rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                            @click="closeModal()"
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
                    <h1 class="font-semibold text-center">
                        Subir un nuevo Archivo
                    </h1>
                </template>
                <template #content>
                    <div>
                        <form
                            class="p-2 grid grid-cols-2 gap-2"
                            @submit.prevent="submit"
                        >
                            <div>
                                <InputLabel
                                    for="name"
                                    value="Nombre del Documento"
                                    class="text-md font-semibold"
                                />
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    v-model="form.nombre"
                                />
                            </div>
                            <div>
                                <InputLabel
                                    for="categoria"
                                    value="Seleccione una categoria"
                                    class="text-md font-semibold"
                                />
                                <select
                                    id="categoria"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mt-1 block"
                                    required
                                    v-model="form.category"
                                >
                                    <option value="" disabled selected>
                                        Selecione
                                    </option>
                                    <template v-for="cats in categories">
                                        <option :value="cats.id">
                                            {{ cats.nombre }}
                                        </option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-span-2">
                                <InputLabel
                                    for="arch"
                                    value="Seleccione una archivo"
                                    class="text-md font-semibold"
                                />
                                <TextInput
                                    id="arch"
                                    type="file"
                                    class="mt-1 block w-full"
                                    required
                                    @input="form.path = $event.target.files[0]"
                                />
                            </div>
                            <ThirdButton
                                class="col-start-2"
                                :type="'submit'"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Subir Documento
                            </ThirdButton>
                        </form>
                    </div>
                </template>
            </DialogModal>
            <div class="max-w-7xl mx-auto sm:px-2 md:px-4">
                <div
                    class="max-w-full bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 md:grid md:justify-center md:items-center"
                >
                    <div class="flex flex-col w-full gap-2 justify-end mb-2">
                        <div class="flex justify-end">
                            <ThirdButton
                                class="max-w-fit"
                                @click="modal = true"
                            >
                                Agregar Archivo
                            </ThirdButton>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Show</span>
                            <form>
                                <label class="mr-2" for="search"
                                    >Busqueda</label
                                >
                                <input
                                    type="text"
                                    id="search"
                                    class="max-h-min text-xs"
                                />
                            </form>
                        </div>
                    </div>
                    <div>
                        <table>
                            <thead
                                class="grid text-sm text-center justify-center shadow-md border-b-2 border-gray-400 grid-cols-5 px-3 py-1 gap-2 items-center"
                            >
                                <th>ID</th>
                                <th>Nombre de Archivo</th>
                                <th>Categoria</th>
                                <th>Autor</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody
                                class="grid grid-cols-5 w-full justify-center text-center mx-2 py-1 gap-2 items-center"
                            >
                                <template v-for="doc in documents">
                                    <td class="px-1">{{ doc.id }}</td>
                                    <td class="px-1">{{ doc.nombre }}</td>
                                    <template v-for="cats in categories">
                                        <td
                                            v-if="cats.id === doc.category_id"
                                            class="px-1"
                                        >
                                            {{ cats.nombre }}
                                        </td>
                                    </template>
                                    <template v-for="user in usuario">
                                        <td
                                            v-if="user.id === doc.user_id"
                                            class="px-1"
                                        >
                                            {{ user.name }}
                                        </td>
                                    </template>
                                    <td class="px-1 grid w-full gap-2">
                                        <Link
                                            :href="route('archivos.download')"
                                            method="Post"
                                            :data="{ path: doc.path }"
                                        >
                                            <ThirdButton :type="'submit'"
                                                >Descargar Archivo</ThirdButton
                                            >
                                        </Link>
                                        <ThirdButton
                                            :type="'button'"
                                            @click="
                                                modal = !modal;
                                                datos = doc;
                                            "
                                        >
                                            Editar
                                        </ThirdButton>
                                        <div class="grid">
                                            <DialogModal
                                                :show="del"
                                                @close="closeModal()"
                                            >
                                                <template #title>
                                                    <div
                                                        class="flex justify-end w-full pt-2 pr-2"
                                                    >
                                                        <button
                                                            class="inline-flex items-center justify-center rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                                                            @click="
                                                                closeModal()
                                                            "
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
                                                    <h1
                                                        class="font-semibold text-2xl text-gray-600 text-center"
                                                    >
                                                        Eliminar archivo
                                                    </h1>
                                                </template>
                                                <template #content>
                                                    <p
                                                        class="text-center font-semibold text-lg text-gray-500"
                                                    >
                                                        Estas seguro que deseas
                                                        eliminar el archivo
                                                        <span
                                                            class="font-bold"
                                                            >{{
                                                                datos.nombre
                                                            }}</span
                                                        >
                                                        despues de esto no
                                                        podras recuperarlo
                                                    </p>
                                                </template>
                                                <template #footer>
                                                    <Link
                                                        href="/arch/delete"
                                                        method="POST"
                                                        :data="{ id: datos.id }"
                                                    >
                                                        <DangerButton
                                                            class="col-start-2"
                                                            :type="'submit'"
                                                            @click="
                                                                closeModal()
                                                            "
                                                        >
                                                            Eliminar archivo
                                                        </DangerButton>
                                                    </Link>
                                                </template>
                                            </DialogModal>
                                            <ThirdButton
                                                class="w-full"
                                                :type="'buton'"
                                                @click="
                                                    del = !del;
                                                    datos = doc;
                                                "
                                            >
                                                Delete
                                            </ThirdButton>
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
