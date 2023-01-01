<script setup>
import { ref } from "vue";
import { useForm, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "../Layouts/AppLayout.vue";
import Table from "../Components/Table.vue";
import Thead from "../Components/Thead.vue";
import Tbody from "../Components/Tbody.vue";
import ThirdButton from "./../Components/ThirdButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "../Components/TextInput.vue";
import InputLabel from "../Components/InputLabel.vue";
import DialogModal from "../Components/DialogModal.vue";
import DangerButton from "../Components/DangerButton.vue";
import InputError from "@/Components/InputError.vue";

defineProps(["cats", "errors"]);
const datos = Object;
const del = ref(false);
const crea = ref(false);
const edit = ref(false);

const closeModal = () => {
    del.value = false;
    crea.value = false;
    edit.value = false;
    form.reset();
};
const form = useForm({
    id: "",
    name: "",
});
const submit = () => {
    form.transform((data) => ({
        ...data,
    })).post(route("category.create"), {
        onSuccess: () => {
            closeModal();
            form.errors = [];
        },
        onCancel: () => form.reset(),
    });
};
</script>
<template>
    <AppLayout title="Categorias">
        <template #header>
            <h1 class="text-xl font-bold">Categorias</h1>
        </template>
        <template #>
            <div class="max-w-7xl mx-auto sm:px-2 md:px-4">
                <div
                    class="max-w-full max-h-screen bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-2 md:grid"
                >
                    <div class="flex justify-end mb-2">
                        <PrimaryButton @click="crea = true">
                            Agregar Categoria
                        </PrimaryButton>
                    </div>
                    <Table :over="'y'">
                        <template #cols>
                            <Thead>id</Thead>
                            <Thead>Nombre</Thead>
                            <Thead>acciones</Thead>
                        </template>
                        <template #rows>
                            <tr v-for="c in cats">
                                <Tbody>{{ c.id }}</Tbody>
                                <Tbody>{{ c.name }}</Tbody>
                                <Tbody class="grid gap-1">
                                    <ThirdButton
                                        :type="'button'"
                                        @click="
                                            crea = !crea;
                                            datos = c;
                                            form.name = c.name;
                                            form.id = c.id;
                                        "
                                    >
                                        Editar
                                    </ThirdButton>

                                    <ThirdButton
                                        :type="'buton'"
                                        @click="
                                            del = !del;
                                            datos = c;
                                        "
                                    >
                                        Delete
                                    </ThirdButton>
                                </Tbody>
                            </tr>
                        </template>
                    </Table>
                </div>
            </div>
        </template>
    </AppLayout>

    <!-- Dialogo Crear -->
    <DialogModal :max-width="'sm'" :show="crea" @close="closeModal">
        <template #title>
            <h1 class="font-semibold text-xl text-gray-600 text-center">
                Categoria
            </h1>
        </template>
        <template #content>
            <form class="p-2 grid gap-2" @submit.prevent="submit">
                <div>
                    <InputLabel
                        for="name"
                        value="Nombre de la Categoria"
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
                    <TextInput
                        id="name"
                        type="hidden"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        v-model="form.id"
                    />
                    <ThirdButton
                        class="w-full"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Crear
                    </ThirdButton>
                </div>
            </form>
        </template>
    </DialogModal>

    <!-- Dialogo Eliminar -->
    <DialogModal :show="del" @close="closeModal">
        <template #title>
            <h1 class="font-semibold text-xl text-gray-600 text-center">
                Eliminar
                <span class="font-bold uppercase">{{ datos.name }}.</span>
            </h1>
        </template>
        <template #content>
            <p class="text-center font-semibold text-lg text-gray-500">
                Estas seguro que deseas eliminar la categoria de
                <span class="font-bold uppercase">{{ datos.name }}</span>
                todos los documentos que esten dentro de esta categoria seran
                eliminados
            </p>
        </template>
        <template #footer>
            <Link
                :href="route('category.destroy')"
                method="POST"
                :data="{ id: datos.id }"
            >
                <DangerButton
                    class="col-start-2"
                    :type="'submit'"
                    @click="closeModal()"
                >
                    Eliminar categoria
                </DangerButton>
            </Link>
        </template>
    </DialogModal>
</template>
