<?php
/**
 * Navigation principale du site
 * @param int $depth Niveau de profondeur
 * @param string $currentPage Page actuelle pour highlighting
 */
function renderNavigation($depth = 0, $currentPage = '') {
    $basePath = getBasePath($depth);
    $homeUrl = ($depth > 0) ? $basePath . 'index.html' : './index.html';
    $aboutUrl = ($depth > 0) ? $basePath . 'a-propos.html' : './a-propos.html';
    $contactUrl = ($depth > 0) ? $basePath . 'contact.html' : './contact.html';
    
    echo "
    <!-- Navigation Mobile -->
    <div id=\"cd-nav\" class=\"cd-nav\">
      <div class=\"cd-navigation-wrapper\">
        <div class=\"cd-half-block\">
          <div class=\"cd-nav-trigger\"><span class=\"cd-nav-icon\"></span>
            <svg x=\"0px\" y=\"0px\" width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\">
              <circle fill=\"transparent\" stroke=\"#2d3a4b\" stroke-width=\"1\" cx=\"27\" cy=\"27\" r=\"25\" stroke-dasharray=\"157 157\" stroke-dashoffset=\"157\"></circle>
            </svg>
          </div>
          <!-- Nav -->
          <nav>
            <ul class=\"cd-primary-nav\">
              <li><a href=\"$homeUrl\">Accueil</a></li>
              <li class=\"drop-menu\">
                <a href=\"#\" class=\"title collapsed\" data-toggle=\"collapse\" data-target=\"#down-1\">Catalogue</a>
                <div class=\"collapse\" id=\"down-1\">
                  <div class=\"well\">
                    <ul>
                      <li><a href=\"{$basePath}catalogue-femme/page-1.html\">Femme</a></li>
                      <li><a href=\"{$basePath}catalogue-homme/page-1.html\">Homme</a></li>
                    </ul>
                  </div>
                </div>
              </li>
              <li class=\"" . ($currentPage == 'about' ? 'active' : '') . "\"><a href=\"$aboutUrl\">À Propos</a></li>
              <li class=\"" . ($currentPage == 'contact' ? 'active' : '') . "\"><a href=\"$contactUrl\">Contact</a></li>
            </ul>
          </nav>
        </div>
        <!-- Right Section -->
        <div class=\"col-sm-7\"></div>
      </div>
    </div>

    <!-- Header Desktop -->
    <header>
      <div class=\"sticky\">
        <div class=\"container\">
          <!-- Logo -->
          <div class=\"logo logo-center\">
            <a href=\"$homeUrl\"><img class=\"img-responsive\" src=\"{$basePath}images/logo.webp\" width=\"200\" height=\"200\" alt=\"Image de déguisement proposée par Chouette Déguisement\" loading=\"lazy\"></a>
          </div>
          <nav class=\"navbar ownmenu\">
            <div class=\"navbar-header\">
              <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#nav-open-btn\" aria-expanded=\"false\">
                <span class=\"sr-only\">Toggle navigation</span>
                <span class=\"icon-bar\"><i class=\"fa fa-navicon\"></i></span>
              </button>
            </div>

            <!-- NAV -->
            <div class=\"collapse navbar-collapse\" id=\"nav-open-btn\">
              <ul class=\"nav\">
                <li class=\"" . ($currentPage == 'home' ? 'active' : '') . "\"><a href=\"$homeUrl\">Accueil</a></li>
                <li class=\"dropdown " . (in_array($currentPage, ['catalogue', 'femme', 'homme']) ? 'active' : '') . "\">
                  <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Catalogue</a>
                  <div class=\"dropdown-menu\">
                    <ul>
                      <li><a href=\"{$basePath}catalogue-femme/page-1.html\">Femme</a></li>
                      <li><a href=\"{$basePath}catalogue-homme/page-1.html\">Homme</a></li>
                    </ul>
                  </div>
                </li>
                <li class=\"" . ($currentPage == 'about' ? 'active' : '') . "\"><a href=\"$aboutUrl\">À Propos</a></li>
                <li class=\"" . ($currentPage == 'contact' ? 'active' : '') . "\"><a href=\"$contactUrl\">Contact</a></li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>";
}
?>
