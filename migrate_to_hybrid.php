<?php
/**
 * MIGRATION AUTOMATIQUE VERS SOLUTION HYBRIDE
 * Script pour convertir tous les fichiers HTML du projet vers la solution PHP-HTML
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "🚀 MIGRATION HYBRIDE AUTOMATIQUE\n";
echo "================================\n\n";

// Configuration
$projectRoot = __DIR__;
$includesDir = $projectRoot . '/includes';
$backupDir = $projectRoot . '/backup-before-hybrid';

// Statistiques
$stats = [
    'total' => 0,
    'migrated' => 0,
    'skipped' => 0,
    'errors' => 0
];

/**
 * Détermine la profondeur d'un fichier par rapport à la racine
 */
function getFileDepth($filePath, $projectRoot) {
    $relativePath = str_replace($projectRoot . '/', '', $filePath);
    return substr_count($relativePath, '/');
}

/**
 * Détermine la section active basée sur le chemin du fichier
 */
function getCurrentSection($filePath) {
    if (strpos($filePath, 'catalogue-femme/') !== false) return 'femme';
    if (strpos($filePath, 'catalogue-homme/') !== false) return 'homme';
    if (strpos($filePath, 'contact') !== false) return 'contact';
    if (strpos($filePath, 'a-propos') !== false) return 'about';
    if (strpos($filePath, 'index') !== false) return 'home';
    return 'home';
}

/**
 * Génère le code d'inclusion PHP approprié
 */
function generateIncludeCode($depth) {
    $includePath = str_repeat('../', $depth) . 'includes/html-components.php';
    return "<?php include_once '$includePath'; ?>\n";
}

/**
 * Remplace les sections redondantes par du PHP
 */
function replaceRedundantSections($content, $section, $depth) {
    // 1. Remplacer les variables dans le head
    $content = preg_replace(
        '/<title>([^<]*)<\/title>/',
        '<title>$1<?php echo " - " . SITE_NAME; ?></title>',
        $content
    );
    
    // 2. Ajouter des meta dynamiques si pas présentes
    if (strpos($content, 'meta name="description"') === false) {
        $metaInsert = '  <meta name="description" content="<?php echo SITE_DESCRIPTION; ?>" />' . "\n";
        $content = preg_replace('/(<meta[^>]*viewport[^>]*>\s*)/', '$1' . $metaInsert, $content);
    }
    
    // 3. Corriger les chemins des favicons
    $content = str_replace('href="/favicon.ico"', 'href="' . str_repeat('../', $depth) . 'favicon.ico"', $content);
    $content = str_replace("href='/favicon.ico'", "href='" . str_repeat('../', $depth) . "favicon.ico'", $content);
    
    return $content;
}

/**
 * Identifie et remplace la navigation existante
 */
function replaceNavigation($content, $section, $depth) {
    // Pattern pour identifier la navigation (flexible)
    $navPatterns = [
        // Navigation avec header complet
        '/(<header[^>]*>.*?<\/header>)/s',
        // Navigation mobile + desktop
        '/(<div[^>]*cd-nav[^>]*>.*?<\/div>\s*<header.*?<\/header>)/s',
        // Juste la partie header
        '/(<div[^>]*sticky[^>]*>.*?<\/div>\s*<\/div>\s*<\/header>)/s'
    ];
    
    $replacement = "      <!-- NAVIGATION (remplacée par PHP) -->\n      <?php renderSimpleNavigation('$section', $depth); ?>";
    
    foreach ($navPatterns as $pattern) {
        if (preg_match($pattern, $content)) {
            $content = preg_replace($pattern, $replacement, $content, 1);
            break;
        }
    }
    
    return $content;
}

/**
 * Remplace le footer existant
 */
function replaceFooter($content, $depth) {
    $footerPatterns = [
        '/(<footer[^>]*>.*?<\/footer>)/s',
        '/(<div[^>]*class="[^"]*footer[^"]*"[^>]*>.*?<\/div>)/s'
    ];
    
    $replacement = "  <!-- FOOTER (remplacé par PHP) -->\n  <?php renderSimpleFooter($depth); ?>";
    
    foreach ($footerPatterns as $pattern) {
        if (preg_match($pattern, $content)) {
            $content = preg_replace($pattern, $replacement, $content, 1);
            break;
        }
    }
    
    return $content;
}

/**
 * Ajoute les sections Calendly et Google Maps si approprié
 */
function addDynamicSections($content) {
    // Ajouter Calendly avant la fermeture de main si pas présent
    if (strpos($content, 'calendly') === false && strpos($content, 'reservation') !== false) {
        $calendlySection = "      <!-- SECTION RÉSERVATION (remplacée par PHP) -->\n      <?php renderSimpleCalendlySection(); ?>\n\n";
        $content = str_replace('</main>', $calendlySection . '    </main>', $content);
    }
    
    // Ajouter Google Maps avant le footer si pas présent  
    if (strpos($content, 'google.*map') === false && strpos($content, 'map') !== false) {
        $mapSection = "      <!-- GOOGLE MAP (remplacée par PHP) -->\n      <?php renderSimpleGoogleMap(); ?>\n\n";
        $content = str_replace('</main>', $mapSection . '    </main>', $content);
    }
    
    return $content;
}

