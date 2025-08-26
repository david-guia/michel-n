#!/bin/bash

echo "🎨 CORRECTION DES LIENS CSS DANS LES COSTUMES"
echo "============================================="

# Compter les fichiers concernés
total=$(grep -r "styles\.css" costumes/ | wc -l)
echo "📊 $total fichiers à corriger"

# Corriger tous les fichiers
echo "🔧 Correction en cours..."
find costumes/ -name "*.html" -exec grep -l "styles\.css" {} \; | while read file; do
    # Remplacer styles.css par style.css
    sed -i '' 's|styles\.css|style.css|g' "$file"
    echo "✅ Corrigé: $(basename "$file")"
done

echo ""
echo "🎉 Correction terminée !"
echo ""

# Vérification
remaining=$(grep -r "styles\.css" costumes/ | wc -l)
if [ "$remaining" -eq 0 ]; then
    echo "✅ Tous les liens CSS sont maintenant corrects"
else
    echo "⚠️  $remaining fichiers restent à corriger"
fi

echo ""
echo "🧹 VÉRIFICATION DES ERREURS PHP..."

# Test de syntaxe PHP sur quelques fichiers costumes
error_count=0
for file in costumes/disco.html costumes/charleston.html costumes/cancan.html; do
    if [ -f "$file" ]; then
        if php -l "$file" > /dev/null 2>&1; then
            echo "✅ $(basename "$file") - Syntaxe OK"
        else
            echo "❌ $(basename "$file") - Erreur PHP"
            ((error_count++))
        fi
    fi
done

echo ""
if [ "$error_count" -eq 0 ]; then
    echo "🎭 Toutes les pages costumes sont prêtes !"
else
    echo "⚠️  $error_count pages ont des erreurs PHP"
fi
