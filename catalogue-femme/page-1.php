<?php
/**
 * Catalogue Femme - Page 1 (Version PHP)
 */

// Configuration
require_once '../includes/config.php';
require_once '../includes/head.php';
require_once '../includes/navigation.php';
require_once '../includes/components.php';
require_once '../includes/footer.php';

// Paramètres de la page
$currentPage = 'femme';
$pageTitle = 'Catalogue Femme - Page 1';
$pageDescription = 'Découvrez notre collection de déguisements pour femme : robes d\'époque, costumes de fête, déguisements thématiques.';

// Configuration pagination
$currentPageNum = 1;
$totalPages = 8;

// Produits de la page (exemple avec quelques produits)
$products = [
    [
        'id' => 1,
        'name' => 'Châtelaine',
        'price' => 39,
        'image' => '../images/index/3image.webp',
        'url' => '../costumes/chatelaine.html'
    ],
    [
        'id' => 2,
        'name' => 'Robe 1900',
        'price' => 35,
        'image' => '../images/index/4image.webp',
        'url' => '../costumes/robe-1900.html'
    ],
    [
        'id' => 3,
        'name' => 'Belle Époque',
        'price' => 42,
        'image' => '../images/index/5image.webp',
        'url' => '../costumes/belle-epoque.html'
    ],
    [
        'id' => 4,
        'name' => 'Charleston',
        'price' => 28,
        'image' => '../images/index/6image.webp',
        'url' => '../costumes/charleston.html'
    ]
];

// Rendu de la page
renderHead(1, $pageTitle, $pageDescription);
?>

<div id="wrap">
  <main>
    <?php renderNavigation(1, $currentPage); ?>

    <!-- CATALOGUE HEADER -->
    <section class="sub-banner parallaxie" style="background: url(../images/bg/bg.webp)">
      <div class="container">
        <div class="position-center-center">
          <h2>Catalogue Femme</h2>
          <div class="breadcrumb">
            <ul>
              <li><a href="../index.html">Accueil</a></li>
              <li><a href="#">Catalogue</a></li>
              <li><a href="#">Femme</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- CATALOGUE CONTENT -->
    <section class="story-area padding-top-100 padding-bottom-100">
      <div class="container">
        
        <!-- Filtres et tri -->
        <div class="row margin-bottom-50">
          <div class="col-md-6">
            <h4>Collection Femme</h4>
            <p>Découvrez notre sélection de déguisements pour femme</p>
          </div>
          <div class="col-md-6 text-right">
            <select class="form-control" style="width: 200px; display: inline-block;">
              <option>Trier par popularité</option>
              <option>Trier par prix croissant</option>
              <option>Trier par prix décroissant</option>
              <option>Trier par nouveauté</option>
            </select>
          </div>
        </div>

        <!-- Grille de produits -->
        <div class="row">
          <?php foreach ($products as $product): ?>
          <div class="col-md-3 margin-bottom-30">
            <div class="item">
              <!-- Image produit -->
              <div class="item-img">
                <img class="img-1" src="<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" loading="lazy" width="300" height="300">
                <!-- Overlay -->
                <div class="overlay">
                  <div class="position-center-center">
                    <div class="inn">
                      <a href="<?= $product['image'] ?>" data-lighter><i class="icon-magnifier"></i></a>
                      <a href="<?= $product['url'] ?>"><i class="icon-basket"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Nom du produit -->
              <div class="item-name">
                <a href="<?= $product['url'] ?>"><?= htmlspecialchars($product['name']) ?></a>
              </div>
              <!-- Prix -->
              <span class="price"><?= $product['price'] ?> <small>€</small></span>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php renderPagination($currentPageNum, $totalPages, 'page-'); ?>

      </div>
    </section>

    <?php renderCalendlySection(); ?>
    <?php renderGoogleMap(1); ?>

  </main>
</div>

<?php renderFooter(1); ?>
