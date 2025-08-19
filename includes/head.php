<?php
/**
 * Header HTML avec CSS et scripts optimisés
 * @param int $depth Niveau de profondeur (0 = racine, 1 = sous-dossier, etc.)
 * @param string $title Titre de la page
 * @param string $description Description de la page
 */
function renderHead($depth = 0, $title = null, $description = null) {
    $basePath = getBasePath($depth);
    $metaTags = generateMetaTags($title, $description, ($depth > 0 ? $basePath : ''));
    
    echo "<!DOCTYPE html>
<html lang=\"fr\">
<head>
$metaTags

  <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
  <link rel=\"stylesheet\" type=\"text/css\" href=\"{$basePath}rs-plugin/css/settings.css\" media=\"screen\" />

  <!-- Bootstrap Core CSS -->
  <link href=\"{$basePath}css/bootstrap.min.css\" rel=\"stylesheet\" />

  <!-- Custom CSS -->
  <link href=\"{$basePath}css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\" />
  <link href=\"{$basePath}css/ionicons.min.css\" rel=\"stylesheet\" />
  <link href=\"{$basePath}css/main.css\" rel=\"stylesheet\" />
  <link href=\"{$basePath}css/style.css\" rel=\"stylesheet\" />
  <link href=\"{$basePath}css/responsive.css\" rel=\"stylesheet\" />
  <link href=\"https://assets.calendly.com/assets/external/widget.css\" rel=\"stylesheet\" media=\"print\" onload=\"this.media='all'\">

  <!-- Online Fonts (optimisé : Montserrat seulement) -->
  <link href=\"https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap\" rel=\"stylesheet\" type=\"text/css\" />

  <!-- JavaScripts -->
  <script src=\"{$basePath}js/modernizr.js\" defer></script>
  <script src=\"{$basePath}js/jquery-1.11.3.min.js\" defer></script>
  <script src=\"{$basePath}js/bootstrap.min.js\" defer></script>
  <script src=\"{$basePath}js/own-menu.js\" defer></script>
  <script src=\"{$basePath}js/jquery.lighter.js\" defer></script>
  <script src=\"{$basePath}js/owl.carousel.min.js\" defer></script>
  <script type=\"text/javascript\" src=\"{$basePath}rs-plugin/js/jquery.tp.t.min.js\" defer></script>
  <script type=\"text/javascript\" src=\"{$basePath}rs-plugin/js/jquery.tp.min.js\" defer></script>
  <script src=\"{$basePath}js/main.js\" defer></script>

  <!-- Calendly script -->
  <script src=\"https://assets.calendly.com/assets/external/widget.js\" type=\"text/javascript\" async defer></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\" defer></script>
      <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\" defer></script>
  <![endif]-->

  <!-- Analytics -->
  <script async src=\"https://cdn.panelbear.com/analytics.js?site=" . PANELBEAR_SITE_ID . "\"></script>
  <script>
    window.panelbear = window.panelbear || function () { (window.panelbear.q = window.panelbear.q || []).push(arguments); };
    panelbear('config', { site: '" . PANELBEAR_SITE_ID . "' });
  </script>
  <script async src=\"https://cse.google.com/cse.js?cx=" . GOOGLE_CSE_ID . "\"></script>

</head>
<body>";
}
?>
