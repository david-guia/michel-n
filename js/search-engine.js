class CostumeSearch {
    constructor() {
        this.costumes = [];
        this.loadData();
        this.setupSearchInterface();
    }

    async loadData() {
        try {
            const response = await fetch('/data/costumes.json');
            const data = await response.json();
            this.costumes = data.costumes;
        } catch (error) {
            console.warn('Base de données costumes non disponible');
        }
    }

    setupSearchInterface() {
        // Créer la barre de recherche si elle n'existe pas
        if (!document.getElementById('costume-search')) {
            const searchBar = document.createElement('div');
            searchBar.innerHTML = `
                <div id="costume-search" class="search-container">
                    <input type="text" id="search-input" placeholder="Rechercher un costume..." autocomplete="off">
                    <div id="search-results" class="search-results hidden"></div>
                </div>
            `;
            
            // Insérer après la navigation
            const nav = document.querySelector('nav') || document.querySelector('header');
            if (nav) nav.appendChild(searchBar);
        }

        // Événements de recherche
        const input = document.getElementById('search-input');
        if (input) {
            input.addEventListener('input', (e) => this.handleSearch(e.target.value));
            input.addEventListener('focus', () => this.showPopularCostumes());
        }
    }

    handleSearch(query) {
        if (query.length < 2) {
            this.hideResults();
            return;
        }

        const results = this.searchCostumes(query);
        this.displayResults(results);
    }

    searchCostumes(query) {
        const queryLower = query.toLowerCase();
        
        return this.costumes.filter(costume => {
            // Recherche dans le nom
            if (costume.nom.toLowerCase().includes(queryLower)) return true;
            
            // Recherche dans les catégories
            if (costume.categories.some(cat => cat.toLowerCase().includes(queryLower))) return true;
            
            // Recherche dans les thèmes
            if (costume.themes.some(theme => theme.toLowerCase().includes(queryLower))) return true;
            
            // Recherche dans les couleurs
            if (costume.couleurs.some(couleur => couleur.toLowerCase().includes(queryLower))) return true;
            
            return false;
        }).slice(0, 5); // Limiter à 5 résultats
    }

    displayResults(results) {
        const container = document.getElementById('search-results');
        if (!container) return;

        if (results.length === 0) {
            container.innerHTML = '<div class="no-results">Aucun costume trouvé</div>';
        } else {
            container.innerHTML = results.map(costume => `
                <div class="search-result-item" onclick="window.location.href='${costume.url}'">
                    <img src="${costume.image}" alt="${costume.nom}" width="50" height="50" loading="lazy">
                    <div class="result-info">
                        <h4>${costume.nom}</h4>
                        <p>${costume.description}</p>
                        <span class="categories">${costume.categories.join(', ')}</span>
                    </div>
                </div>
            `).join('');
        }
        
        container.classList.remove('hidden');
    }

    showPopularCostumes() {
        const popular = this.costumes.slice(0, 3);
        this.displayResults(popular);
    }

    hideResults() {
        const container = document.getElementById('search-results');
        if (container) container.classList.add('hidden');
    }
}

// Initialiser le système de recherche
document.addEventListener('DOMContentLoaded', () => {
    new CostumeSearch();
});
