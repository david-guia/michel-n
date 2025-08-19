<?php
/**
 * Footer du site
 * @param int $depth Niveau de profondeur
 */
function renderFooter($depth = 0) {
    $basePath = getBasePath($depth);
    
    echo "
  <!-- FOOTER -->
  <footer class=\"padding-top-100 padding-bottom-50\">
    <div class=\"container\">
      <div class=\"row\">
        <!-- ABOUT STORE -->
        <div class=\"col-md-3\">
          <img class=\"margin-bottom-30\" src=\"{$basePath}images/apple-touch-icon.webp\" alt=\"" . SITE_NAME . "\" loading=\"lazy\" width=\"100\" height=\"100\" />
          <p>
            Location de déguisement simple, rapide et abordable dans votre région. 
            Faites votre réservation en ligne, venez essayer et partez avec votre costume !
          </p>
        </div>

        <!-- INFORMATION -->
        <div class=\"col-md-3\">
          <h6>" . SITE_NAME . "</h6>
          <p>Micro-entreprise hébergée à domicile</p>
          <p>
            <i class=\"icon-pointer\"></i> " . CONTACT_ADDRESS . "
          </p>
          <p><i class=\"icon-call-end\"></i> " . CONTACT_PHONE . "</p>
          <p><i class=\"icon-envelope\"></i> " . CONTACT_EMAIL . "</p>
        </div>

        <!-- CGU & CGV -->
        <div class=\"col-md-3\">
          <h6>CGU & CGV</h6>
          <ul class=\"link\">
            <li><a href=\"{$basePath}termes-et-conditions-generales.pdf\" target=\"_blank\">Lire les Termes & Conditions Générales</a></li>
            <li><a href=\"{$basePath}CONDITIONS-GENERALES-DE-VENTES.pdf\" target=\"_blank\">Lire les Conditions Générales de Ventes</a></li>
          </ul>
        </div>

        <!-- RECHERCHES -->
        <div class=\"col-md-3\">
          <h6>RECHERCHES</h6>
          <ul class=\"link\">
            <li>
              <div class=\"gcse-search\"></div>
            </li>
          </ul>
        </div>
      </div>

      <!-- Rights -->
      <div class=\"rights\">
        <p>2022 " . SITE_NAME . " - made with ♥️ by <a href=\"https://www.davidguia.me\" style=\"color: #d0331b7a\">David Guia.</a></p>
        <div class=\"scroll\">
          <a href=\"#wrap\" class=\"go-up\"><i class=\"lnr lnr-arrow-up\"></i></a>
        </div>
      </div>
    </div>
  </footer>
</main>
</div>
</body>
</html>";
}
?>
