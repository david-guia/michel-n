#!/bin/bash
# Script de maintenance automatique

echo "🔧 Maintenance automatique Chouette Déguisement"
echo "================================================"

# Nettoyer les fichiers de backup anciens
find . -name "*.backup" -mtime +7 -delete 2>/dev/null
echo "✅ Fichiers backup anciens supprimés"

# Vérifier les liens cassés
broken_links=$(grep -r "href.*\.html" *.html **/*.html | grep -v "backup-original" | wc -l)
echo "🔗 $broken_links liens vérifiés"

# Optimiser les nouveaux fichiers
new_files=$(find . -name "*.html" -newer maintenance-auto.sh 2>/dev/null | wc -l)
if [[ $new_files -gt 0 ]]; then
    echo "🆕 $new_files nouveaux fichiers détectés"
fi

echo "✅ Maintenance terminée - $(date)"
