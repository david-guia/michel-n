const CACHE_NAME = 'chouette-deguisement-v1';
const urlsToCache = [
    '/',
    '/index.html',
    '/css/critical.css',
    '/css/main.css',
    '/js/search-engine.js',
    '/js/analytics.js',
    '/images/logo.webp',
    '/manifest.json'
];

// Installation du service worker
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => {
                console.log('Cache ouvert');
                return cache.addAll(urlsToCache);
            })
    );
});

// Interception des requêtes
self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request)
            .then((response) => {
                // Retourner la réponse du cache si elle existe
                if (response) {
                    return response;
                }

                // Sinon, faire la requête réseau
                return fetch(event.request).then((response) => {
                    // Vérifier si la réponse est valide
                    if (!response || response.status !== 200 || response.type !== 'basic') {
                        return response;
                    }

                    // Cloner la réponse
                    const responseToCache = response.clone();

                    caches.open(CACHE_NAME)
                        .then((cache) => {
                            cache.put(event.request, responseToCache);
                        });

                    return response;
                });
            }
        )
    );
});

// Nettoyage des anciens caches
self.addEventListener('activate', (event) => {
    const cacheWhitelist = [CACHE_NAME];

    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});
