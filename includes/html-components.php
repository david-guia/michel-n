<?php
// Composants PHP simples pour inclusion dans HTML
// Usage: <?php include_once 'includes/html-components.php'; ?>

/**
 * Configuration de base
 */
if (!defined('SITE_NAME')) {
    define('SITE_NAME', 'Chouette Déguisement');
    define('CONTACT_ADDRESS', '12 rue Victor Hugo<br>21160 Couchey');
    define('CONTACT_PHONE', '06 52 85 24 29');
    define('CONTACT_EMAIL', 'michel.dj.21@orange.fr');
}

/**
 * Header simplifié pour HTML
 */
function renderSimpleNavigation($currentPage = '', $depth = 0) {
    $basePath = str_repeat('../', $depth);
    $homeUrl = ($depth > 0) ? $basePath . 'index.html' : 'index.html';
    $aboutUrl = ($depth > 0) ? $basePath . 'a-propos.html' : 'a-propos.html';
    $contactUrl = ($depth > 0) ? $basePath . 'contact.html' : 'contact.html';
    
    echo '
    <!-- Navigation Mobile -->
    <div id="cd-nav" class="cd-nav">
      <div class="cd-navigation-wrapper">
        <div class="cd-half-block">
          <div class="cd-nav-trigger"><span class="cd-nav-icon"></span>
            <svg x="0px" y="0px" width="54px" height="54px" viewBox="0 0 54 54">
              <circle fill="transparent" stroke="#2d3a4b" stroke-width="1" cx="27" cy="27" r="25" stroke-dasharray="157 157" stroke-dashoffset="157"></circle>
            </svg>
          </div>
          <!-- Nav -->
          <nav>
            <ul class="cd-primary-nav">
              <li><a href="' . $homeUrl . '">Accueil</a></li>
              <li class="drop-menu">
                <a href="#" class="title collapsed" data-toggle="collapse" data-target="#down-1">Catalogue</a>
                <div class="collapse" id="down-1">
                  <div class="well">
                    <ul>
                      <li><a href="' . $basePath . 'catalogue-femme/page-1.html">Femme</a></li>
                      <li><a href="' . $basePath . 'catalogue-homme/page-1.html">Homme</a></li>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="' . ($currentPage == 'about' ? 'active' : '') . '"><a href="' . $aboutUrl . '">À Propos</a></li>
              <li class="' . ($currentPage == 'contact' ? 'active' : '') . '"><a href="' . $contactUrl . '">Contact</a></li>
            </ul>
          </nav>
        </div>
        <div class="col-sm-7"></div>
      </div>
    </div>

    <!-- Header Desktop -->
    <header>
      <div class="sticky">
        <div class="container">
          <div class="logo logo-center">
            <a href="' . $homeUrl . '"><img class="img-responsive" src="' . $basePath . 'images/logo.webp" width="200" height="200" alt="Image de déguisement proposée par Chouette Déguisement" loading="lazy"></a>
          </div>
          <nav class="navbar ownmenu">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-open-btn" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"><i class="fa fa-navicon"></i></span>
              </button>
            </div>
            <div class="collapse navbar-collapse" id="nav-open-btn">
              <ul class="nav">
                <li class="' . ($currentPage == 'home' ? 'active' : '') . '"><a href="' . $homeUrl . '">Accueil</a></li>
                <li class="dropdown ' . (in_array($currentPage, ['catalogue', 'femme', 'homme']) ? 'active' : '') . '">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catalogue</a>
                  <div class="dropdown-menu">
                    <ul>
                      <li><a href="' . $basePath . 'catalogue-femme/page-1.html">Femme</a></li>
                      <li><a href="' . $basePath . 'catalogue-homme/page-1.html">Homme</a></li>
                    </ul>
                  </div>
                </li>
                <li class="' . ($currentPage == 'about' ? 'active' : '') . '"><a href="' . $aboutUrl . '">À Propos</a></li>
                <li class="' . ($currentPage == 'contact' ? 'active' : '') . '"><a href="' . $contactUrl . '">Contact</a></li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>';
}

/**
 * Header de type catalogue (header-2) avec navigation mobile avancée
 */
