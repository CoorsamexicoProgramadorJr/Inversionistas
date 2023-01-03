<script setup>
import ThirdButton from "./ThirdButton.vue";
import { Link } from "@inertiajs/inertia-vue3";
defineProps({
    documents: Array,
});
</script>

<template>
    <template v-for="docs in documents">
        <div
            class="grid items-center h-full w-full justify-center border-gray-300 gap-1 p-2 border"
        >
            <div class="flex flex-col items-center">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="icon icon-tabler icon-tabler-file-text"
                    width="100"
                    height="100"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="#000000"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                    <path
                        d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"
                    />
                    <line x1="9" y1="9" x2="10" y2="9" />
                    <line x1="9" y1="13" x2="15" y2="13" />
                    <line x1="9" y1="17" x2="15" y2="17" />
                </svg>
            </div>
            <Link :href="route('archivos.download', docs.path)">
                <ThirdButton class="w-full" :type="'submit'">{{
                    docs.name
                }}</ThirdButton>
            </Link>
        </div>
    </template>
</template>
