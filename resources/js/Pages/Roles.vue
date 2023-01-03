<script setup>
import { ref } from "vue";
import { useForm, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "../Layouts/AppLayout.vue";
import Table from "../Components/Table.vue";
import Thead from "../Components/Thead.vue";
import Tbody from "../Components/Tbody.vue";
import TextInput from "../Components/TextInput.vue";
import InputLabel from "../Components/InputLabel.vue";
import DialogModal from "../Components/DialogModal.vue";
import ThirdButton from "./../Components/ThirdButton.vue";
import DangerButton from "../Components/DangerButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "../Components/InputError.vue";
//Propiedades
const props = defineProps({
    permisos: {
        type: Object,
        default: "",
    },
    roles: {
        type: Object,
        default: "",
    },
});

//Variables
const datos = Object;
const modal = ref(false);
const del = ref(false);

const closeModal = () => {
    modal.value = false;
    del.value = false;
    form.reset();
    form.errors = [];
};
const form = useForm({
    id: "",
    name: "",
});
const submit = () => {
    form.transform((data) => ({
        ...data,
    })).post(route("roles.create"), {
        onSuccess: () => closeModal(),
        onCancel: () => form.reset(),
    });
};
</script>

<template>
    <AppLayout title="Roles">
        <template #header>
            <h1 class="text-xl font-bold">Roles</h1>
        </template>

        <template #>
            <div class="max-w-7xl mx-auto sm:px-2 md:px-4">
                <div
                    class="max-w-full bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-2 md:grid md:grid-cols-2 md:gap-2"
                >
                    <!-- Tabla Roles -->
                    <div>
                        <div>
                            <h2
                                class="text-center mb-1 font-bold text-xl text-gray-500"
                            >
                                Roles
                            </h2>
                            <div class="grid justify-end">
                                <PrimaryButton @click="modal = !modal">
                                    Crear Rol
                                </PrimaryButton>
                            </div>
                        </div>
                        <Table :over="'y'" class="table-auto">
                            <template #cols>
                                <Thead>Id</Thead>
                                <Thead>Nombe</Thead>
                                <Thead class="text-right w-fit">Acciones</Thead>
                            </template>
                            <template #rows>
                                <tr
                                    class="text-gray-700 hover:bg-gray-200 transition cursor-pointer even:bg-gray-100"
                                    v-for="r in roles"
                                >
                                    <Tbody class="capitalize">{{ r.id }}</Tbody>
                                    <Tbody class="capitalize">{{
                                        r.name
                                    }}</Tbody>
                                    <Tbody
                                        class="grid gap-1 text-right justify-end"
                                    >
                                        <ThirdButton
                                            class="w-fit"
                                            :type="'button'"
                                            @click="
                                                modal = !modal;
                                                form.name = r.name;
                                                form.id = r.id;
                                            "
                                        >
                                            Editar
                                        </ThirdButton>
                                        <ThirdButton
                                            class="w-fit"
                                            :type="'buton'"
                                            @click="
                                                del = !del;
                                                datos = r;
                                            "
                                        >
                                            Delete
                                        </ThirdButton>
                                    </Tbody>
                                </tr>
                            </template>
                        </Table>
                    </div>

                    <!-- Taabla Permisos -->
                    <div>
                        <div>
                            <h2
                                class="text-center mb-1 font-bold text-xl text-gray-500"
                            >
                                Permisos
                            </h2>
                            <div class="flex justify-end items-center gap-2">
                                <InputLabel
                                    for="search"
                                    value="Buscar:"
                                    class="text-md text-gray-700 font-semibold"
                                />
                                <TextInput
                                    id="search"
                                    class="text-xs"
                                    type="text"
                                />
                            </div>
                        </div>
                        <Table class="table-auto" :over="'y'">
                            <template #cols>
                                <Thead>Id</Thead>
                                <Thead>Nombe</Thead>
                                <Thead class="text-right">Autorizacion</Thead>
                            </template>
                            <template #rows>
                                <tr
                                    class="text-gray-700 hover:bg-gray-200 transition cursor-pointer even:bg-gray-100"
                                    v-for="p in permisos"
                                    for="permiso"
                                >
                                    <Tbody class="capitalize">{{ p.id }}</Tbody>
                                    <Tbody class="capitalize">{{
                                        p.name
                                    }}</Tbody>
                                    <Tbody class="text-center w-7">
                                        <TextInput
                                            type="checkbox"
                                            id="permiso"
                                        />
                                    </Tbody>
                                </tr>
                            </template>
                        </Table>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>

    <!-- Modal del create -->
    <DialogModal class="max-h-screen" :show="modal" @close="closeModal">
        <template #title>
            <h1 class="font-semibold text-2xl text-gray-600 text-center">
                Roles
            </h1>
        </template>
        <template #content>
            <form class="p-2 grid grid-cols-2 gap-2" @submit.prevent="submit">
                <div>
                    <InputLabel
                        for="name"
                        value="Nombre del Rol"
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
                    <Table class="table-auto" :over="'y'">
                        <template #cols>
                            <Thead>Nombe</Thead>
                            <Thead class="text-right">Autorizacion</Thead>
                        </template>
                        <template #rows>
                            <tr
                                class="text-gray-700 hover:bg-gray-200 transition cursor-pointer even:bg-gray-100"
                                v-for="p in permisos"
                            >
                                <Tbody class="capitalize">{{ p.name }}</Tbody>
                                <Tbody class="text-center w-7">
                                    <TextInput type="checkbox" />
                                </Tbody>
                            </tr>
                        </template>
                    </Table>
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="col-start-2">
                    <TextInput
                        id="name"
                        type="hidden"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        v-model="form.id"
                    />
                    <ThirdButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Crear nuevo Rol
                    </ThirdButton>
                </div>
            </form>
        </template>
    </DialogModal>

    <!-- Modal Delete -->
    <DialogModal :show="del" @close="closeModal">
        <template #title>
            <h1 class="font-semibold text-2xl text-gray-600 text-center">
                Rol
                <span class="font-bold uppercase">{{ datos.name }}.</span>
            </h1>
        </template>
        <template #content>
            <p class="text-center font-semibold text-lg text-gray-500">
                Estas seguro que deseas eliminar el rol
                <span class="font-bold uppercase">{{ datos.name }}</span>
                una vez eliminado no podras recuperarlo
            </p>
        </template>
        <template #footer>
            <Link
                :href="route('roles.destroy')"
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
