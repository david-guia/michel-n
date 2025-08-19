<?php
/**
 * Section Calendly réservation
 */
function renderCalendlySection() {
    echo "
    <!-- SECTION RÉSERVATION -->
    <section class=\"news-letter style-2 padding-top-150 padding-bottom-150\">
      <div class=\"container\">
        <div class=\"heading light-head text-center margin-bottom-30\">
          <h4>RÉSERVER UN ESSAYAGE</h4>
          <span>Avec notre agenda en ligne, n'hésitez pas à réserver votre essayage.</span>
        </div>
        <form>
          <center>
            <button type=\"button\">
              <a href=\"javascript:void(0)\" onclick=\"Calendly.initPopupWidget({url: '" . CALENDLY_URL . "'});return false;\">ALLONS-Y</a>
            </button>
          </center>
        </form>
      </div>
    </section>";
}

/**
 * Carte Google Maps
 * @param int $depth Niveau de profondeur
 */
function renderGoogleMap($depth = 0) {
    echo "
    <!-- GOOGLE MAP -->
    <div id=\"map\">
      <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2707.7400373803503!2d4.972244576993912!3d47.26078647116014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f29b5fb1685e27%3A0x455ddae38c2ef1f4!2s12%20Rue%20Victor%20Hugo%2C%2021160%20Couchey!5e0!3m2!1sfr!2sfr!4v1725480192747!5m2!1sfr!2sfr\" 
              width=\"100%\" height=\"530\" style=\"border:0;\" allowfullscreen=\"true\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\">
      </iframe>
    </div>";
}

/**
 * Bouton de réservation pour produits
 * @param string $productName Nom du produit pour le tracking
 */
function renderReserveButton($productName = '') {
    echo "
    <a href=\"javascript:void(0)\" class=\"btn\" onclick=\"Calendly.initPopupWidget({url: '" . CALENDLY_URL . "?hide_gdpr_banner=1'});return false;\">
      RÉSERVER
    </a>";
}

/**
 * Pagination pour catalogues
 * @param int $currentPage Page courante
 * @param int $totalPages Total des pages
 * @param string $baseUrl URL de base pour les pages
 */
function renderPagination($currentPage, $totalPages, $baseUrl = 'page-') {
    if ($totalPages <= 1) return;
    
    echo "<div class=\"pagination-wrapper text-center margin-top-50\">";
    echo "<nav class=\"pagination\">";
    
    // Page précédente
    if ($currentPage > 1) {
        $prevPage = ($currentPage - 1 == 1) ? $baseUrl . '1.html' : $baseUrl . ($currentPage - 1) . '.html';
        echo "<a href=\"$prevPage\" class=\"prev\">‹ Précédent</a>";
    }
    
    // Numéros de pages
    for ($i = 1; $i <= $totalPages; $i++) {
        $pageUrl = $baseUrl . $i . '.html';
        $activeClass = ($i == $currentPage) ? ' class="active"' : '';
        echo "<a href=\"$pageUrl\"$activeClass>$i</a>";
    }
    
    // Page suivante
    if ($currentPage < $totalPages) {
        $nextPage = $baseUrl . ($currentPage + 1) . '.html';
        echo "<a href=\"$nextPage\" class=\"next\">Suivant ›</a>";
    }
    
    echo "</nav>";
    echo "</div>";
}
?>
