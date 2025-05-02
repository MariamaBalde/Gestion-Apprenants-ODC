<?php

require_once __DIR__ . '/../controllers/login.controller.php';
require_once __DIR__ . '/../controllers/forgot-password.controller.php';
require_once __DIR__ . '/../controllers/promotion.controller.php';
require_once __DIR__ . '/../controllers/referentiel.controller.php';


use function App\Controllers\login;
use function App\Controllers\forgotPassword;
use function \Controller\showPromosGrid;



// $uri = $_SERVER['REQUEST_URI'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


switch ($uri) {
    case '/':
    case '/login':
        login();
        break;
    case '/forgot-password':
            forgotPassword();
            break;
    case '/logout':
            \App\Controllers\logout();
                break;       
    case '/dashboard':
        echo "Dashboard (à faire)";
        break;
    case '/promotions':
            showPromosGrid();
            break;
    case '/promotions/add':
                \Controller\showAddPromotionPage();
                break;
            
    case '/promotions/store':
                \Controller\storePromotion();
                break;                 
    case '/promotions/toggle-status':
        \Controller\togglePromotionStatus();
        break;
    case '/referentiels':
            \Controller\showReferentielsByActivePromotion();
            break;
        
    case '/referentiels/assign':
            \Controller\showAssignReferentielsPage();
            break;
        
    case '/referentiels/assign/store':
            \Controller\storeAssignedReferentiels();
            break; 
       case '/referentiels/all':
                \Controller\showAllReferentiels();
                break;          
    default:
    echo "404 - Page non trouvée";
        break;
}







































