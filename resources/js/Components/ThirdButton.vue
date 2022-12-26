<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type"
        class="inline-flex justify-center items-center px-4 py-2 bg-teal-400 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-teal-500 active:bg-teal-700 focus:outline-none focus:border-teal-700 focus:ring focus:ring-teal-300/50 disabled:opacity-25 transition">
        <slot />
    </button>
</template>
