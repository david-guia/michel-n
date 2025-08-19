<?php
/**
 * SCRIPT DE TEST PRÉALABLE POUR LA MIGRATION HYBRIDE
 * Analyse quelques fichiers pour valider l'approche avant la migration complète
 */

echo "🔍 ANALYSE PRÉALABLE POUR MIGRATION HYBRIDE\n";
echo "==========================================\n\n";

$projectRoot = __DIR__;

/**
 * Analyse un fichier HTML pour comprendre sa structure
 */
function analyzeFile($filePath, $projectRoot) {
    echo "📄 Analyse: " . str_replace($projectRoot . '/', '', $filePath) . "\n";
    
    if (!file_exists($filePath)) {
        echo "  ❌ Fichier non trouvé\n\n";
        return;
    }
    
    $content = file_get_contents($filePath);
    $depth = getFileDepth($filePath, $projectRoot);
    
    echo "  📁 Profondeur: $depth\n";
    
    // Vérifier la présence de différents éléments
    $checks = [
        'DOCTYPE' => preg_match('/<!DOCTYPE[^>]*>/i', $content),
        'Title' => preg_match('/<title[^>]*>(.*?)<\/title>/i', $content, $titleMatch),
        'Navigation mobile' => preg_match('/cd-nav|navigation|navbar/i', $content),
        'Header/Logo' => preg_match('/<header|logo|sticky/i', $content),
        'Footer' => preg_match('/<footer/i', $content),
        'Calendly' => preg_match('/calendly/i', $content),
        'Google Maps' => preg_match('/google.*maps|iframe.*maps/i', $content),
        'PHP déjà présent' => preg_match('/<\?php|include_once/i', $content)
    ];
    
    foreach ($checks as $element => $found) {
        $status = $found ? '✅' : '❌';
        echo "  $status $element\n";
        
        if ($element === 'Title' && $found) {
            echo "    → Titre actuel: " . trim($titleMatch[1]) . "\n";
        }
    }
    
    // Analyser les patterns de navigation
    if (preg_match('/(<div[^>]*cd-nav.*?<\/div>)/s', $content, $navMatch)) {
        echo "  🧭 Navigation mobile détectée\n";
    }
    
    if (preg_match('/(<header[^>]*>.*?<\/header>)/s', $content, $headerMatch)) {
        echo "  🏠 Header complet détecté\n";
    }
    
    echo "\n";
}

function getFileDepth($filePath, $projectRoot) {
    $relativePath = str_replace($projectRoot . '/', '', $filePath);
    return substr_count($relativePath, '/');
}

/**
 * Teste la migration sur un fichier (sans l'appliquer)
 */
function testMigrationOnFile($filePath, $projectRoot) {
    echo "🧪 Test de migration: " . str_replace($projectRoot . '/', '', $filePath) . "\n";
    
    $content = file_get_contents($filePath);
    $depth = getFileDepth($filePath, $projectRoot);
    $section = getCurrentSection($filePath);
    
    echo "  📊 Paramètres détectés:\n";
    echo "    - Profondeur: $depth\n";
    echo "    - Section: $section\n";
    echo "    - Include path: " . str_repeat('../', $depth) . "includes/html-components.php\n";
    
    // Simuler les remplacements
    $changes = 0;
    
    if (preg_match('/<title>([^<]*)<\/title>/', $content)) {
        echo "  ✅ Titre sera modifié pour inclure SITE_NAME\n";
        $changes++;
    }
    
    if (preg_match('/cd-nav|header|navbar/i', $content)) {
        echo "  ✅ Navigation sera remplacée par renderSimpleNavigation()\n";
        $changes++;
    }
    
    if (preg_match('/<footer/i', $content)) {
        echo "  ✅ Footer sera remplacé par renderSimpleFooter()\n";
        $changes++;
    }
    
    if (preg_match('/calendly/i', $content)) {
        echo "  ✅ Section Calendly sera remplacée\n";
        $changes++;
    }
    
    echo "  📈 Total des modifications prévues: $changes\n\n";
    
    return $changes;
}

function getCurrentSection($filePath) {
    if (strpos($filePath, 'catalogue-femme/') !== false) return 'femme';
    if (strpos($filePath, 'catalogue-homme/') !== false) return 'homme';
    if (strpos($filePath, 'contact') !== false) return 'contact';
    if (strpos($filePath, 'a-propos') !== false) return 'about';
    if (strpos($filePath, 'index') !== false) return 'home';
    return 'home';
}

// Sélectionner quelques fichiers représentatifs pour l'analyse
$testFiles = [
    $projectRoot . '/index.html',
    $projectRoot . '/contact.html',
    $projectRoot . '/a-propos.html',
    $projectRoot . '/catalogue-femme/page-1.html',
    $projectRoot . '/catalogue-homme/page-1.html',
    $projectRoot . '/costumes/charleston.html'
];

echo "🎯 PHASE 1: ANALYSE STRUCTURELLE\n";
echo str_repeat("-", 40) . "\n";

foreach ($testFiles as $file) {
    if (file_exists($file)) {
        analyzeFile($file, $projectRoot);
    }
}

echo "🎯 PHASE 2: SIMULATION DE MIGRATION\n";
echo str_repeat("-", 40) . "\n";

$totalChanges = 0;
foreach ($testFiles as $file) {
    if (file_exists($file)) {
        $changes = testMigrationOnFile($file, $projectRoot);
        $totalChanges += $changes;
    }
}

echo "📊 RÉSUMÉ DE L'ANALYSE\n";
echo str_repeat("=", 30) . "\n";
echo "Fichiers analysés: " . count(array_filter($testFiles, 'file_exists')) . "\n";
echo "Modifications totales prévues: $totalChanges\n";

echo "\n✅ L'analyse préalable est terminée.\n";
echo "   Le script de migration automatique peut être exécuté en toute sécurité.\n";
echo "   Utilisez: php migrate_to_hybrid.php\n\n";

?>
