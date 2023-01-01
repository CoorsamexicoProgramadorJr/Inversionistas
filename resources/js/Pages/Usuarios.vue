<script setup>
//App layout
import AppLayout from "../Layouts/AppLayout.vue";
import { ref } from "vue";
import { useForm, Link } from "@inertiajs/inertia-vue3";
import DangerButton from "../Components/DangerButton.vue";
import DialogModal from "../Components/DialogModal.vue";
import ThirdButton from "./../Components/ThirdButton.vue";
import InputLabel from "../Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Tabla from "../Components/Table.vue";
import Thead from "../Components/Thead.vue";
import Tbody from "../Components/Tbody.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "../Components/InputError.vue";

defineProps(["usuarios", "rols"]);
const datos = Object;
const modal = ref(false);
const del = ref(false);

const closeModal = () => {
    modal.value = false;
    del.value = false;
    form.reset();
};

const form = useForm({
    name: "",
    email: "",
    rol: "",
    password: "",
});
const dform = useForm({
    id: "",
});

//Envio de la informacion pertinente
const submit = () => {
    form.transform((data) => ({
        ...data,
    })).post(route("usuarios.create"), {
        onSuccess: () => closeModal(),
        onCancel: () => form.reset(),
    });
};
</script>

<template>
    <AppLayout title="Usuarios">
        <template #header>
            <h1 class="text-xl font-bold">Usuarios</h1>
        </template>

        <template #>
            <div class="max-w-7xl mx-auto sm:px-2 md:px-4">
                <div
                    class="max-w-full bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-2 md:grid"
                >
                    <div class="grid max-w-full gap-2 p-1 mb-2">
                        <div class="flex justify-end">
                            <PrimaryButton
                                class="max-w-fit"
                                @click="modal = true"
                            >
                                Agregar Usuario
                            </PrimaryButton>
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

                    <Tabla>
                        <template #cols>
                            <Thead>ID</Thead>
                            <Thead>Nombre</Thead>
                            <Thead>e-Mail</Thead>
                            <Thead>Acciones</Thead>
                        </template>
                        <template #rows>
                            <tr
                                class="text-gray-700 hover:bg-gray-200 transition even:bg-gray-100"
                                v-for="user in usuarios"
                            >
                                <Tbody>{{ user.id }}</Tbody>
                                <Tbody>{{ user.name }}</Tbody>
                                <Tbody>
                                    {{ user.email }}
                                </Tbody>
                                <Tbody class="grid w-full gap-2">
                                    <ThirdButton
                                        :type="'button'"
                                        @click="
                                            modal = !modal;
                                            form.datos = user;
                                            form.name = user.name;
                                            form.email = user.email;
                                        "
                                    >
                                        Editar
                                    </ThirdButton>
                                    <div class="grid">
                                        <ThirdButton
                                            class="w-full"
                                            :type="'buton'"
                                            @click="
                                                del = !del;
                                                datos = user;
                                            "
                                        >
                                            Delete
                                        </ThirdButton>
                                    </div>
                                </Tbody>
                            </tr>
                        </template>
                    </Tabla>
                </div>
            </div>
        </template>
    </AppLayout>

    <!-- Crear usuario -->
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
            <h1 class="font-semibold text-xl text-gray-600 text-center">
                Usuario
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
                            value="Nombre del Usuario"
                            class="text-md font-semibold"
                        />
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            v-model="form.name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div>
                        <InputLabel
                            for="rol"
                            value="Seleccione un Rol"
                            class="text-md font-semibold"
                        />
                        <select
                            id="rol"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mt-1 block capitalize"
                            required
                            v-model="form.rol"
                        >
                            <option value="" disabled selected>
                                Selecione
                            </option>
                            <template v-for="rol in rols">
                                <option class="capitalize" :value="rol.id">
                                    {{ rol.name }}
                                </option>
                            </template>
                        </select>
                        <InputError class="mt-2" :message="form.errors.rol" />
                    </div>
                    <div>
                        <InputLabel
                            for="mail"
                            value="E-Mial"
                            class="text-md font-semibold"
                        />
                        <TextInput
                            id="pass"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div>
                        <InputLabel
                            for="pass"
                            value="Contraseña"
                            class="text-md font-semibold"
                        />
                        <TextInput
                            id="pass"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            v-model="form.password"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.password"
                        />
                    </div>
                    <ThirdButton
                        class="col-start-2"
                        :type="'submit'"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Crear nuevo usuario
                    </ThirdButton>
                </form>
            </div>
        </template>
    </DialogModal>
    <!-- Final crear usuario -->
    <!-- Eliminar usuario -->
    <DialogModal :show="del" @close="closeModal()">
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
            <h1 class="font-semibold text-2xl text-gray-600 text-center">
                Eliminar usuario
            </h1>
        </template>
        <template #content>
            <p class="text-center font-semibold text-lg text-gray-500">
                Estas seguro que deseas eliminar al usuario
                <span class="font-bold">{{ datos.name }}</span>
                si lo haces todos los documentos que este usuario allá subido
                seran elimiandos y no podras recuperarlos
            </p>
        </template>
        <template #footer>
            <Link
                :href="route('usuarios.delete')"
                method="POST"
                :data="{ id: datos.id }"
            >
                <DangerButton
                    class="col-start-2"
                    :type="'submit'"
                    @click="closeModal()"
                >
                    Eliminar usuario
                </DangerButton>
            </Link>
        </template>
    </DialogModal>
</template>
