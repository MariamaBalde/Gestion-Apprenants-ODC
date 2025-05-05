<?php 
namespace App\Controllers;

function renderView(string $viewPath, array $data = []): void {
    $promotionModel = require __DIR__ . '/../models/promotion.model.php';
    $promotions = $promotionModel['getAllPromos']();

    $activePromotion = array_filter($promotions, fn($promo) => $promo['status'] === 'active');
    $activePromotionName = $activePromotion ? reset($activePromotion)['name'] : 'Aucune promotion active';

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
    $destinationPath = __DIR__ . '/../../public' . $path;
    if (!is_dir($destinationPath)) {
        mkdir($destinationPath, 0777, true); 
    }

    if ($file['error'] === 0) {
        $filename = uniqid() . "_" . basename($file['name']);
        $destination = $destinationPath . '/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $path . '/' . $filename; 
        }
    }
    return null;
}

// function savePhoto($file, $path = "uploads"): ?string {
//     if ($file['error'] === 0) {
//         $filename = uniqid() . "_" . $file['name'];
//         move_uploaded_file($file['tmp_name'], $path . '/' . $filename);
//         return $filename;
//     }
//     return null;
// }