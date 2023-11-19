<template>
    <layout>
        <div class="w-screen h-screen bg-login flex flex-col items-center justify-center px-5 py-28">
            <div class="rounded-2xl border-2 border-gray-100 bg-white py-10 w-full md:w-1/2 md:h-full h-3/5 flex flex-col items-center justify-around drop-shadow-2xl max-md:gap-5">
                <div class="text-xl font-bold flex flex-col items-center justify-center">
                    <h1 class="text-2xl drop-shadow">Boodschappie</h1>
                    <h1>Inloggen</h1>
                </div>
                <div class="w-full px-7">
                    <input type="email" placeholder="E-mail" class="border-[1px] border-gray-200 rounded-lg w-full px-3 py-2 mb-4 text-sm">
                    <input type="password" placeholder="Wachtwoord" class="border-[1px] border-gray-200 rounded-lg w-full px-3 py-2 text-sm">
                </div>
                <div class="w-full px-7 flex md:flex-row-reverse flex-col items-center justify-between md:gap-0 gap-5">
                    <button class="font-bold text-white bg-blue-600 px-1.5 py-2.5 rounded-lg text-sm w-full md:w-1/3 md:min-w-fit">Inloggen</button>
                    <div class="flex flex-col flex text-xs">
                        <p>Nog geen account?</p>
                        <a href="/app/register" class="text-blue-500 font-bold">Registreer hier</a>
                    </div>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>

import {defineComponent} from "vue";
import Layout from "../../layouts/layout.vue";

export default defineComponent({
    components: {Layout}
})
</script>

<style scoped>

.bg-login {
    background: linear-gradient(180deg, #e3ffe7 0%, #d9e7ff 100%);
}

</style>
