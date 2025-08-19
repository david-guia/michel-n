# Guide de Migration : PHP dans les Fichiers HTML

## 📋 Migration Hybride - Conserver les Extensions .html

Cette approche vous permet d'utiliser PHP dans vos fichiers HTML existants **sans changer les extensions**, grâce à la configuration Apache.

### ✅ Prérequis

1. **Apache configuré** - Le fichier `.htaccess` a été mis à jour
2. **Serveur PHP** - XAMPP, MAMP ou serveur web avec PHP
3. **Fichiers PHP créés** - Le dossier `includes/` est prêt

---

## 🚀 Migration en 3 Étapes

### Étape 1 : Ajouter l'inclusion PHP

Ajoutez cette ligne **tout en haut** de votre fichier HTML, avant `<!DOCTYPE html>` :

```php
<?php include_once 'includes/html-components.php'; ?>
```

**Note :** Ajustez le chemin selon la profondeur :
- Page racine : `includes/html-components.php`
- Sous-dossier : `../includes/html-components.php`
- Deux niveaux : `../../includes/html-components.php`

### Étape 2 : Remplacer les Sections Redondantes

#### Navigation
**Ancien code HTML :**
```html
<div class="header">
  <nav class="navbar">
    <!-- Long code de navigation -->
  </nav>
</div>
```

**Nouveau code PHP :**
```php
<?php renderSimpleNavigation('accueil', 0); ?>
```

#### Footer
**Ancien code HTML :**
```html
<footer class="footer">
  <!-- Long code de footer -->
</footer>
```

**Nouveau code PHP :**
```php
<?php renderSimpleFooter(0); ?>
```

#### Réservation Calendly
**Ancien code HTML :**
```html
<section class="reservation">
  <!-- Code Calendly complexe -->
</section>
```

**Nouveau code PHP :**
```php
<?php renderSimpleCalendlySection(); ?>
```

#### Google Maps
**Ancien code HTML :**
```html
<section class="map">
  <!-- Code Google Maps -->
</section>
```

**Nouveau code PHP :**
```php
<?php renderSimpleGoogleMap(); ?>
```

### Étape 3 : Utiliser les Variables PHP

Dans les balises `<title>` et `<meta>` :

```html
<title><?php echo SITE_NAME; ?> - Ma Page</title>
<meta name="description" content="<?php echo SITE_DESCRIPTION; ?>" />
```

---

## 📄 Exemples de Pages Migrées

### Page d'Accueil
Fichier : `index-hybrid.html`
- Navigation dynamique
- Variables PHP dans le head
- Sections communes en PHP

### Page de Contact
Fichier : `contact-hybrid.html`
- Informations de contact dynamiques
- Footer et navigation PHP

### Page de Catalogue
Fichier : `catalogue-femme/page-1-hybrid.html`
- Navigation avec section active
- Breadcrumb dynamique

---

## 🔧 Fonctions PHP Disponibles

### Navigation
```php
renderSimpleNavigation($section, $level)
```
- `$section` : 'accueil', 'femme', 'homme', 'contact'
- `$level` : 0 (racine), 1 (sous-dossier)

### Footer
```php
renderSimpleFooter($level)
```
- `$level` : 0 (racine), 1 (sous-dossier)

### Calendly
```php
renderSimpleCalendlySection()
```
Affiche la section de réservation Calendly

### Google Maps
```php
renderSimpleGoogleMap()
```
Affiche la carte Google Maps

---

## 🎯 Avantages de Cette Approche

### ✅ Avantages
- **URLs inchangées** - Pas de redirection nécessaire
- **SEO préservé** - Les URLs restent les mêmes
- **Migration progressive** - Une page à la fois
- **Maintenance simplifiée** - Modifications centralisées
- **Compatible** - Fonctionne avec l'infrastructure existante

### ⚠️ Points d'Attention
- **Serveur PHP requis** - Ne fonctionne pas en fichier local simple
- **Cache serveur** - Peut nécessiter un vidage de cache
- **Configuration Apache** - Le .htaccess doit être supporté

---

## 🧪 Test de Fonctionnement

### 1. Vérifiez PHP dans HTML
Créez un fichier `test.html` :
```html
<?php echo "PHP fonctionne dans HTML !"; ?>
<p>Test réussi si vous voyez le message PHP ci-dessus.</p>
```

### 2. Testez les Composants
Créez `test-components.html` :
```html
<?php include_once 'includes/html-components.php'; ?>
<!DOCTYPE html>
<html>
<body>
  <h1><?php echo SITE_NAME; ?></h1>
  <?php renderSimpleNavigation('accueil', 0); ?>
</body>
</html>
```

---

## 📚 Migration Recommandée

### Ordre de Migration Suggéré :

1. **Page d'accueil** (`index.html`)
2. **Page de contact** (`contact.html`)
3. **Pages de catalogue principales**
4. **Pages de costumes individuels**
5. **Pages secondaires**

### Temps Estimé :
- **Par page** : 5-10 minutes
- **Site complet** : 2-3 heures
- **Test et validation** : 1 heure

---

## 🆘 Dépannage

### PHP ne s'affiche pas
1. Vérifiez que le serveur PHP est démarré
2. Confirmez que `.htaccess` contient `AddType application/x-httpd-php .html`
3. Testez avec un fichier `.php` classique

### Erreurs d'inclusion
1. Vérifiez les chemins relatifs (`../includes/...`)
2. Assurez-vous que `html-components.php` existe
3. Contrôlez les permissions de fichier

### CSS/JS cassés
1. Vérifiez les chemins relatifs après migration
2. Testez la page dans un navigateur
3. Utilisez les outils de développement (F12)

---

*Cette migration vous permet de bénéficier des avantages du PHP tout en conservant vos URLs existantes !*
