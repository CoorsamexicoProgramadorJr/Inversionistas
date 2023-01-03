<script setup>
import { Link } from "@inertiajs/inertia-vue3";
const props = defineProps({
    links: Array,
    total: Number,
    to: Number,
    from: Number,
});
</script>
<template>
    <div
        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-600 uppercase border rounded"
    >
        <span class="flex items-center col-span-3">
            Mostrando {{ from }}-{{ to }} de {{ total }}
        </span>
        <span class="con-span-2"></span>
        <span class="flex col-span-4 sm:mt-auto sm:justify-end">
            <nav aria-label="Table navigation">
                <ul class="inline-flex items-center">
                    <li v-for="(link, k) in links" :key="k">
                        <div
                            v-if="link.url === null"
                            class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-blue"
                            v-html="link.label"
                        ></div>
                        <Link
                            v-else
                            class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-blue"
                            :class="{ 'bg-blue-700 text-white': link.active }"
                            :href="link.url"
                            v-html="link.label"
                        ></Link>
                    </li>
                </ul>
            </nav>
        </span>
    </div>
</template>
