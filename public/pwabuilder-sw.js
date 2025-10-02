// Service Worker para PWA con soporte offline
importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');

const CACHE_NAME = "pwabuilder-offline";
const OFFLINE_PAGE = "favicons/offline.html";

// Activar skipWaiting si se solicita
self.addEventListener("message", (event) => {
    if (event.data && event.data.type === "SKIP_WAITING") {
        self.skipWaiting();
    }
});

// Instalar y cachear la página offline
self.addEventListener("install", async (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => cache.add(OFFLINE_PAGE))
            .catch((err) => console.error("Error al cachear offline.html:", err))
    );
});

// Activar navegación preload si está disponible
if (workbox.navigationPreload.isSupported()) {
    workbox.navigationPreload.enable();
}

// Interceptar navegación y servir offline si falla
self.addEventListener("fetch", (event) => {
    if (event.request.mode === "navigate") {
        event.respondWith((async () => {
            try {
                const preloadResp = await event.preloadResponse;
                if (preloadResp) return preloadResp;

                const networkResp = await fetch(event.request);
                return networkResp;
            } catch (error) {
                const cache = await caches.open(CACHE_NAME);
                const cachedResp = await cache.match(OFFLINE_PAGE);
                return cachedResp;
            }
        })());
    }
});
