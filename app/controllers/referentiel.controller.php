<?php
namespace Controller;
use App\Enums\PaginationEnum;


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

        // Filtrer les référentiels par recherche
    $search = $_GET['search'] ?? '';
    if (!empty($search)) {
            $referentiels = array_filter($referentiels, function ($referentiel) use ($search) {
                return stripos($referentiel['nom'], $search) !== false;
            });
    }
     // Pagination
     $page = $_GET['page'] ?? 1;
     $perPage = PaginationEnum::ITEMS_PER_PAGE->value;
    //  $perPage = 6; 
     $totalReferentiels = count($referentiels);
     $totalPages = ceil($totalReferentiels / $perPage);
     $referentiels = array_slice($referentiels, ($page - 1) * $perPage, $perPage);
 
     renderView('referentiel/tout.referentiel', [
         'referentiels' => $referentiels,
         'page' => $page,
         'totalPages' => $totalPages
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

function showCreateReferentielPage()
{
    renderView('referentiel/nouv.referentiel', []);
}

function storeReferentiel()
{
    $referentielModel = require __DIR__ . '/../models/referentiel.model.php';
    $validator = require __DIR__ . '/../services/validator.service.php';
    $errors = $validator['validateReferentielForm']($_POST, $_FILES['photo'], $validator);

    if (!empty($errors)) {
        renderView('referentiel/nouv.referentiel', ['errors' => $errors]);
        return;
    }

    // Enregistrer la photo
    $photoPath = null;
    if ($_FILES['photo']['error'] === 0) {
        $photoPath = \App\Controllers\savePhoto($_FILES['photo'], '/assets/images/referentiels/');
    }

    // Enregistrer le référentiel
    $referentielModel['createReferentiel']([
        'nom' => $_POST['nom'],
        'description' => $_POST['description'],
        'capacite' => $_POST['capacite'],
        'sessions' => $_POST['sessions'],
        'photo' => $photoPath,
        'status' => 'inactif'
    ]);

    \App\Controllers\redirectToRoute('/referentiels/all');
}

// function storeReferentiel()
// {
//     $referentielModel = require __DIR__ . '/../models/referentiel.model.php';
//     $errors = [];

//     $nom = $_POST['nom'] ?? '';
//     $description = $_POST['description'] ?? '';
//     $capacite = $_POST['capacite'] ?? '';
//     $sessions = $_POST['sessions'] ?? '';
//     $photo = $_FILES['photo'] ?? null;

//     if (empty($nom)) {
//         $errors['nom'] = 'Le nom est obligatoire.';
//     } elseif ($referentielModel['isNomUnique']($nom) === false) {
//         $errors['nom'] = 'Le nom doit être unique.';
//     }

//     if (empty($description)) {
//         $errors['description'] = 'La description est obligatoire.';
//     }

//     if (empty($capacite) || !is_numeric($capacite)) {
//         $errors['capacite'] = 'La capacité est obligatoire et doit être un nombre.';
//     }

//     if (empty($sessions)) {
//         $errors['sessions'] = 'Le nombre de sessions est obligatoire.';
//     }

//     if ($photo) {
//         $allowedTypes = ['image/jpeg', 'image/png'];
//         if (!in_array($photo['type'], $allowedTypes)) {
//             $errors['photo'] = 'La photo doit être au format JPG ou PNG.';
//         }
//         if ($photo['size'] > 2 * 1024 * 1024) {
//             $errors['photo'] = 'La taille de la photo ne doit pas dépasser 2MB.';
//         }
//     }

//     if (!empty($errors)) {
//         renderView('referentiel/nouv.referentiel', ['errors' => $errors]);
//         return;
//     }

//     $photoPath = null;
//     if ($photo) {
//         $photoPath = \App\Controllers\savePhoto($photo, '/assets/images/referentiels/');
//     }

//     $referentielModel['createReferentiel']([
//         'nom' => $nom,
//         'description' => $description,
//         'capacite' => $capacite,
//         'sessions' => $sessions,
//         'photo' => $photoPath,
//         'status' => 'inactif'
//     ]);

//     \App\Controllers\redirectToRoute('/referentiels/all');
// }