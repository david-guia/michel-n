<?php
/**
 * Base de données des costumes
 */

/**
 * Retourne les données d'un costume par son slug
 */
function getCostumeData($slug) {
    $costumes = [
        'cancan' => [
            'name' => 'Can Can',
            'price' => 30,
            'size' => 'M-L',
            'accessories' => 'Robe + Coiffe',
            'image' => '../images/catalogue/18image.webp',
            'category' => 'femme',
            'description' => 'Magnifique costume de can-can pour danseuse',
            'long_description' => 'Notre costume robe can-can pour femme est l\'option idéale pour les personnes qui cherchent à se déguiser en danseuse de can-can. Il est fabriqué à partir de matériaux de qualité supérieure pour garantir un confort optimal et une durabilité maximale. Il comprend une robe longue et élégante, avec des jupons amovibles pour créer l\'effet de mouvement caractéristique de la danse can-can.',
            'tags' => ['danse', 'cabaret', 'vintage', 'spectacle']
        ],
        
        'chatelaine' => [
            'name' => 'Châtelaine',
            'price' => 39,
            'size' => 'S-M',
            'accessories' => 'Robe + Coiffe',
            'image' => '../images/index/3image.webp',
            'category' => 'femme',
            'description' => 'Élégant costume de châtelaine médiévale',
            'long_description' => 'Incarnez une noble dame du Moyen Âge avec ce magnifique costume de châtelaine. La robe longue aux manches évasées et la coiffe traditionnelle vous transporteront à l\'époque des châteaux forts et des tournois de chevalerie.',
            'tags' => ['médiéval', 'noble', 'château', 'historique']
        ],
        
        'charleston' => [
            'name' => 'Charleston',
            'price' => 28,
            'size' => 'S-M-L',
            'accessories' => 'Robe + Headband + Collier',
            'image' => '../images/index/6image.webp',
            'category' => 'femme',
            'description' => 'Costume Charleston années 20',
            'long_description' => 'Plongez dans l\'ambiance des années folles avec ce superbe costume Charleston. La robe à franges, le headband avec plume et les accessoires d\'époque vous feront revivre l\'âge d\'or du jazz et de la danse Charleston.',
            'tags' => ['années 20', 'charleston', 'jazz', 'vintage', 'danse']
        ],
        
        'belle-epoque' => [
            'name' => 'Belle Époque',
            'price' => 42,
            'size' => 'M-L',
            'accessories' => 'Robe + Chapeau + Ombrelle',
            'image' => '../images/index/5image.webp',
            'category' => 'femme',
            'description' => 'Élégant costume Belle Époque',
            'long_description' => 'Revivez l\'élégance de la Belle Époque avec ce somptueux costume fin XIXe siècle. La robe longue aux détails raffinés, accompagnée de son chapeau et de son ombrelle, vous fera incarner une dame de la haute société parisienne.',
            'tags' => ['1900', 'élégance', 'paris', 'bourgeoisie', 'raffinement']
        ]
    ];
    
    return isset($costumes[$slug]) ? $costumes[$slug] : null;
}

/**
 * Retourne tous les costumes d'une catégorie
 */
function getCostumesByCategory($category, $page = 1, $limit = 12) {
    // Simulation d'une base de données paginée
    $allCostumes = [
        'femme' => ['cancan', 'chatelaine', 'charleston', 'belle-epoque'],
        'homme' => ['pirate', 'cowboy', 'gentlemen', 'rocknroll'],
    ];
    
    $categoryItems = isset($allCostumes[$category]) ? $allCostumes[$category] : [];
    $offset = ($page - 1) * $limit;
    $pageItems = array_slice($categoryItems, $offset, $limit);
    
    $costumes = [];
    foreach ($pageItems as $slug) {
        $costume = getCostumeData($slug);
        if ($costume) {
            $costume['slug'] = $slug;
            $costumes[] = $costume;
        }
    }
    
    return [
        'costumes' => $costumes,
        'total' => count($categoryItems),
        'pages' => ceil(count($categoryItems) / $limit),
        'current_page' => $page
    ];
}

/**
 * Recherche de costumes
 */
function searchCostumes($query, $category = null) {
    // Implémentation basique de recherche
    // À améliorer avec une vraie base de données
    $results = [];
    
    // Pour l'exemple, retourne quelques résultats
    if (stripos('cancan', $query) !== false) {
        $results[] = getCostumeData('cancan');
    }
    if (stripos('charleston', $query) !== false) {
        $results[] = getCostumeData('charleston');
    }
    
    return $results;
}

/**
 * Génère le breadcrumb pour une page
 */
function generateBreadcrumb($items) {
    echo '<div class="breadcrumb"><ul>';
    foreach ($items as $item) {
        if (isset($item['url'])) {
            echo '<li><a href="' . $item['url'] . '">' . htmlspecialchars($item['title']) . '</a></li>';
        } else {
            echo '<li><a href="#">' . htmlspecialchars($item['title']) . '</a></li>';
        }
    }
    echo '</ul></div>';
}
?>
