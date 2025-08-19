#!/bin/bash

# SCRIPT DE NETTOYAGE - SUPPRESSION DES FICHIERS INUTILES
# Supprime tous les fichiers temporaires et de développement après migration hybride

echo "🧹 NETTOYAGE DU PROJET - SUPPRESSION DES FICHIERS INUTILES"
echo "=========================================================="
echo ""

# Couleurs pour l'affichage
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
NC='\033[0m' # No Color

# Compteurs
deleted_files=0
deleted_dirs=0
total_size_freed=0

# Fonction pour supprimer un fichier avec confirmation
delete_file() {
    local file="$1"
    local reason="$2"
    
    if [ -f "$file" ]; then
        local size=$(stat -f%z "$file" 2>/dev/null || echo "0")
        echo -e "${RED}🗑️  Suppression: $file ${YELLOW}($reason)${NC}"
        rm -f "$file"
        ((deleted_files++))
        total_size_freed=$((total_size_freed + size))
    fi
}

# Fonction pour supprimer un dossier avec confirmation
delete_directory() {
    local dir="$1"
    local reason="$2"
    
    if [ -d "$dir" ]; then
        echo -e "${RED}📁 Suppression dossier: $dir ${YELLOW}($reason)${NC}"
        rm -rf "$dir"
        ((deleted_dirs++))
    fi
}

echo "🎯 PHASE 1: FICHIERS DE TEST ET DÉVELOPPEMENT"
echo "============================================"

# Supprimer tous les fichiers de test
delete_file "test-hybride-complet.html" "fichier de test"
delete_file "test-contact-hybride.html" "fichier de test"
delete_file "test-php-html.html" "fichier de test"
delete_file "diagnostic-simple.html" "fichier de diagnostic"

# Supprimer les tests dans les sous-dossiers
delete_file "catalogue-femme/test-catalogue-hybride.html" "fichier de test"

echo ""
echo "🎯 PHASE 2: FICHIERS HYBRIDES TEMPORAIRES"
echo "========================================"

# Supprimer les pages hybrides de développement (gardées comme exemples pendant dev)
delete_file "contact-hybrid.html" "version de développement, remplacée par contact.html"
delete_file "index-hybrid.html" "version de développement, remplacée par index.html"
delete_file "catalogue-femme/page-1-hybrid.html" "version de développement"

echo ""
echo "🎯 PHASE 3: SCRIPTS DE MIGRATION"
echo "==============================="

# Supprimer les scripts de migration (plus nécessaires)
delete_file "analyze_before_migration.php" "script de développement"
delete_file "auto-migrate-hybrid.sh" "script de migration terminé"
delete_file "migrate_to_hybrid.php" "script de migration terminé"
delete_file "migrate_to_php.php" "script de migration ancien"
delete_file "valider-solutions-hybrides.sh" "script de validation"

echo ""
echo "🎯 PHASE 4: FICHIERS PHP OBSOLÈTES"
echo "================================="

# Supprimer les anciens composants PHP (remplacés par html-components.php)
delete_file "includes/components.php" "remplacé par html-components.php"
delete_file "includes/config.php" "configuration intégrée dans html-components.php"
delete_file "includes/data.php" "non utilisé"
delete_file "includes/footer.php" "remplacé par html-components.php"
delete_file "includes/head.php" "remplacé par html-components.php"
delete_file "includes/navigation.php" "remplacé par html-components.php"

echo ""
echo "🎯 PHASE 5: FICHIERS TEMPORAIRES ET ANCIENS"
echo "=========================================="

# Supprimer les fichiers temporaires
delete_file "index.html-2" "fichier temporaire"
delete_file ".DS_Store" "fichier système Mac"

# Supprimer les fichiers PHP non utilisés
delete_file "php/submit.php" "script PHP non utilisé"
delete_file "php/submit 2.php" "script PHP non utilisé"

