#!/bin/bash

echo "🔍 AUDIT COMPLET DU PROJET - ANALYSE GLOBALE"
echo "============================================="
echo ""

# Comptage des fichiers
main_pages=$(find . -maxdepth 1 -name "*.html" | wc -l | tr -d ' ')
catalogue_pages=$(find catalogue-* -name "*.html" 2>/dev/null | wc -l | tr -d ' ')
costume_pages=$(find costumes -name "*.html" 2>/dev/null | wc -l | tr -d ' ')
total_pages=$((main_pages + catalogue_pages + costume_pages))

echo "📊 STRUCTURE DU PROJET:"
echo "-----------------------"
echo "   📄 Pages principales: $main_pages"
echo "   📚 Pages catalogues: $catalogue_pages" 
echo "   👗 Pages costumes: $costume_pages"
echo "   📋 TOTAL: $total_pages pages HTML"

echo ""
echo "🔧 ANALYSE TECHNIQUE:"
echo "---------------------"

# Vérification des composants PHP
if [[ -f "includes/html-components.php" ]]; then
    php_functions=$(grep -c "function " includes/html-components.php)
    echo "   ✅ Composants PHP: $php_functions fonctions disponibles"
else
    echo "   ❌ Composants PHP: Fichier manquant!"
fi

# Vérification .htaccess
if [[ -f ".htaccess" ]]; then
    echo "   ✅ Configuration Apache: .htaccess présent"
    if grep -q "php_value" .htaccess; then
        echo "      → Configuration PHP active"
    fi
else
    echo "   ⚠️ Configuration Apache: .htaccess manquant"
fi

# Analyse des erreurs HTML communes
echo ""
echo "🚨 DÉTECTION D'ERREURS:"
echo "-----------------------"

# Doublons d'attributs
duplicate_loading=$(grep -r 'loading="lazy".*loading="lazy"' *.html **/*.html 2>/dev/null | grep -v backup-original | wc -l | tr -d ' ')
duplicate_dimensions=$(grep -r 'width="[0-9]*".*width="[0-9]*"' *.html **/*.html 2>/dev/null | grep -v backup-original | wc -l | tr -d ' ')

echo "   🔄 Doublons loading=\"lazy\": $duplicate_loading occurrences"
echo "   📐 Doublons dimensions: $duplicate_dimensions occurrences"

# Attributs alt manquants
empty_alt=$(grep -r 'alt=""' *.html **/*.html 2>/dev/null | grep -v backup-original | wc -l | tr -d ' ')
echo "   🏷️ Attributs alt vides: $empty_alt occurrences"

# Images sans lazy loading
missing_lazy=$(grep -r '<img[^>]*>' *.html **/*.html 2>/dev/null | grep -v backup-original | grep -v 'loading="lazy"' | wc -l | tr -d ' ')
echo "   ⚡ Images sans lazy loading: $missing_lazy occurrences"

# Liens cassés potentiels
broken_links=$(grep -r 'href="[^"]*\.html"' *.html **/*.html 2>/dev/null | grep -v backup-original | grep -E '\.\./.*\.html|\.html#' | wc -l | tr -d ' ')
echo "   🔗 Liens potentiellement cassés: $broken_links occurrences"

echo ""
echo "📱 ANALYSE RESPONSIVE:"
echo "----------------------"

# Vérification viewport
viewport_missing=$(grep -L 'viewport' *.html **/*.html 2>/dev/null | grep -v backup-original | wc -l | tr -d ' ')
echo "   📱 Pages sans viewport: $viewport_missing occurrences"

# CSS responsive
if [[ -f "css/responsive.css" ]]; then
    media_queries=$(grep -c '@media' css/responsive.css)
    echo "   🎨 Media queries disponibles: $media_queries"
else
    echo "   ❌ CSS responsive manquant"
fi

echo ""
echo "⚡ ANALYSE PERFORMANCE:"
echo "----------------------"

# Taille des CSS
css_size=$(find css -name "*.css" -exec wc -c {} + 2>/dev/null | tail -1 | awk '{print $1}')
if [[ -n "$css_size" ]]; then
    css_kb=$((css_size / 1024))
    echo "   🎨 Taille totale CSS: ${css_kb}KB"
