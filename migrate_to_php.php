<?php
/**
 * Script de migration HTML vers PHP
 * Convertit automatiquement les pages HTML en utilisant la structure PHP modulaire
 */

class HtmlToPhpMigrator {
    
    private $basePath;
    private $includesPath;
    
    public function __construct($basePath = '.') {
        $this->basePath = rtrim($basePath, '/');
        $this->includesPath = $this->basePath . '/includes';
    }
    
    /**
     * Migre un fichier HTML vers PHP
     */
    public function migrateFile($htmlFile, $outputFile = null, $options = []) {
        if (!file_exists($htmlFile)) {
            throw new Exception("Fichier HTML non trouvé : $htmlFile");
        }
        
        $content = file_get_contents($htmlFile);
        $pathInfo = pathinfo($htmlFile);
        
        // Options par défaut
        $options = array_merge([
            'depth' => $this->calculateDepth($htmlFile),
            'pageType' => $this->detectPageType($htmlFile),
            'title' => $this->extractTitle($content),
            'description' => $this->extractDescription($content)
        ], $options);
        
        // Fichier de sortie par défaut
        if (!$outputFile) {
            $outputFile = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.php';
        }
        
        // Génération du PHP
        $phpContent = $this->convertToPhp($content, $options);
        
        // Sauvegarde
        file_put_contents($outputFile, $phpContent);
        
        return $outputFile;
    }
    
    /**
     * Calcule la profondeur du fichier par rapport à la racine
     */
    private function calculateDepth($filePath) {
        $relativePath = str_replace($this->basePath . '/', '', $filePath);
        return substr_count($relativePath, '/');
    }
    
    /**
     * Détecte le type de page
     */
    private function detectPageType($filePath) {
        if (strpos($filePath, 'catalogue-femme') !== false) return 'femme';
        if (strpos($filePath, 'catalogue-homme') !== false) return 'homme';
        if (strpos($filePath, 'costumes') !== false) return 'costume';
        if (strpos($filePath, 'contact') !== false) return 'contact';
        if (strpos($filePath, 'a-propos') !== false) return 'about';
        if (strpos($filePath, 'index') !== false) return 'home';
        return '';
    }
    
    /**
     * Extrait le titre de la page
     */
    private function extractTitle($content) {
        if (preg_match('/<title>([^<]+)<\/title>/', $content, $matches)) {
            return trim($matches[1]);
        }
        return null;
    }
    
    /**
     * Extrait la description META
     */
    private function extractDescription($content) {
        if (preg_match('/<meta name="description"[^>]*content="([^"]*)"/', $content, $matches)) {
            return trim($matches[1]);
        }
        return null;
    }
    
    /**
     * Convertit le HTML en PHP
     */
    private function convertToPhp($content, $options) {
        // Extraction du contenu principal
        $mainContent = $this->extractMainContent($content);
        
        // Génération du code PHP
        $depth = $options['depth'];
        $pageType = $options['pageType'];
        $title = $options['title'];
        $description = $options['description'];
        
        $phpCode = "<?php\n";
        $phpCode .= "/**\n";
        $phpCode .= " * Page générée automatiquement depuis HTML\n";
        $phpCode .= " * Migration effectuée le " . date('Y-m-d H:i:s') . "\n";
        $phpCode .= " */\n\n";
        
        // Includes
        $phpCode .= "// Configuration\n";
        $phpCode .= "require_once '" . str_repeat('../', $depth) . "includes/config.php';\n";
        $phpCode .= "require_once '" . str_repeat('../', $depth) . "includes/head.php';\n";
        $phpCode .= "require_once '" . str_repeat('../', $depth) . "includes/navigation.php';\n";
        $phpCode .= "require_once '" . str_repeat('../', $depth) . "includes/components.php';\n";
        
        if ($pageType === 'costume') {
            $phpCode .= "require_once '" . str_repeat('../', $depth) . "includes/data.php';\n";
        }
        
        $phpCode .= "require_once '" . str_repeat('../', $depth) . "includes/footer.php';\n\n";
        
        // Configuration de la page
        if ($title) {
            $phpCode .= "// Configuration de la page\n";
            $phpCode .= "\$pageTitle = '" . addslashes($title) . "';\n";
        }
        if ($description) {
            $phpCode .= "\$pageDescription = '" . addslashes($description) . "';\n";
        }
        $phpCode .= "\n";
        
        // Rendu de la page
        $phpCode .= "// Rendu de la page\n";
        $phpCode .= "renderHead($depth";
        if ($title) $phpCode .= ", \$pageTitle";
        if ($description) $phpCode .= ", \$pageDescription";
        $phpCode .= ");\n";
        $phpCode .= "?>\n\n";
        
        // Structure HTML
        $phpCode .= "<div id=\"wrap\">\n";
        $phpCode .= "  <main>\n";
        $phpCode .= "    <?php renderNavigation($depth, '$pageType'); ?>\n\n";
        
        // Contenu principal
        $phpCode .= $mainContent . "\n";
        
        // Composants de fin
        $phpCode .= "    <?php renderCalendlySection(); ?>\n";
        $phpCode .= "    <?php renderGoogleMap($depth); ?>\n\n";
        
        $phpCode .= "  </main>\n";
        $phpCode .= "</div>\n\n";
        
        // Footer
        $phpCode .= "<?php renderFooter($depth); ?>";
        
        return $phpCode;
    }
    
