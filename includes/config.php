<?php
/**
 * Configuration générale du site
 */

// Informations du site
define('SITE_NAME', 'Chouette Déguisement');
define('SITE_DESCRIPTION', 'Votre site de déguisement simple, rapide et abordable sur la région Dijonnaise. Faites votre réservation en ligne, venez essayer et partez avec votre costume !');
define('SITE_URL', 'https://chouette-deguisement.fr');
define('SITE_IMAGE', 'http://res.cloudinary.com/dpu5ywrox/image/upload/v1665473791/cmguwyzowjcevrioxmkr.jpg');

// Contact
define('CONTACT_ADDRESS', '12 rue Victor Hugo<br>21160 Couchey');
define('CONTACT_PHONE', '06 52 85 24 29');
define('CONTACT_EMAIL', 'michel.dj.21@orange.fr');

// Analytics
define('PANELBEAR_SITE_ID', '60hirGmzfQY');
define('GOOGLE_CSE_ID', '646335a5355714c19');

// Calendly
define('CALENDLY_URL', 'https://calendly.com/chouette-deguisement/reservation-costumes');

/**
 * Génère le chemin relatif en fonction du niveau de profondeur
 */
function getBasePath($depth = 0) {
    return str_repeat('../', $depth);
}

/**
 * Génère les méta tags de base
 */
function generateMetaTags($title = null, $description = null, $path = '') {
    $pageTitle = $title ? $title . ' - ' . SITE_NAME : SITE_NAME . ' - Dijon';
    $pageDescription = $description ?: SITE_DESCRIPTION;
    
    return "
    <meta charset=\"utf-8\" />
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />
    <meta name=\"title\" content=\"$pageTitle\" />
    <meta name=\"description\" content=\"$pageDescription\" />
    <meta name=\"copyright\" content=\"" . SITE_NAME . "\" />
    <meta name=\"keywords\" content=\"Déguisement Dijon rapide abordable\" />
    <link rel=\"shortcut icon\" href=\"{$path}favicon.ico\" type=\"image/x-icon\">
    <link rel=\"icon\" href=\"{$path}favicon.ico\" type=\"image/x-icon\">
    <meta property=\"og:type\" content=\"website\" />
    <meta property=\"og:url\" content=\"" . SITE_URL . "\" />
    <meta property=\"og:title\" content=\"$pageTitle\" />
    <meta property=\"og:description\" content=\"$pageDescription\" />
    <meta property=\"og:image\" content=\"" . SITE_IMAGE . "\" />
    <meta property=\"twitter:card\" content=\"summary_large_image\" />
    <meta property=\"twitter:url\" content=\"" . SITE_URL . "\" />
    <meta property=\"twitter:title\" content=\"$pageTitle\" />
    <meta property=\"twitter:description\" content=\"$pageDescription\" />
    <meta property=\"twitter:image\" content=\"" . SITE_IMAGE . "\" />
    <title>$pageTitle</title>";
}
?>
