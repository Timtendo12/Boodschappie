<template>
    <div class="absolute z-50 h-screen w-screen">
        <div class="flex flex-col justify-center items-center h-full w-full">
            <div class="border-2 border-gray-200 rounded-2xl px-10 py-8 bg-white md:w-1/2 w-4/5">
                <h1 class="md:text-2xl text-xl font-bold mb-10">{{title}}</h1>
                <p class="text-justify mb-10 md:text-md text-sm">
                    <slot></slot>
                </p>
                <button class="px-2 py-1 bg-black text-white text-bold rounded-lg">Sluit</button>
            </div>
        </div>
    </div>
    <div class="absolute z-40 h-screen w-screen bg-gray-600 opacity-20">
    </div>
</template>

<script>
export default {
    name: 'nonApp_modal',
    props: ['title']
}
</script>
