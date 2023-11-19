<template>
    <non-app_modal v-if="showSafariModal" title="Boodschappie installeren op iOS">
        Om Boodschappie te installeren op je iOS/iPadOS apparaat volg je de volgende stappen.
        deze stappenplan gaat ervan uit dat je de site bezoekt met gebruik van de Safari app.
        <br>
        <br>
        <ol class="list-decimal	list-inside	">
            <li>Klik op het "deel" icoontje in je navigatie balk."</li>
            <li>Klik op de optie "Zet op beginscherm". Het kan zijn dat je een klein beetje naar onder moet scrollen.</li>
            <li>Als laaste klik "Voeg toe" rechts boven op je scherm!</li>
        </ol>
        <br>
        <br>
        <p>Na deze 3 stappen heb je succesvol Boodschappie geinstalleerd op je iPhone/iPad!</p>
    </non-app_modal>
    <div class="max-w-screen-xl mx-auto px-5 flex flex-col items-center justify-center h-screen">
        <main class="grid md:grid-cols-2 place-items-center pt-16 pb-8 md:px-8 sm:pt-12 sm:pb-24">
            <div class="py-6 md:order-1 hidden md:block">
                <div class="h-96">
                    <img alt="Astronaut in the air" class="h-full" loading="eager" src="/assets/img/phone_hp_na.svg">
                </div>
            </div>
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold lg:tracking-tight xl:tracking-tighter">
                    Gezamelijk boodschappenlijsjte op 1 plek.
                </h1>
                <p class="text-lg mt-4 text-slate-600 max-w-xl">
                    Boodschappie is een handige app bla die bla die bla TODO:
                </p>
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <button v-on:click="install" v-if="PWAInstallable" href="#" class="rounded text-center transition focus-visible:ring-2 ring-offset-2 ring-gray-200 px-5 py-2.5 bg-black text-white hover:bg-gray-800 border-2 border-transparent flex gap-1 items-center justify-center">
                        <svg viewBox="0 0 24 24" class="text-white w-5 h-5"><path fill="currentColor" d="M18.944 11.112C18.507 7.67 15.56 5 12 5 9.244 5 6.85 6.61 5.757 9.149 3.609 9.792 2 11.82 2 14c0 2.657 2.089 4.815 4.708 4.971V19H17.99v-.003L18 19c2.206 0 4-1.794 4-4a4.008 4.008 0 0 0-3.056-3.888zM8 12h3V9h2v3h3l-4 5-4-5z"></path></svg>
                        Download app
                    </button>
                    <a v-else href="#" class="rounded text-center transition focus-visible:ring-2 ring-offset-2 ring-gray-200 px-5 py-2.5 bg-black text-white hover:bg-gray-800 border-2 border-transparent flex gap-1 items-center justify-center">
                        <svg viewBox="0 0 24 24" class="text-white w-5 h-5"><path fill="currentColor" d="M18.944 11.112C18.507 7.67 15.56 5 12 5 9.244 5 6.85 6.61 5.757 9.149 3.609 9.792 2 11.82 2 14c0 2.657 2.089 4.815 4.708 4.971V19H17.99v-.003L18 19c2.206 0 4-1.794 4-4a4.008 4.008 0 0 0-3.056-3.888zM8 12h3V9h2v3h3l-4 5-4-5z"></path></svg>
                        Installeer instructies
                    </a>
                    <a href="/hoe-werkt-het" class="rounded text-center transition focus-visible:ring-2 ring-offset-2 ring-gray-200 px-5 py-2.5 bg-white border-2 border-black hover:bg-gray-100 text-black flex gap-1 items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"  class="text-black w-4 h-4" viewBox="0 0 16 16">
                            <path d="M8.05 9.6c.336 0 .504-.24.554-.627.04-.534.198-.815.847-1.26.673-.475 1.049-1.09 1.049-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.71 1.71 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745z"/>
                            <path d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"/>
                            <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0z"/>
                        </svg>
                        Hoe werkt het?
                    </a>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import NonApp_modal from "../components/nonApp_modal.vue";

export default {
    name: "nonAppPage",
    components: {NonApp_modal},
    props: [
        "isMobile", //Wether the site is being accessed on mobile/
        "PWAInstallable", // If the PWA is installable on the device
        "deferredPrompt" // Browsers install prompt.
    ],
    data() {
        return {
            showSafariModal: false,
        }
    },
    methods: {
        async install() {
            let result = JSON.parse(localStorage.getItem('device'));

            if (result.browser.name.toLowerCase() === 'safari') {
                this.showSafariModal = this.isMobile
            }

            if (this.deferredPrompt == null) {
                return;
            }

            this.deferredPrompt.prompt();

            const {outcome} = await this.deferredPrompt.userChoice;
            if (outcome === 'accepted') {
                location.reload();
            }
        }
    }
}
</script>

<style scoped>


</style>
