<script>
import ThirdButton from './ThirdButton.vue';

export default{
    data() {
        return {
            showingCat: false
        };
    },
    methods: {
        toggle() {
            this.showingCat = !this.showingCat;
        }
    },
    components: { ThirdButton }
}
</script>

<template>

    <!-- Menu caategorias Tablet-Desktop -->
    <div class="hidden md:grid md:grid-cols-6 w-full md:gap-2 items-center">
        <ThirdButton >
            Cat 1
        </ThirdButton>
        <ThirdButton >
            Cat 1
        </ThirdButton>
        <ThirdButton >
            Cat 1
        </ThirdButton>
        <ThirdButton >
            Cat 1
        </ThirdButton>
        <ThirdButton >
            Cat 1
        </ThirdButton>
        <ThirdButton >
            Cat 1
        </ThirdButton>
    </div>

    <!-- Menu Categorias Responsive -->
    <div class="-mr-2 flex items-center justify-center md:hidden">
        <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition" @click="toggle">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{ 'hidden': showingCat, 'inline-flex': !showingCat }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{ 'hidden': !showingCat, 'inline-flex': showingCat }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div :class="{ 'grid w-full': showingCat, 'hidden': !showingCat }" class="md:hidden">
        <div class="grid sm:grid-cols-2 gap-2">
            <ThirdButton @click="toggle">
                Cat 1
            </ThirdButton>
            <ThirdButton @click="toggle">
                Cat 1
            </ThirdButton>
        </div>
    </div>
</template>