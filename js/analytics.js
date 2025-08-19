class SimpleAnalytics {
    constructor() {
        this.sessionId = this.generateSessionId();
        this.startTime = Date.now();
        this.events = [];
        this.setupTracking();
    }

    generateSessionId() {
        return 'session_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
    }

    setupTracking() {
        // Suivi du temps passé sur la page
        window.addEventListener('beforeunload', () => {
            this.trackEvent('page_exit', {
                duration: Date.now() - this.startTime,
                page: window.location.pathname
            });
        });

        // Suivi des clics sur les costumes
        document.addEventListener('click', (e) => {
            if (e.target.closest('a[href*="costumes/"]')) {
                const link = e.target.closest('a');
                this.trackEvent('costume_click', {
                    costume: link.href.split('/').pop(),
                    from_page: window.location.pathname
                });
            }
        });

        // Suivi des recherches
        document.addEventListener('input', (e) => {
            if (e.target.id === 'search-input' && e.target.value.length > 2) {
                this.trackEvent('search_query', {
                    query: e.target.value,
                    page: window.location.pathname
                });
            }
        });
    }

    trackEvent(eventType, data = {}) {
        const event = {
            type: eventType,
            timestamp: Date.now(),
            sessionId: this.sessionId,
            page: window.location.pathname,
            userAgent: navigator.userAgent.substr(0, 100),
            ...data
        };

        this.events.push(event);
        
        // Stocker en localStorage (remplace Google Analytics pour la confidentialité)
        this.saveToLocalStorage(event);
    }

    saveToLocalStorage(event) {
        try {
            const stored = JSON.parse(localStorage.getItem('chouette_analytics') || '[]');
            stored.push(event);
            
            // Garder seulement les 100 derniers événements
            if (stored.length > 100) stored.shift();
            
            localStorage.setItem('chouette_analytics', JSON.stringify(stored));
        } catch (error) {
            console.warn('Analytics: Impossible de sauvegarder');
        }
    }

    getAnalytics() {
        try {
            return JSON.parse(localStorage.getItem('chouette_analytics') || '[]');
        } catch {
            return [];
        }
    }
}

// Initialiser les analytics
document.addEventListener('DOMContentLoaded', () => {
    window.chouetteAnalytics = new SimpleAnalytics();
});
