#!/bin/bash

# Script de création rapide de pages costumes optimisées
echo "🎭 GÉNÉRATEUR DE PAGES COSTUMES OPTIMISÉES"
echo "=========================================="

if [ $# -lt 3 ]; then
    echo "Usage: $0 <nom-costume> <titre-affiché> <catégorie>"
    echo ""
    echo "Exemples:"
    echo "  $0 charleston 'Charleston' 'Années 20 - Cabaret'"
    echo "  $0 pirate 'Pirate des Caraïbes' 'Aventure - Pirates'"
    echo "  $0 princesse 'Princesse Médiévale' 'Moyen-Âge - Royauté'"
    exit 1
fi

costume_name="$1"
costume_title="$2"
costume_category="$3"

output_file="costumes/${costume_name}-optimized.html"

echo "Génération de: $output_file"
echo "Titre: $costume_title"
echo "Catégorie: $costume_category"

# Template de base optimisé
cat > "$output_file" << EOF
<?php include_once "../includes/html-components.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Costume $costume_title - Location Déguisement | Chouette Déguisement</title>
    <meta name="description" content="Location costume $costume_title à Dijon. Déguisement authentique et de qualité. Réservation en ligne, essayage gratuit.">
    <meta name="keywords" content="costume $costume_name, déguisement $costume_name, location costume Dijon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
    .costume-page { padding: 60px 0; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: calc(100vh - 200px); }
    .costume-card { background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; margin-bottom: 30px; }
    .costume-header { background: linear-gradient(45deg, #d0331b, #ff6b4a); color: white; padding: 30px; text-align: center; }
    .costume-title { font-size: 2.5em; margin: 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); }
    .costume-category { font-size: 1.1em; opacity: 0.9; margin-top: 10px; }
    .costume-content { padding: 40px; }
    .costume-image { border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); transition: transform 0.3s ease; max-height: 400px; object-fit: cover; }
    .costume-image:hover { transform: scale(1.05); }
    .feature-list { list-style: none; padding: 0; }
    .feature-list li { padding: 10px 0; border-bottom: 1px solid #eee; display: flex; align-items: center; }
    .feature-list li:last-child { border-bottom: none; }
    .feature-icon { color: #28a745; margin-right: 15px; font-size: 1.2em; }
    .price-box { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 25px; border-radius: 10px; margin: 20px 0; }
    .price-item { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.3); }
    .price-item:last-child { border-bottom: none; font-weight: bold; font-size: 1.1em; }
    .btn-reserve { background: linear-gradient(45deg, #d0331b, #ff6b4a); border: none; color: white; padding: 15px 30px; font-size: 1.2em; border-radius: 50px; transition: all 0.3s ease; width: 100%; margin: 20px 0; }
    .btn-reserve:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(208, 51, 27, 0.4); color: white; }
    .contact-box { background: #f8f9fa; padding: 20px; border-radius: 10px; text-align: center; margin-top: 20px; }
    .contact-box i { color: #d0331b; margin-right: 8px; }
    </style>
</head>
<body>
    <?php renderCatalogueHeader("catalogue", 1, "Costume"); ?>
    
    <section class="costume-page">
        <div class="container">
            <div class="costume-card">
                <div class="costume-header">
                    <h1 class="costume-title">Costume $costume_title</h1>
                    <p class="costume-category">$costume_category</p>
                </div>
                
                <div class="costume-content">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="../images/costumes/${costume_name}.webp" 
                                 alt="Costume $costume_title" 
                                 class="img-responsive costume-image"
                                 onerror="this.src='../images/logo.webp';">
                        </div>
                        
                        <div class="col-md-7">
                            <h3><i class="fa fa-star"></i> Description</h3>
                            <p style="font-size: 16px; line-height: 1.6; color: #555; margin-bottom: 25px;">
                                Découvrez ce magnifique costume $costume_title ! 
                                Parfait pour vos soirées costumées, événements à thème ou spectacles. 
                                Une tenue authentique qui vous garantit un look réussi et des souvenirs mémorables.
                            </p>
                            
                            <h4><i class="fa fa-list"></i> Composition du costume</h4>
                            <ul class="feature-list">
                                <li><i class="fa fa-check feature-icon"></i>Pièce principale du costume</li>
                                <li><i class="fa fa-check feature-icon"></i>Accessoires authentiques assortis</li>
                                <li><i class="fa fa-check feature-icon"></i>Éléments de finition soignés</li>
                                <li><i class="fa fa-check feature-icon"></i>Instructions d'entretien incluses</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 40px;">
                        <div class="col-md-6">
                            <h4><i class="fa fa-euro"></i> Tarification</h4>
                            <div class="price-box">
                                <div class="price-item"><span>Week-end (2 jours)</span><span>45€</span></div>
                                <div class="price-item"><span>Semaine (7 jours)</span><span>65€</span></div>
                                <div class="price-item"><span>Caution (remboursée)</span><span>100€</span></div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h4><i class="fa fa-calendar"></i> Réservation</h4>
                            <button type="button" class="btn btn-reserve" onclick="alert('Réservation pour: $costume_title');">
                                <i class="fa fa-calendar"></i> Réserver un Essayage
                            </button>
                            <div class="contact-box">
                                <p><i class="fa fa-phone"></i> 06 52 85 24 29</p>
                                <p><i class="fa fa-envelope"></i> michel.dj.21@orange.fr</p>
                                <p><i class="fa fa-map-marker"></i> Couchey, près de Dijon</p>
                                <hr style="margin: 15px 0;">
                                <small><i class="fa fa-info-circle"></i> Essayage gratuit • Réservation flexible • Service local</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center" style="margin-top: 30px;">
                <a href="../catalogue-femme/page-1.html" class="btn btn-default" style="margin: 5px;">
                    <i class="fa fa-arrow-left"></i> Catalogue Femme
                </a>
                <a href="../catalogue-homme/page-1.html" class="btn btn-default" style="margin: 5px;">
                    <i class="fa fa-arrow-right"></i> Catalogue Homme
                </a>
                <a href="../index.html" class="btn btn-default" style="margin: 5px;">
                    <i class="fa fa-home"></i> Accueil
                </a>
            </div>
        </div>
    </section>
    
    <?php renderSimpleFooter(); ?>
</body>
</html>
EOF

echo "✅ Page générée: $output_file"
echo ""
echo "📝 ÉTAPES SUIVANTES:"
echo "   1. Personnaliser la description"
echo "   2. Ajuster la liste des éléments"  
echo "   3. Modifier les prix si nécessaire"
echo "   4. Vérifier l'image: images/costumes/${costume_name}.webp"
echo ""
echo "🚀 Page prête à utiliser!"
