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
import JSConfetti from 'js-confetti'
export default {
    name: "layout",
    components: {nonApp},
    data() {
      return {
          PWAInstallable: false,
          deferredPrompt: null,
          confettiSettings: {
              emojis: [],
          }
      }
    },
    setup() {
        const parser = new UAParser();
        const jsConfetti = new JSConfetti()
        const result = parser.getResult();
        let isPWA = true;
        let isMobile = false;
        const page = usePage()
        const csrf = computed(() => page.props.csrf)
        let message = computed(() => page.props.message)
        let confetti = computed(() => page.props.confetti)
        // check if on pwa
        if (window.matchMedia('(display-mode: standalone)').matches) {
            isPWA = true;
        }

        if (result.device.type === 'mobile') {
            isMobile = true;
        }

        if (message.value !== undefined && message.value !== null) {
            let messageQueue = localStorage.getItem("message_queue");

            if (messageQueue === null) {
                messageQueue = [];
            } else {
                messageQueue = JSON.parse(messageQueue);
            }

            messageQueue.push(message.value);

            messageQueue = JSON.stringify(messageQueue);

            localStorage.setItem("message_queue", messageQueue);
        }

        localStorage.setItem('device', JSON.stringify(result));
        console.log(result);

        if (!isPWA && location.pathname.includes('/app')) {
            location.href = '/'
        } else if (isPWA && !location.pathname.includes('/app')) {
            location.href = '/app'
        }

        return { isPWA, csrf, isMobile, jsConfetti, confetti}
    },
    created() {
        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevents the default mini-infobar or install dialog from appearing on mobile
            e.preventDefault();
            // Save the event because you'll need to trigger it later.
            this.deferredPrompt = e;
            this.PWAInstallable = true;
        });
    },
    mounted() {
        // Put all code above these lines. MessageQueue has to be ran last.
        let messageQueue = localStorage.getItem("message_queue");
        if (messageQueue !== null) {
            messageQueue = JSON.parse(messageQueue);

            messageQueue.forEach((message) => {
                if (message === null) return;
                switch (message.type) {
                    case "success":
                        toast.success(message.message);
                        break;
                    case "error":
                        toast.error(message.message);
                        break;
                    case "warning":
                        toast.warning(message.message);
                        break;
                    case "info":
                    default:
                        toast.info(message.message);
                        break;
                }
                if (message.confetti || this.confetti) {
                    this.showConfetti().then(() => {
                        console.log("done");
                    });
                }
            });
            localStorage.removeItem("message_queue");
        }
    },
    methods: {
        /**
         * Show confetti on the screen.
         * @param confettiSettings {object} override the default confetti settings.<br>
         * for more information see the <a href="https://github.com/loonywizard/js-confetti">GitHub</a>
         * @returns {Promise<void>} resolves when the confetti is done. Does not reject.
         */
        showConfetti(confettiSettings = this.confettiSettings) {
            return new Promise((resolve) => {
                this.jsConfetti.addConfetti(confettiSettings);
                resolve();
            });
        },
    }
}
</script>
