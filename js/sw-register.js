// Enregistrement du Service Worker
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/service-worker.js')
            .then((registration) => {
                console.log('Service Worker enregistré avec succès:', registration.scope);
            })
            .catch((error) => {
                console.log('Échec de l\'enregistrement du Service Worker:', error);
            });
    });
}

// Notification de mise à jour disponible
navigator.serviceWorker.addEventListener('controllerchange', () => {
    if ('Notification' in window && Notification.permission === 'granted') {
        new Notification('Chouette Déguisement', {
            body: 'Une nouvelle version du site est disponible !',
            icon: '/images/logo.webp'
        });
    }
});
