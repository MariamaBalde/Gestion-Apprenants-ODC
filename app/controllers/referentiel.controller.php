<?php
namespace Controller;

require_once __DIR__ . '/../models/referentiel.model.php';
require_once __DIR__ . '/../models/promotion.model.php';
require_once __DIR__ . '/../controllers/controller.php';

use function App\Controllers\renderView;
use function App\Controllers\redirectToRoute;

function showReferentielsByActivePromotion()
{
    $referentielModel = require __DIR__ . '/../models/referentiel.model.php';
    $referentiels = $referentielModel['getReferentielsByActivePromotion']();

    renderView('referentiel/referentiel.list', [
        'referentiels' => $referentiels
    ]);
}
function showAssignReferentielsPage()
{
    $referentielModel = require __DIR__ . '/../models/referentiel.model.php';
    $promotionModel = require __DIR__ . '/../models/promotion.model.php';

    // Récupérer la promotion active
    $promotions = $promotionModel['getAllPromos']();
    $activePromotion = array_filter($promotions, fn($promo) => $promo['status'] === 'active');
    $activePromotion = reset($activePromotion);

    if (!$activePromotion) {
        redirectToRoute('/referentiels?error=no_active_promotion');
        return;
    }

    // Récupérer tous les référentiels
    $referentiels = $referentielModel['getAllReferentiels']();

    renderView('referentiel/affect-referentiel', [
        'referentiels' => $referentiels,
        'activePromotion' => $activePromotion
    ]);
}

function showAllReferentiels()
{
    $referentielModel = require __DIR__ . '/../models/referentiel.model.php';
    $referentiels = $referentielModel['getAllReferentiels']();
    

    renderView('referentiel/referentiel.list', [
        'referentiels' => $referentiels
    ]);
}

function storeAssignedReferentiels()
{
    $promotionModel = require __DIR__ . '/../models/promotion.model.php';

    $referentiels = $_POST['referentiels'] ?? [];
    $promotions = $promotionModel['getAllPromos']();

    // Récupérer la promotion active
    $activePromotionIndex = array_search('active', array_column($promotions, 'status'));

    if ($activePromotionIndex === false) {
        redirectToRoute('/referentiels?error=no_active_promotion');
        return;
    }

    // Affecter les référentiels à la promotion active
    $promotions[$activePromotionIndex]['referentiels'] = array_unique(array_merge(
        $promotions[$activePromotionIndex]['referentiels'] ?? [],
        $referentiels
    ));

    // Sauvegarder les modifications
    $promotionModel['savePromotions']($promotions);

    redirectToRoute('/referentiels');
}