    /**
     * Extrait le contenu principal entre <main> et </main>
     */
    private function extractMainContent($content) {
        // Recherche du contenu entre <main> et </main>
        if (preg_match('/<main[^>]*>(.*?)<\/main>/s', $content, $matches)) {
            $mainContent = $matches[1];
        } else {
            // Si pas de balise main, prendre le body sans header/footer
            $mainContent = $this->extractBodyContent($content);
        }
        
        // Nettoyage du contenu
        $mainContent = $this->cleanContent($mainContent);
        
        return $mainContent;
    }
    
    /**
     * Extrait le contenu du body en excluant header/footer
     */
    private function extractBodyContent($content) {
        // Logique simple : prendre ce qui est après le header et avant le footer
        // À adapter selon la structure spécifique du site
        
        // Supprimer les scripts en fin de page
        $content = preg_replace('/<script[^>]*>.*?<\/script>/s', '', $content);
        
        // Supprimer le footer
        $content = preg_replace('/<footer[^>]*>.*?<\/footer>/s', '', $content);
        
        return $content;
    }
    
    /**
     * Nettoie le contenu
     */
    private function cleanContent($content) {
        // Supprimer les éléments de navigation existants
        $content = preg_replace('/<header[^>]*>.*?<\/header>/s', '', $content);
        $content = preg_replace('/<nav[^>]*>.*?<\/nav>/s', '', $content);
        
        // Supprimer les sections Calendly et Google Maps (remplacées par les composants PHP)
        $content = preg_replace('/<section[^>]*news-letter[^>]*>.*?<\/section>/s', '', $content);
        $content = preg_replace('/<div[^>]*id="map"[^>]*>.*?<\/div>/s', '', $content);
        
        // Nettoyer les espaces multiples
        $content = preg_replace('/\n\s*\n/', "\n\n", $content);
        $content = trim($content);
        
        return $content;
    }
    
    /**
     * Migre un dossier entier
     */
    public function migrateFolder($folderPath, $pattern = '*.html') {
        $files = glob($folderPath . '/' . $pattern);
        $migrated = [];
        
        foreach ($files as $file) {
            try {
                $outputFile = $this->migrateFile($file);
                $migrated[] = $outputFile;
                echo "✅ Migré: " . basename($file) . " → " . basename($outputFile) . "\n";
            } catch (Exception $e) {
                echo "❌ Erreur sur " . basename($file) . ": " . $e->getMessage() . "\n";
            }
        }
        
        return $migrated;
    }
}

// Exemple d'utilisation du script
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    echo "🔄 Migration HTML vers PHP\n";
    echo "========================\n\n";
    
    try {
        $migrator = new HtmlToPhpMigrator(__DIR__);
        
        // Migration d'un fichier spécifique
        // $migrator->migrateFile('catalogue-femme/page-1.html');
        
        // Migration d'un dossier entier
        // $migrator->migrateFolder('catalogue-femme');
        
        echo "\n✅ Migration terminée !\n";
        echo "\nConsultez le fichier PHP_STRUCTURE_README.md pour les instructions d'utilisation.\n";
        
    } catch (Exception $e) {
        echo "❌ Erreur : " . $e->getMessage() . "\n";
    }
}
?>
