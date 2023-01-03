<script setup>
import { computed } from "vue";

const props = defineProps({
    over: {
        type: String,
        default: "x",
    },
});

const OverFlow = computed(() => {
    return {
        'x': "overflow-x-auto",
        'y': "overflow-y-auto",
    }[props.over];
});
</script>

<template>
    <div class="max-w-full overflow-hidden sm:rounded-lg">
        <div class="w-full overflow-auto" :class="OverFlow">
            <table id="tabla" class="w-full table-auto whitespace-nowrap">
                <thead>
                    <tr
                        class="text-sm font-semibold text-gray-700 tracking-wide text-left uppercase shadow-md border-b-2 border-gray-400"
                    >
                        <slot name="cols"></slot>
                    </tr>
                </thead>
                <tbody>
                    <slot name="rows"></slot>
                </tbody>
            </table>
        </div>
        <slot name="page" />
    </div>
</template>
