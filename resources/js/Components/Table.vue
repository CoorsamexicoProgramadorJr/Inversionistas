<script setup>
import { computed } from "vue";
</script>

<template>
    <div class="max-w-full overflow-hidden sm:rounded-lg">
        <div class="w-full overflow-auto">
            <table
                id="tabla"
                class="overflow-auto w-full table-auto whitespace-nowrap"
            >
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
