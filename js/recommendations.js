class CostumeRecommendations {
    constructor() {
        this.userPreferences = this.loadPreferences();
        this.setupRecommendations();
    }

    loadPreferences() {
        try {
            return JSON.parse(localStorage.getItem('costume_preferences') || '{}');
        } catch {
            return {};
        }
    }

    savePreferences() {
        localStorage.setItem('costume_preferences', JSON.stringify(this.userPreferences));
    }

    trackInterest(costume, category, theme) {
        // Enregistrer les intérêts de l'utilisateur
        if (!this.userPreferences.categories) this.userPreferences.categories = {};
        if (!this.userPreferences.themes) this.userPreferences.themes = {};
        if (!this.userPreferences.viewed) this.userPreferences.viewed = [];

        // Incrémenter les compteurs
        this.userPreferences.categories[category] = (this.userPreferences.categories[category] || 0) + 1;
        this.userPreferences.themes[theme] = (this.userPreferences.themes[theme] || 0) + 1;
        
        // Ajouter à l'historique
        this.userPreferences.viewed.push({
            costume,
            timestamp: Date.now(),
            category,
            theme
        });

        // Garder seulement les 20 derniers
        if (this.userPreferences.viewed.length > 20) {
            this.userPreferences.viewed.shift();
        }

        this.savePreferences();
    }

    getRecommendations() {
        const topCategories = Object.entries(this.userPreferences.categories || {})
            .sort(([,a], [,b]) => b - a)
            .slice(0, 3)
            .map(([cat]) => cat);

        const topThemes = Object.entries(this.userPreferences.themes || {})
            .sort(([,a], [,b]) => b - a)
            .slice(0, 3)
            .map(([theme]) => theme);

        // Recommandations basées sur les préférences
        const recommendations = [
            { text: "Basé sur vos recherches récentes", costumes: topCategories },
            { text: "Thèmes qui pourraient vous plaire", costumes: topThemes },
            { text: "Populaires cette semaine", costumes: ["charleston", "disco", "pirate"] }
        ];

        return recommendations;
    }

    setupRecommendations() {
        // Suivre les pages visitées
        this.trackCurrentPage();
        
        // Afficher les recommandations sur la page d'accueil
        if (window.location.pathname === '/' || window.location.pathname === '/index.html') {
            this.displayRecommendations();
        }
    }

    trackCurrentPage() {
        const path = window.location.pathname;
        
        if (path.includes('costumes/')) {
            const costumeName = path.split('/').pop().replace('.html', '');
            
            // Déterminer la catégorie et le thème à partir du nom
            let category = 'général';
            let theme = 'fête';
            
            if (costumeName.includes('charleston')) { category = 'années 20'; theme = 'élégant'; }
            else if (costumeName.includes('disco')) { category = 'années 70'; theme = 'disco'; }
            else if (costumeName.includes('pirate')) { category = 'aventure'; theme = 'historique'; }
            else if (costumeName.includes('medieval')) { category = 'historique'; theme = 'moyen-age'; }
            
            this.trackInterest(costumeName, category, theme);
        }
    }

    displayRecommendations() {
        const recommendations = this.getRecommendations();
        const container = document.querySelector('#recommendations-container') || this.createRecommendationsContainer();
        
        if (recommendations.length > 0) {
            container.innerHTML = `
                <h3>🎯 Recommandé pour vous</h3>
                <div class="recommendations-grid">
                    ${recommendations.map(rec => `
                        <div class="recommendation-section">
                            <h4>${rec.text}</h4>
                            <div class="costume-tags">
                                ${rec.costumes.map(costume => 
                                    `<span class="costume-tag" onclick="searchCostume('${costume}')">${costume}</span>`
                                ).join('')}
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;
        }
    }

    createRecommendationsContainer() {
        const container = document.createElement('div');
        container.id = 'recommendations-container';
        container.className = 'recommendations-container';
        
        // Insérer après le contenu principal
        const main = document.querySelector('main') || document.querySelector('#content');
        if (main) {
            main.appendChild(container);
        }
        
        return container;
    }
}

// Fonction globale pour la recherche depuis les recommandations
window.searchCostume = function(costume) {
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.value = costume;
        searchInput.focus();
        searchInput.dispatchEvent(new Event('input'));
    }
};

// Initialiser les recommandations
document.addEventListener('DOMContentLoaded', () => {
    window.costumeRecommendations = new CostumeRecommendations();
});