function renderCatalogueHeader($currentPage = '', $depth = 0, $pageTitle = 'Catalogue') {
    $basePath = str_repeat('../', $depth);
    $homeUrl = ($depth > 0) ? $basePath . 'index.html' : 'index.html';
    $aboutUrl = ($depth > 0) ? $basePath . 'a-propos.html' : 'a-propos.html';
    $contactUrl = ($depth > 0) ? $basePath . 'contact.html' : 'contact.html';
    
    echo '
    <!-- Navigation Mobile Catalogue -->
    <div id="cd-nav" class="cd-nav">
      <div class="cd-navigation-wrapper">
        <div class="cd-half-block">
          <h2>' . SITE_NAME . '</h2>
          <p>' . CONTACT_ADDRESS . '</p>
          <p>' . CONTACT_PHONE . '</p>
          <nav>
            <ul class="cd-primary-nav">
              <li><a href="' . $homeUrl . '">Accueil</a></li>
              <li class="drop-menu">
                <a href="#" class="title collapsed" data-toggle="collapse" data-target="#down-1">Catalogue</a>
                <div class="collapse" id="down-1">
                  <div class="well">
                    <ul>
                      <li><a href="' . $basePath . 'catalogue-femme/page-1.html">FEMME</a></li>
                      <li><a href="' . $basePath . 'catalogue-homme/page-1.html">HOMME</a></li>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="' . ($currentPage == 'about' ? 'active' : '') . '"><a href="' . $aboutUrl . '">À Propos</a></li>
              <li class="' . ($currentPage == 'contact' ? 'active' : '') . '"><a href="' . $contactUrl . '">Contact</a></li>
            </ul>
          </nav>
          <div class="cd-footer">
            <p>Suivez-nous sur <a href="#."><i class="icon-social-facebook"></i></a></p>
          </div>
        </div>
        <div class="col-sm-7"></div>
      </div>
    </div>

    <!-- Header Catalogue -->
    <header class="header-2">
      <div class="container-fluid ">
        <div class="sticky">
          <a href="#cd-nav" class="cd-nav-trigger">
            <span class="cd-nav-icon"></span>
            <svg x="0px" y="0px" width="54px" height="54px" viewBox="0 0 54 54">
              <circle fill="transparent" stroke="#2d3a4b" stroke-width="1" cx="27" cy="27" r="25" stroke-dasharray="157 157" stroke-dashoffset="157"></circle>
            </svg>
          </a>
          <div class="logo logo-center">
            <a href="' . $homeUrl . '"><img class="img-responsive" src="' . $basePath . 'images/logo.webp" width="200" height="200" alt="Logo Chouette Déguisement" loading="lazy"></a>
          </div>
          <nav class="navbar">
            <!-- Nav Right -->
          </nav>
        </div>
      </div>
    </header>';
}

/**
 * Footer simplifié pour HTML
 */
function renderSimpleFooter($depth = 0) {
    $basePath = str_repeat('../', $depth);
    
    echo '
  <!-- FOOTER -->
  <footer class="padding-top-100 padding-bottom-50">
    <div class="container">
      <div class="row">
        <!-- ABOUT STORE -->
        <div class="col-md-3">
          <img class="margin-bottom-30" src="' . $basePath . 'images/apple-touch-icon.webp" alt="' . SITE_NAME . '" loading="lazy" width="200" height="200" />
          <p>
            Location de déguisement simple, rapide et abordable dans votre région. 
            Faites votre réservation en ligne, venez essayer et partez avec votre costume !
          </p>
        </div>

        <!-- INFORMATION -->
        <div class="col-md-3">
          <h6>' . SITE_NAME . '</h6>
          <p>Micro-entreprise hébergée à domicile</p>
          <p>
            <i class="icon-pointer"></i> ' . CONTACT_ADDRESS . '
          </p>
          <p><i class="icon-call-end"></i> ' . CONTACT_PHONE . '</p>
          <p><i class="icon-envelope"></i> ' . CONTACT_EMAIL . '</p>
        </div>

        <!-- CGU & CGV -->
        <div class="col-md-3">
          <h6>CGU & CGV</h6>
          <ul class="link">
            <li><a href="' . $basePath . 'termes-et-conditions-generales.pdf" target="_blank">Lire les Termes & Conditions Générales</a></li>
            <li><a href="' . $basePath . 'CONDITIONS-GENERALES-DE-VENTES.pdf" target="_blank">Lire les Conditions Générales de Ventes</a></li>
          </ul>
        </div>

        <!-- RECHERCHES -->
        <div class="col-md-3">
          <h6>RECHERCHES</h6>
          <ul class="link">
            <li>
              <div class="gcse-search"></div>
            </li>
          </ul>
        </div>
      </div>

      <!-- Rights -->
      <div class="rights">
        <p>2022 ' . SITE_NAME . ' - made with ♥️ by <a href="https://www.davidguia.me" style="color: #d0331b7a">David Guia.</a></p>
        <div class="scroll">
          <a href="#wrap" class="go-up"><i class="lnr lnr-arrow-up"></i></a>
        </div>
      </div>
    </div>
  </footer>';
}

/**
 * Section Calendly simple
 */
function renderSimpleCalendlySection() {
    echo '
    <!-- SECTION RÉSERVATION -->
    <section class="news-letter style-2 padding-top-150 padding-bottom-150">
      <div class="container">
        <div class="heading light-head text-center margin-bottom-30">
          <h4>RÉSERVER UN ESSAYAGE</h4>
          <span>Avec notre agenda en ligne, n\'hésitez pas à réserver votre essayage.</span>
        </div>
        <form>
          <center>
            <button type="button">
              <a href="javascript:void(0)" onclick="Calendly.initPopupWidget({url: \'https://calendly.com/chouette-deguisement/reservation-costumes\'});return false;">ALLONS-Y</a>
            </button>
          </center>
        </form>
      </div>
    </section>';
}

/**
 * Google Maps simple
 */
function renderSimpleGoogleMap() {
    echo '
    <!-- GOOGLE MAP -->
    <div id="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2707.7400373803503!2d4.972244576993912!3d47.26078647116014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f29b5fb1685e27%3A0x455ddae38c2ef1f4!2s12%20Rue%20Victor%20Hugo%2C%2021160%20Couchey!5e0!3m2!1sfr!2sfr!4v1725480192747!5m2!1sfr!2sfr" 
              width="100%" height="530" style="border:0;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>';
}

/**
 * Bouton de réservation simple
 */
function renderSimpleReserveButton() {
    echo '<a href="javascript:void(0)" class="btn" onclick="Calendly.initPopupWidget({url: \'https://calendly.com/chouette-deguisement/reservation-costumes?hide_gdpr_banner=1\'});return false;">RÉSERVER</a>';
}
?>
