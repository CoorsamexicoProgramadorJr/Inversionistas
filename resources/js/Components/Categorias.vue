<script setup>
import ThirdButton from "./ThirdButton.vue";
import { ref } from "vue";
const showingCat = ref(false);

defineProps({
    categories: Array,
});
</script>

<template>
    <!-- Menu caategorias Tablet-Desktop -->
    <div
        class="hidden md:grid md:grid-cols-4 lg:grid-cols-6 w-full md:gap-2 items-center px-2"
    >
        <template v-for="cat in categories">
            <ThirdButton class="h-full">
                {{ cat.name }}
            </ThirdButton>
        </template>
    </div>

    <!-- Menu Categorias Responsive -->
    <div class="-mr-2 flex items-center justify-center md:hidden">
        <button
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
            @click="showingCat = !showingCat"
        >
            <svg
                class="h-6 w-6"
                stroke="currentColor"
                fill="none"
                viewBox="0 0 24 24"
            >
                <path
                    :class="{ hidden: showingCat, 'inline-flex': !showingCat }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                />
                <path
                    :class="{ hidden: !showingCat, 'inline-flex': showingCat }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>
    </div>
    <div
        :class="{ 'grid w-full': showingCat, hidden: !showingCat }"
        class="md:hidden"
    >
        <div class="grid sm:grid-cols-2 gap-2">
            <template v-for="cat in categories">
                <ThirdButton @click="showingCat = !showingCat">
                    {{ cat.name }}
                </ThirdButton>
            </template>
        </div>
    </div>
</template>