# Supprimer le dossier php s'il est vide
if [ -d "php" ] && [ -z "$(ls -A php)" ]; then
    delete_directory "php" "dossier vide"
fi

echo ""
echo "🎯 PHASE 6: DOCUMENTATION DE DÉVELOPPEMENT"
echo "========================================"

# Garder certains fichiers de documentation mais supprimer les temporaires
delete_file "GUIDE_MIGRATION_HYBRIDE.md" "guide de migration terminé"
delete_file "MODERNISATION_PHP_COMPLETE.md" "documentation de développement"
delete_file "PHP_STRUCTURE_README.md" "documentation de développement"
delete_file "RAPPORT_TESTS_HYBRIDES.md" "rapport de tests temporaire"
delete_file "RAPPORT_VERIFICATION.md" "rapport de vérification temporaire"

# Garder RAPPORT_MIGRATION_MASSIVE.md comme documentation finale
echo -e "${GREEN}📋 Conservation: RAPPORT_MIGRATION_MASSIVE.md (documentation finale)${NC}"

echo ""
echo "🎯 PHASE 7: DOSSIER DE SAUVEGARDE"
echo "==============================="

# Demander confirmation pour supprimer backup-original
echo -e "${YELLOW}⚠️  Le dossier backup-original/ contient les versions originales${NC}"
echo -e "${YELLOW}   Voulez-vous le conserver ou le supprimer ?${NC}"
echo -e "${BLUE}   - Conserver: utile pour rollback en cas de problème${NC}"
echo -e "${BLUE}   - Supprimer: libère de l'espace disque${NC}"

# Pour l'automatisation, on va le conserver par sécurité
echo -e "${GREEN}📂 Conservation: backup-original/ (sécurité)${NC}"

echo ""
echo "======================================="
echo "📊 RÉSULTATS DU NETTOYAGE"
echo "======================================="
echo -e "${BLUE}Fichiers supprimés: $deleted_files${NC}"
echo -e "${BLUE}Dossiers supprimés: $deleted_dirs${NC}"

if [ $total_size_freed -gt 0 ]; then
    if [ $total_size_freed -gt 1048576 ]; then
        size_mb=$((total_size_freed / 1048576))
        echo -e "${GREEN}Espace libéré: ~${size_mb}MB${NC}"
    elif [ $total_size_freed -gt 1024 ]; then
        size_kb=$((total_size_freed / 1024))
        echo -e "${GREEN}Espace libéré: ~${size_kb}KB${NC}"
    else
        echo -e "${GREEN}Espace libéré: ${total_size_freed} bytes${NC}"
    fi
fi

echo ""
echo "✅ FICHIERS CONSERVÉS (ESSENTIELS):"
echo "=================================="
echo -e "${GREEN}📄 Pages principales: index.html, contact.html, a-propos.html${NC}"
echo -e "${GREEN}📁 Catalogues: catalogue-femme/, catalogue-homme/, catalogue-materiels/${NC}"
echo -e "${GREEN}🎭 Costumes: costumes/ (tous les costumes individuels)${NC}"
echo -e "${GREEN}🎨 Ressources: css/, js/, images/, fonts/, rs-plugin/${NC}"
echo -e "${GREEN}⚙️  Configuration: .htaccess, includes/html-components.php${NC}"
echo -e "${GREEN}📋 Documents: README.md, CGV, CGU, robots.txt, sitemap.xml${NC}"
echo -e "${GREEN}💾 Sauvegardes: backup-original/ (par sécurité)${NC}"

echo ""
if [ $deleted_files -gt 0 ] || [ $deleted_dirs -gt 0 ]; then
    echo -e "${GREEN}🎉 NETTOYAGE TERMINÉ AVEC SUCCÈS !${NC}"
    echo -e "${BLUE}Le projet est maintenant optimisé et ne contient que les fichiers essentiels.${NC}"
else
    echo -e "${YELLOW}ℹ️  Aucun fichier inutile trouvé. Le projet est déjà propre.${NC}"
fi

echo ""
