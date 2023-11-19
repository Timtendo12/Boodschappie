<template>
    <div>
        <h1 class="absolute top-1 opacity-30 bg-white text-black text-lg z-50">ISPWA: {{isPWA}} | <span class="text-xs"><br>csrf: {{csrf}}</span></h1>
        <div v-if="isPWA">
            <slot></slot>
        </div>
        <div v-else>
            <non-app
                :isMobile="isMobile"
                :PWAInstallable="PWAInstallable"
                :deferredPrompt="deferredPrompt"
            />
        </div>
    </div>
</template>

<script>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { UAParser } from 'ua-parser-js'
import nonApp from '../pages/nonApp.vue'
import {toast} from "vue3-toastify";
export default {
    name: "layout",
    components: {nonApp},
    data() {
      return {
          PWAInstallable: false,
          deferredPrompt: null,
      }
    },
    setup() {
        const parser = new UAParser();
        const result = parser.getResult();
        let isPWA = false;
        let isMobile = false;
        const page = usePage()
        const csrf = computed(() => page.props.csrf)
        const message = computed(() => page.props.message)
        // check if on pwa
        if (window.matchMedia('(display-mode: standalone)').matches) {
            isPWA = true;
        }

        if (result.device.type === 'mobile') {
            isMobile = true;
        }

        if (!isPWA && location.pathname.includes('/app')) {
            location.href = '/'
        } else if (isPWA && !location.pathname.includes('/app')) {
            location.href = '/app'
        }

        localStorage.setItem('device', JSON.stringify(result));
        console.log(result);
        return { isPWA, csrf, isMobile, message}
    },
    created() {
        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevents the default mini-infobar or install dialog from appearing on mobile
            e.preventDefault();
            // Save the event because you'll need to trigger it later.
            this.deferredPrompt = e;
            this.PWAInstallable = true;
        });

        if (this.message) {
            if (this.message.type === "success") {
                toast.success(this.message.message)
            } else {
                toast.error(this.message.message)
            }
        }
    }
}
</script>
