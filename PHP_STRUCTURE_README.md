# Structure PHP Modularisée - Chouette Déguisement

## 🎯 Objectif

Cette structure PHP modularise les éléments redondants du site (header, footer, navigation) pour faciliter la maintenance et les mises à jour.

## 📁 Structure des fichiers

```
includes/
├── config.php          # Configuration générale du site
├── head.php            # En-tête HTML avec CSS/JS optimisés
├── navigation.php      # Menu de navigation
├── footer.php          # Pied de page
├── components.php      # Composants réutilisables (Calendly, pagination, etc.)
└── data.php           # Base de données des costumes

catalogue-femme/
├── page-1.php         # Exemple de page catalogue PHP
└── ...

costumes/
├── template.php       # Template de base pour les costumes
├── cancan.php         # Exemple de page costume PHP
└── ...
```

## 🚀 Utilisation

### 1. Page de base

```php
<?php
// Inclure les composants nécessaires
require_once '../includes/config.php';
require_once '../includes/head.php';
require_once '../includes/navigation.php';
require_once '../includes/components.php';
require_once '../includes/footer.php';

// Configuration de la page
$pageTitle = 'Titre de la page';
$pageDescription = 'Description pour le SEO';

// Rendu
renderHead(1, $pageTitle, $pageDescription); // 1 = niveau de profondeur
?>

<div id="wrap">
  <main>
    <?php renderNavigation(1, 'currentPage'); ?>
    
    <!-- Contenu de la page -->
    
    <?php renderCalendlySection(); ?>
    <?php renderGoogleMap(1); ?>
  </main>
</div>

<?php renderFooter(1); ?>
```

### 2. Page catalogue

```php
<?php
require_once '../includes/config.php';
require_once '../includes/head.php';
require_once '../includes/navigation.php';
require_once '../includes/components.php';
require_once '../includes/data.php';
require_once '../includes/footer.php';

// Récupération des données
$costumes = getCostumesByCategory('femme', 1, 12);

renderHead(1, 'Catalogue Femme', 'Description du catalogue');
?>

<div id="wrap">
  <main>
    <?php renderNavigation(1, 'femme'); ?>
    
    <!-- Contenu du catalogue -->
    <div class="row">
      <?php foreach ($costumes['costumes'] as $costume): ?>
      <div class="col-md-3">
        <!-- Affichage du costume -->
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <?php renderPagination($costumes['current_page'], $costumes['pages'], 'page-'); ?>

    <?php renderCalendlySection(); ?>
    <?php renderGoogleMap(1); ?>
  </main>
</div>

<?php renderFooter(1); ?>
```

### 3. Page costume individuel

```php
<?php
require_once '../includes/config.php';
require_once '../includes/head.php';
require_once '../includes/navigation.php';
require_once '../includes/components.php';
require_once '../includes/data.php';
require_once '../includes/footer.php';

// Récupération du costume
$costume = getCostumeData('cancan');

renderHead(1, $costume['name'], $costume['description']);
?>

<div id="wrap">
  <main>
    <?php renderNavigation(1, 'costume'); ?>
    
    <!-- Détails du costume -->
    <div class="product-details">
      <h1><?= htmlspecialchars($costume['name']) ?></h1>
      <span class="price"><?= $costume['price'] ?> €</span>
      
      <!-- Bouton de réservation -->
      <?php renderReserveButton($costume['name']); ?>
    </div>

    <?php renderCalendlySection(); ?>
    <?php renderGoogleMap(1); ?>
  </main>
</div>

<?php renderFooter(1); ?>
```

## 🔧 Paramètres des fonctions

### renderHead($depth, $title, $description)
- `$depth` : Niveau de profondeur (0=racine, 1=sous-dossier)
- `$title` : Titre de la page (optionnel)
- `$description` : Description META (optionnel)

### renderNavigation($depth, $currentPage)
- `$depth` : Niveau de profondeur
- `$currentPage` : Page active pour le highlighting ('home', 'about', 'contact', 'femme', 'homme', 'costume')

### renderFooter($depth)
- `$depth` : Niveau de profondeur

### renderPagination($current, $total, $baseUrl)
- `$current` : Page courante
- `$total` : Nombre total de pages
- `$baseUrl` : URL de base pour les liens (ex: 'page-')

## 📊 Gestion des données

### Ajouter un nouveau costume

```php
// Dans includes/data.php, ajouter dans getCostumeData():
'nouveau-costume' => [
    'name' => 'Nom du costume',
    'price' => 35,
    'size' => 'S-M-L',
    'accessories' => 'Liste des accessoires',
    'image' => '../images/catalogue/image.webp',
    'category' => 'femme', // ou 'homme'
    'description' => 'Description courte',
    'long_description' => 'Description détaillée...',
    'tags' => ['tag1', 'tag2', 'tag3']
]
```

## 🎨 Avantages de cette structure

### ✅ **Facilité de maintenance**
- Modification du header/footer en un seul endroit
- Cohérence garantie sur toutes les pages
- Mise à jour des méta-données centralisée

### ✅ **Performance optimisée**
- CSS/JS optimisés automatiquement
- Lazy loading intégré
- Chargement conditionnel des ressources

### ✅ **SEO amélioré**
- Méta-données dynamiques
- URLs et breadcrumbs automatiques
- Structure HTML cohérente

### ✅ **Évolutivité**
- Base de données facilement extensible
- Composants réutilisables
- Templates modulaires

## 🔄 Migration des pages existantes

Pour migrer une page HTML existante :

1. **Copier le contenu principal** (entre `<main>` et `</main>`)
2. **Remplacer le header** par `<?php renderNavigation(1, 'currentPage'); ?>`
3. **Remplacer le footer** par `<?php renderFooter(1); ?>`
4. **Ajouter l'include** des composants en haut de page
5. **Adapter les chemins** relatifs si nécessaire

## 🛠️ Configuration

### Modifier les informations du site
Éditer `includes/config.php` pour changer :
- Nom du site
- Adresse de contact
- IDs d'analytics
- URL Calendly

### Ajouter de nouveaux composants
Créer des fonctions dans `includes/components.php` pour les éléments réutilisables.

---

Cette structure PHP permet une maintenance beaucoup plus facile du site tout en conservant toutes les optimisations de performance déjà appliquées.