/**
 * Migre un fichier HTML vers la solution hybride
 */
function migrateFile($filePath, $projectRoot) {
    global $stats;
    
    echo "Traitement: " . str_replace($projectRoot . '/', '', $filePath) . "\n";
    
    // Lire le fichier
    if (!file_exists($filePath)) {
        echo "  ❌ Fichier non trouvé\n";
        $stats['errors']++;
        return false;
    }
    
    $content = file_get_contents($filePath);
    if ($content === false) {
        echo "  ❌ Impossible de lire le fichier\n";
        $stats['errors']++;
        return false;
    }
    
    // Vérifier si déjà migré
    if (strpos($content, 'include_once') !== false || strpos($content, 'renderSimple') !== false) {
        echo "  ⏭️ Déjà migré\n";
        $stats['skipped']++;
        return true;
    }
    
    // Calculer la profondeur et la section
    $depth = getFileDepth($filePath, $projectRoot);
    $section = getCurrentSection($filePath);
    
    echo "  📁 Profondeur: $depth, Section: $section\n";
    
    // Sauvegarder l'original
    $backupPath = str_replace($projectRoot, $projectRoot . '/backup-before-hybrid', $filePath);
    $backupDir = dirname($backupPath);
    if (!is_dir($backupDir)) {
        mkdir($backupDir, 0755, true);
    }
    copy($filePath, $backupPath);
    
    // Appliquer les transformations
    $originalContent = $content;
    
    // 1. Ajouter l'inclusion PHP au début
    $includeCode = generateIncludeCode($depth);
    $content = $includeCode . $content;
    
    // 2. Remplacer les sections redondantes
    $content = replaceRedundantSections($content, $section, $depth);
    
    // 3. Remplacer la navigation
    $content = replaceNavigation($content, $section, $depth);
    
    // 4. Remplacer le footer
    $content = replaceFooter($content, $depth);
    
    // 5. Ajouter les sections dynamiques si approprié
    $content = addDynamicSections($content);
    
    // Écrire le fichier modifié
    if (file_put_contents($filePath, $content) !== false) {
        echo "  ✅ Migré avec succès\n";
        $stats['migrated']++;
        return true;
    } else {
        echo "  ❌ Erreur lors de l'écriture\n";
        // Restaurer l'original en cas d'erreur
        file_put_contents($filePath, $originalContent);
        $stats['errors']++;
        return false;
    }
}

/**
 * Lance la migration sur tous les fichiers HTML
 */
function runMigration($projectRoot) {
    global $stats;
    
    // Créer le dossier de sauvegarde
    $backupDir = $projectRoot . '/backup-before-hybrid';
    if (!is_dir($backupDir)) {
        mkdir($backupDir, 0755, true);
        echo "📂 Dossier de sauvegarde créé: $backupDir\n\n";
    }
    
    // Trouver tous les fichiers HTML
    $htmlFiles = [];
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($projectRoot));
    
    foreach ($iterator as $file) {
        if ($file->isFile() && strtolower($file->getExtension()) === 'html') {
            $filePath = $file->getRealPath();
            
            // Exclure certains fichiers
            $relativePath = str_replace($projectRoot . '/', '', $filePath);
            if (strpos($relativePath, 'test-') === 0 ||
                strpos($relativePath, 'backup-') === 0 ||
                strpos($relativePath, '.git/') !== false ||
                strpos($relativePath, 'hybrid') !== false) {
                continue;
            }
            
            $htmlFiles[] = $filePath;
        }
    }
    
    $stats['total'] = count($htmlFiles);
    echo "📊 Fichiers HTML trouvés: {$stats['total']}\n\n";
    
    // Migrer chaque fichier
    foreach ($htmlFiles as $filePath) {
        migrateFile($filePath, $projectRoot);
        echo "\n";
        
        // Pause courte pour éviter la surcharge
        usleep(100000); // 0.1 seconde
    }
}

// Lancer la migration
echo "🎯 Début de la migration...\n\n";
runMigration($projectRoot);

// Afficher les statistiques finales
echo "\n" . str_repeat("=", 50) . "\n";
echo "📊 RÉSULTATS DE LA MIGRATION\n";
echo str_repeat("=", 50) . "\n";
echo "Total de fichiers: {$stats['total']}\n";
echo "✅ Migrés: {$stats['migrated']}\n";
echo "⏭️ Ignorés: {$stats['skipped']}\n";
echo "❌ Erreurs: {$stats['errors']}\n";

$successRate = $stats['total'] > 0 ? round(($stats['migrated'] / $stats['total']) * 100, 1) : 0;
echo "📈 Taux de réussite: {$successRate}%\n";

if ($stats['migrated'] > 0) {
    echo "\n🎉 MIGRATION TERMINÉE AVEC SUCCÈS !\n";
    echo "📂 Sauvegardes disponibles dans: backup-before-hybrid/\n";
    echo "🧪 Testez avec: http://localhost/votre-projet/index.html\n";
}

echo "\n";
?>
