<?php
/**
 * Page de costume individuel (Template PHP)
 */

// Configuration
require_once '../includes/config.php';
require_once '../includes/head.php';
require_once '../includes/navigation.php';
require_once '../includes/components.php';
require_once '../includes/footer.php';

/**
 * Fonction pour afficher une page de costume
 * @param array $costume Données du costume
 */
function renderCostumePage($costume) {
    renderHead(1, $costume['name'], $costume['description']);
    ?>

    <div id="wrap">
      <main>
        <?php renderNavigation(1, 'costume'); ?>

        <!-- BREADCRUMB -->
        <section class="sub-banner parallaxie" style="background: url(../images/bg/bg.webp)">
          <div class="container">
            <div class="position-center-center">
              <h2><?= htmlspecialchars($costume['name']) ?></h2>
              <div class="breadcrumb">
                <ul>
                  <li><a href="../index.html">Accueil</a></li>
                  <li><a href="../catalogue-femme/page-1.html">Catalogue</a></li>
                  <li><a href="#"><?= htmlspecialchars($costume['name']) ?></a></li>
                </ul>
              </div>
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
                        <li><a href="#"><i class="ion-social-facebook-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-twitter-outline"></i></a></li>
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
                    <li>Réservation obligatoire</li>
                    <li>Essayage gratuit sur rendez-vous</li>
                    <li>Durée de location : 3 jours maximum</li>
                    <li>Retour dans l'état de départ</li>
                  </ul>
                </div>

                <!-- Acompte & Caution -->
                <div role="tabpanel" class="tab-pane fade in active" id="acompte">
                  <h6>Modalités financières :</h6>
                  <ul>
                    <li>Acompte : 50% à la réservation</li>
                    <li>Solde : à la récupération</li>
                    <li>Caution : 20€ (restituée au retour)</li>
                    <li>Paiement : Espèces, CB, chèque</li>
                  </ul>
                </div>

              </div>
            </div>

          </div>
        </section>

        <?php renderCalendlySection(); ?>
        <?php renderGoogleMap(1); ?>

      </main>
    </div>

    <?php renderFooter(1); ?>
    
    <?php
}

// Exemple d'utilisation (à adapter selon vos données)
$costume = [
    'name' => 'Can Can',
    'price' => 30,
    'size' => 'M-L',
    'accessories' => 'Robe + Coiffe',
    'image' => '../images/catalogue/18image.webp',
    'description' => 'Magnifique costume de can-can pour femme',
    'long_description' => 'Notre costume robe can-can pour femme est l\'option idéale pour les personnes qui cherchent à se déguiser en danseuse de can-can. Il est fabriqué à partir de matériaux de qualité supérieure pour garantir un confort optimal et une durabilité maximale. Il comprend une robe longue et élégante, avec des jupons amovibles pour créer l\'effet de mouvement caractéristique de la danse can-can.'
];

// Rendu de la page (décommentez pour tester)
// renderCostumePage($costume);
?>
