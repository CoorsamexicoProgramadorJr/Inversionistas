<template>
    <div class="md:flex md:justify-center md:gap-10 p-5 md:items-center">
        <div class="md:w-8/12">
            <slot name="imagen"/>
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-2xl flex flex-col items-center">
            <div>
                <slot name="logo" />
            </div>
            
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg">
                <slot />
            </div>
        </div>
    </div>
</template>
