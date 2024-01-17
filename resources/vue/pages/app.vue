<template>
    <layout>
        <div class="flex flex-col items-center justify-center w-screen h-screen">
            <button v-on:click="logout">Logout</button>
        </div>
    </layout>
</template>

<script>
import Layout from "../layouts/layout.vue";
import {toast} from "vue3-toastify";
import axios from "axios";

export default {
    name: "Dashboard",
    components: {Layout},
    methods: {
        logout() {
            axios.get('/app/logout')
                .then((response) => {
                    if (response.data.status >= 200 && response.data.status < 300) {
                        window.location.href = "/";
                    }
                })
                .catch((error) => {
                    console.error(error);
                    toast.error("Er is iets misgegaan");
                });
        }
    }
}
</script>

<style>
</style>
