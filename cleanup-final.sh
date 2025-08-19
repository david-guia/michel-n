#!/bin/bash

echo "🧹 NETTOYAGE FINAL - SUPPRESSION DES FICHIERS DE TEST ET SCRIPTS INUTILES"
echo "=========================================================================="
echo ""

# Liste des fichiers à supprimer
files_to_remove=(
    # Fichiers de test HTML
    "test-menu.html"
    "test-contact-hybride.html" 
    "test-hybride-complet.html"
    "test-php-html.html"
    "catalogue-femme/test-catalogue-hybride.html"
    
    # Fichiers hybrides temporaires (gardons les finaux)
    "contact-hybrid.html"
    "index-hybrid.html"
    "catalogue-femme/page-1-hybrid.html"
    
    # Fichiers fixed temporaires
    "index-fixed.html"
    
    # Scripts de développement/correction
    "fix-advanced-html-issues.sh"
    "fix-final-consistency.sh"
    "fix-simple.sh"
    "fix-dimensions-consistency.sh"
    "fix-ultra-precise.sh"
    "auto-migrate-hybrid.sh"
    "valider-solutions-hybrides.sh"
    "diagnostic-menu.sh"
    "analyze-coherence.sh"
    
    # Garder cleanup-project.sh pour référence future si besoin
)

# Compteurs
removed_count=0
not_found_count=0

echo "📋 SUPPRESSION DES FICHIERS:"
echo "----------------------------"

for file in "${files_to_remove[@]}"; do
    if [[ -f "$file" ]]; then
        echo "   🗑️ Suppression: $file"
        rm "$file"
        ((removed_count++))
    else
        echo "   ⚠️ Non trouvé: $file"
        ((not_found_count++))
    fi
done

echo ""
echo "📊 RÉSULTATS:"
echo "-------------"
echo "   ✅ Fichiers supprimés: $removed_count"
echo "   ⚠️ Fichiers non trouvés: $not_found_count"

# Vérification des rapports (optionnel - on peut les garder pour documentation)
echo ""
echo "📄 RAPPORTS DE DOCUMENTATION (conservés):"
echo "-----------------------------------------"

reports=(
    "RAPPORT_COHERENCE_FINALE.md"
    "RAPPORT_CORRECTION_MENU.md"
    "COHERENCE_FINALE.md"
    "RAPPORT_FINAL_COHERENCE.md"
    "RAPPORT_FINAL_PRECIS.md"
)

for report in "${reports[@]}"; do
    if [[ -f "$report" ]]; then
        echo "   📋 Conservé: $report"
    fi
done

echo ""
echo "🎯 FICHIERS ESSENTIELS CONSERVÉS:"
echo "---------------------------------"
essential_files=(
    "includes/html-components.php"
    ".htaccess" 
    "index.html"
    "contact.html"
    "a-propos.html"
    "cleanup-project.sh"
)

for file in "${essential_files[@]}"; do
    if [[ -f "$file" ]]; then
        echo "   ✅ $file"
    else
        echo "   ❌ $file - MANQUANT!"
    fi
done

# Structure finale propre
echo ""
echo "🏗️ STRUCTURE FINALE DU PROJET:"
echo "-------------------------------"
echo "   📁 Pages principales: index.html, contact.html, a-propos.html"
echo "   📁 Catalogues: catalogue-femme/, catalogue-homme/, catalogue-materiels/"
echo "   📁 Costumes: costumes/ (131+ fichiers)"
echo "   📁 Assets: css/, js/, images/, fonts/"
echo "   📁 PHP: includes/html-components.php"
echo "   📁 Config: .htaccess, robots.txt, sitemap.xml"
echo "   📁 Docs: README.md, rapports*.md"

echo ""
echo "✨ PROJET NETTOYÉ ET PRÊT POUR LA PRODUCTION!"
echo ""
echo "🎯 Prochaines étapes recommandées:"
echo "   1. Tester le site dans un navigateur"
echo "   2. Vérifier que tous les liens fonctionnent"
echo "   3. Valider le responsive design"
echo "   4. Optimiser si nécessaire"
echo ""
echo "📅 Nettoyage effectué le: $(date)"
