<?php
/**
 * Page Can Can (Exemple d'implémentation PHP)
 */

// Configuration
require_once '../includes/config.php';
require_once '../includes/head.php';
require_once '../includes/navigation.php';
require_once '../includes/components.php';
require_once '../includes/data.php';
require_once '../includes/footer.php';

// Récupération des données du costume
$costume = getCostumeData('cancan');

if (!$costume) {
    // Redirection si costume non trouvé
    header('Location: ../catalogue-femme/page-1.php');
    exit;
}

// Configuration de la page
$pageTitle = $costume['name'] . ' - Location déguisement';
$pageDescription = $costume['description'] . ' - Location à ' . $costume['price'] . '€';
$breadcrumbItems = [
    ['title' => 'Accueil', 'url' => '../index.html'],
    ['title' => 'Catalogue', 'url' => '../catalogue-femme/page-1.html'],
    ['title' => $costume['name']]
];

// Rendu de la page
renderHead(1, $pageTitle, $pageDescription);
?>

<div id="wrap">
  <main>
    <?php renderNavigation(1, 'costume'); ?>

    <!-- BREADCRUMB -->
    <section class="sub-banner parallaxie" style="background: url(../images/bg/bg.webp)">
      <div class="container">
        <div class="position-center-center">
          <h2><?= htmlspecialchars($costume['name']) ?></h2>
          <?php generateBreadcrumb($breadcrumbItems); ?>
        </div>
      </div>
    </section>

    <!-- DÉTAILS PRODUIT -->
    <section class="story-area padding-top-100 padding-bottom-100">
      <div class="container">
        <div class="row">
          
          <!-- Image principale -->
          <div class="col-md-6">
            <div class="product-image">
              <img class="img-responsive" src="<?= $costume['image'] ?>" alt="<?= htmlspecialchars($costume['name']) ?>" loading="lazy" width="500" height="600">
            </div>
          </div>

          <!-- Informations produit -->
          <div class="col-md-6">
            <div class="product-details">
              
              <h1><?= htmlspecialchars($costume['name']) ?></h1>
              
              <!-- Prix -->
              <div class="price-section margin-bottom-30">
                <span class="price"><?= $costume['price'] ?> <small>€</small></span>
              </div>

              <!-- Tags/Catégories -->
              <div class="product-tags margin-bottom-20">
                <?php foreach ($costume['tags'] as $tag): ?>
                  <span class="tag">#<?= htmlspecialchars($tag) ?></span>
                <?php endforeach; ?>
              </div>

              <!-- Informations techniques -->
              <ul class="item-owner margin-bottom-30">
                <li>Taille : <span><?= htmlspecialchars($costume['size']) ?></span></li>
                <li>Accessoires : <span><?= htmlspecialchars($costume['accessories']) ?></span></li>
              </ul>

              <!-- Bouton réservation -->
              <div class="some-info">
                <ul class="row margin-top-30">
                  <li class="col-xs-6">
                    <?php renderReserveButton($costume['name']); ?>
                  </li>
                </ul>

                <!-- Description -->
                <div class="inner-info margin-top-30">
                  <h6>DESCRIPTION</h6>
                  <p><?= nl2br(htmlspecialchars($costume['long_description'])) ?></p>
                </div>

                <!-- Réseaux sociaux -->
                <div class="social-sharing margin-top-30">
                  <h6>PARTAGER</h6>
                  <ul class="social-icons">
                    <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(SITE_URL . '/costumes/cancan.php') ?>" target="_blank"><i class="ion-social-facebook-outline"></i></a></li>
                    <li><a href="https://twitter.com/intent/tweet?text=<?= urlencode($costume['name'] . ' - ' . SITE_NAME) ?>&url=<?= urlencode(SITE_URL . '/costumes/cancan.php') ?>" target="_blank"><i class="ion-social-twitter-outline"></i></a></li>
                    <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                  </ul>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Onglets produit -->
        <div class="item-describe margin-top-50">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs animate fadeInUp" data-wow-delay="0.4s" role="tablist">
            <li role="presentation">
              <a href="#conditions" role="tab" data-toggle="tab">CONDITIONS</a>
            </li>
            <li role="presentation" class="active">
              <a href="#acompte" role="tab" data-toggle="tab">ACOMPTE & CAUTION</a>
            </li>
          </ul>

          <!-- Tab content -->
          <div class="tab-content animate fadeInUp" data-wow-delay="0.4s">
            
            <!-- Conditions -->
            <div role="tabpanel" class="tab-pane fade" id="conditions">
              <h6>Conditions :</h6>
              <ul>
                <li>Réservation obligatoire via notre agenda en ligne</li>
                <li>Essayage gratuit sur rendez-vous</li>
                <li>Durée de location : 3 jours maximum</li>
                <li>Retour dans l'état de départ</li>
                <li>Nettoyage à sec à votre charge si nécessaire</li>
              </ul>
            </div>

            <!-- Acompte & Caution -->
            <div role="tabpanel" class="tab-pane fade in active" id="acompte">
              <h6>Modalités financières :</h6>
              <ul>
                <li>Acompte : 50% à la réservation (<?= $costume['price'] / 2 ?>€)</li>
                <li>Solde : <?= $costume['price'] / 2 ?>€ à la récupération</li>
                <li>Caution : 20€ (restituée au retour en bon état)</li>
                <li>Paiement accepté : Espèces, CB, chèque</li>
              </ul>
            </div>

          </div>
        </div>

        <!-- Costumes similaires -->
        <div class="similar-products margin-top-100">
          <h4 class="text-center margin-bottom-50">Costumes similaires</h4>
          <div class="row">
            <?php
            // Récupération de costumes similaires (même catégorie)
            $similarCostumes = getCostumesByCategory($costume['category'], 1, 4);
            foreach ($similarCostumes['costumes'] as $similar):
              if ($similar['slug'] === 'cancan') continue; // Exclure le costume actuel
            ?>
            <div class="col-md-3">
              <div class="item">
                <div class="item-img">
                  <img class="img-1" src="<?= $similar['image'] ?>" alt="<?= htmlspecialchars($similar['name']) ?>" loading="lazy" width="300" height="300">
                  <div class="overlay">
                    <div class="position-center-center">
                      <div class="inn">
                        <a href="<?= $similar['image'] ?>" data-lighter><i class="icon-magnifier"></i></a>
                        <a href="<?= $similar['slug'] ?>.php"><i class="icon-basket"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="item-name">
                  <a href="<?= $similar['slug'] ?>.php"><?= htmlspecialchars($similar['name']) ?></a>
                </div>
                <span class="price"><?= $similar['price'] ?> <small>€</small></span>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

      </div>
    </section>

    <?php renderCalendlySection(); ?>
    <?php renderGoogleMap(1); ?>

  </main>
</div>

<?php renderFooter(1); ?>
