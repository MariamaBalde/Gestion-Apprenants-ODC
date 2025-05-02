<?php
namespace Controller;

require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../models/promotion.model.php';
require_once __DIR__ . '/../services/validator.service.php';
require_once __DIR__ . '/../services/session.service.php';

use function App\Controllers\renderView;
use function App\Controllers\redirectToRoute;
use function App\Controllers\savePhoto;
use function App\Models\jsonToArray;

function showPromosGrid()
{
    $session = require __DIR__ . '/../services/session.service.php';
    $session['startSession'](); 

    $promotionModel = require __DIR__ . '/../models/promotion.model.php';
    $referentielService = require __DIR__ . '/../services/referentiel.service.php';

    $promotions = $promotionModel['getAllPromos']();
    $referentiels = $referentielService['getAllReferentiels']();

    $referentielsAssoc = [];
    foreach ($referentiels as $referentiel) {
        $referentielsAssoc[$referentiel['id']] = $referentiel;
    }

    $stats = getPromotionStats();

    $page = $_GET['page'] ?? 1;
    $perPage = 5;
    $totalPromotions = count($promotions);
    
       // Trier les promotions pour que la promotion active soit en premier
       usort($promotions, function ($a, $b) {
        return ($b['status'] === 'active') <=> ($a['status'] === 'active');
    });

    $totalPages = ceil($totalPromotions / $perPage);
    $promotions = array_slice($promotions, ($page - 1) * $perPage, $perPage);

    $viewMode = $_GET['view'] ?? 'grid';
    $viewFile = $viewMode === 'list' ? 'promotion/promotion.list' : 'promotion/promotion.grid';

      // Récupérer la promotion active
      $activePromotion = array_filter($promotions, fn($promo) => $promo['status'] === 'active');
      $activePromotionName = $activePromotion ? reset($activePromotion)['name'] : 'Aucune promotion active';
  

 // Récupérer l'ID de la promotion active
//  $currentPromotion = array_filter($promotions, fn($promo) => $promo['status'] === 'active');
//  $currentPromotionId = $currentPromotion ? reset($currentPromotion)['id'] : null;
    renderView($viewFile, [
        'promotions' => $promotions,
        'referentiels' => $referentielsAssoc,
        'page' => $page,
        'totalPages' => $totalPages,
        'viewMode' => $viewMode,
        'stats' => $stats,
        'user' => $session['getSession']('user') ,
        'activePromotionName' => $activePromotionName // Transmettre le nom de la promotion active
        // 'currentPromotionId' => $currentPromotionId // Transmettre l'ID de la promotion active

    ]);
}

function showAddPromotionPage()
{
    $services = require __DIR__ . '/../services/referentiel.service.php';
    $referentiels = $services['getAllReferentiels']();

   

    // Utilisation de ob_start() pour capturer le contenu
    ob_start();
    require __DIR__ . '/../views/promotion/promotion.ajout.html.php';
    $content = ob_get_clean();

    // Appel explicite du layout
    require __DIR__ . '/../views/layout/layout.php';
}
function storePromotion()
{
    $services = require __DIR__ . '/../services/validator.service.php';
    $promotionModel = require __DIR__ . '/../models/promotion.model.php';
    $referentielService = require __DIR__ . '/../services/referentiel.service.php';

    $data = $_POST;
    $file = $_FILES['image'] ?? ['error' => UPLOAD_ERR_NO_FILE];

    // Valider les données
    $errors = $services['validatePromotionForm']($data, $file, $services);

    if (!empty($errors)) {
        $referentiels = $referentielService['getAllReferentiels']();
        
        // Utilisation de ob_start() pour capturer le contenu
        ob_start();
        require __DIR__ . '/../views/promotion/promotion.ajout.html.php';
        $content = ob_get_clean();

        // Appel explicite du layout
        require __DIR__ . '/../views/layout/layout.php';
        return;
    }

    // Sauvegarder la photo
    $photoPath = savePhoto($file, __DIR__ . '/../../public/assets/images');
    $data['image'] = $photoPath;
    $data['status'] = 'inactive';

    // Ajouter la promotion
    $promotionModel['addPromotion']($data);

    // Rediriger vers la liste des promotions
    redirectToRoute('/promotions');
}

function getPromotionStats(): array
{
    $promotionModel = require __DIR__ . '/../models/promotion.model.php';
    $promotions = $promotionModel['getAllPromos']();

    $activePromotions = array_filter($promotions, fn($promo) => ($promo['status'] ?? '') === 'active');
    $totalPromotions = count($promotions);
    $totalApprenants = array_sum(array_map(fn($promo) => $promo['apprenants_count'] ?? 0, $promotions));

    $referentielService = require __DIR__ . '/../services/referentiel.service.php';
    $totalReferentiels = count($referentielService['getAllReferentiels']());

    return [
        'active_count' => count($activePromotions),
        'total_count' => $totalPromotions,
        'apprenants_count' => $totalApprenants,
        'referentiels_count' => $totalReferentiels
    ];
}

function togglePromotionStatus()
{
    $promotionModel = require __DIR__ . '/../models/promotion.model.php';

    $promotionName = $_POST['name'] ?? null;
    $view = $_POST['view'] ?? 'list'; // Récupérer la vue actuelle (par défaut : list)

    $data = jsonToArray(__DIR__ . '/../data/data.json');

    $activePromotion = array_filter($data['Promotions'], fn($promo) => $promo['status'] === 'active');


    $promotionModel['toggleStatus']($promotionName);

    // redirectToRoute('/promotions');
        // Rediriger vers la vue appropriée
        if ($view === 'grid') {
            redirectToRoute('/promotions?view=grid');
        } else {
            redirectToRoute('/promotions?view=list');
        }
    
}
// function togglePromotionStatus()
// {
//     $promotionModel = require __DIR__ . '/../models/promotion.model.php';

//     $promotionName = $_POST['name'] ?? null;

//     if (!$promotionName) {
//         die('Erreur : Aucun nom de promotion reçu.');
//     }

//     $promotionModel['toggleStatus']($promotionName);

//     redirectToRoute('/promotions');
// }


// function showReferentielsByActivePromotion()
// {
//     $referentielModel = require __DIR__ . '/../models/referentiel.model.php';

//     $referentiels = $referentielModel['getReferentielsByActivePromotion']();

//     renderView('referentiel/referentiel.list', [
//         'referentiels' => $referentiels
//     ]);
// }
