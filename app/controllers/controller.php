<?php 
namespace App\Controllers;

function renderView(string $viewPath, array $data = []): void {
    // Charger les promotions pour récupérer la promotion active
    $promotionModel = require __DIR__ . '/../models/promotion.model.php';
    $promotions = $promotionModel['getAllPromos']();

    // Trouver la promotion active
    $activePromotion = array_filter($promotions, fn($promo) => $promo['status'] === 'active');
    $activePromotionName = $activePromotion ? reset($activePromotion)['name'] : 'Aucune promotion active';

    // Ajouter le nom de la promotion active aux données
    $data['activePromotionName'] = $activePromotionName;

    extract($data);
    $view = __DIR__ . '/../views/' . $viewPath . '.html.php';

    if (in_array($viewPath, ['login/connexion', 'login/forgot-password'])) {
        require $view; 
    } else {
        ob_start();
        require $view;
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/layout.php';
    }
}
// function renderView(string $viewPath, array $data = []): void {
//     extract($data);
//     $view = __DIR__ . '/../views/' . $viewPath . '.html.php';

//     if (in_array($viewPath, ['login/connexion', 'login/forgot-password'])) {
//         require $view; 
//     } else {
//         ob_start();
//         require $view;
//         $content = ob_get_clean();

//         require __DIR__ . '/../views/layout/layout.php';
//     }
// }

function redirectToRoute(string $url): void {
    header("Location: $url");
    exit;
}

function savePhoto($file, $path = "uploads"): ?string {
    if ($file['error'] === 0) {
        $filename = uniqid() . "_" . $file['name'];
        move_uploaded_file($file['tmp_name'], $path . '/' . $filename);
        return $filename;
    }
    return null;
}