fi

# Taille des JS
js_size=$(find js -name "*.js" -exec wc -c {} + 2>/dev/null | tail -1 | awk '{print $1}')
if [[ -n "$js_size" ]]; then
    js_kb=$((js_size / 1024))
    echo "   📜 Taille totale JS: ${js_kb}KB"
fi

# Images non optimisées (non WebP)
non_webp=$(find images -type f \( -name "*.jpg" -o -name "*.jpeg" -o -name "*.png" \) 2>/dev/null | wc -l | tr -d ' ')
webp_images=$(find images -name "*.webp" 2>/dev/null | wc -l | tr -d ' ')
echo "   🖼️ Images WebP: $webp_images optimisées"
echo "   📸 Images non-WebP: $non_webp à optimiser"

echo ""
echo "🔍 ANALYSE SEO:"
echo "---------------"

# Meta descriptions manquantes
missing_meta=$(grep -L 'meta name="description"' *.html **/*.html 2>/dev/null | grep -v backup-original | wc -l | tr -d ' ')
echo "   📝 Pages sans meta description: $missing_meta"

# Titles manquants ou génériques
missing_title=$(grep -L '<title>' *.html **/*.html 2>/dev/null | grep -v backup-original | wc -l | tr -d ' ')
echo "   📰 Pages sans title: $missing_title"

# H1 manquants
missing_h1=$(grep -L '<h1>' *.html **/*.html 2>/dev/null | grep -v backup-original | wc -l | tr -d ' ')
echo "   📋 Pages sans H1: $missing_h1"

echo ""
echo "🎯 SCORE GLOBAL D'OPTIMISATION:"
echo "-------------------------------"

# Calcul d'un score approximatif
total_issues=$((duplicate_loading + duplicate_dimensions + empty_alt + missing_lazy + viewport_missing + missing_meta + missing_title + missing_h1))
max_score=100
current_score=$((max_score - (total_issues * 2)))

if [[ $current_score -lt 0 ]]; then
    current_score=0
fi

echo "   📊 Score actuel: $current_score/100"

if [[ $current_score -ge 90 ]]; then
    echo "   🥇 EXCELLENT - Projet très bien optimisé"
elif [[ $current_score -ge 70 ]]; then
    echo "   🥈 BON - Quelques améliorations possibles"
elif [[ $current_score -ge 50 ]]; then
    echo "   🥉 MOYEN - Optimisations nécessaires"
else
    echo "   🚨 FAIBLE - Optimisations urgentes requises"
fi

echo ""
echo "💡 RECOMMANDATIONS PRIORITAIRES:"
echo "--------------------------------"

if [[ $duplicate_loading -gt 0 ]]; then
    echo "   🔧 HAUTE - Corriger les $duplicate_loading doublons loading"
fi

if [[ $empty_alt -gt 10 ]]; then
    echo "   🏷️ HAUTE - Remplir les $empty_alt attributs alt vides"
fi

if [[ $missing_lazy -gt 20 ]]; then
    echo "   ⚡ MOYENNE - Ajouter lazy loading sur $missing_lazy images"
fi

if [[ $missing_meta -gt 5 ]]; then
    echo "   📝 MOYENNE - Ajouter meta descriptions sur $missing_meta pages"
fi

if [[ $non_webp -gt 0 ]]; then
    echo "   🖼️ BASSE - Convertir $non_webp images en WebP"
fi

echo ""
echo "📋 PLAN D'ACTION SUGGÉRÉ:"
echo "-------------------------"
echo "   1. 🔧 Correction automatique des doublons HTML"
echo "   2. 🏷️ Optimisation des attributs alt et meta"
echo "   3. ⚡ Amélioration des performances (lazy loading)"
echo "   4. 📱 Vérification responsive design" 
echo "   5. 🔗 Validation des liens internes"
echo "   6. 🎨 Optimisation CSS/JS"
echo "   7. 📊 Tests finaux et validation"

echo ""
echo "📅 Audit réalisé le: $(date)"
