<?php
namespace App\Controllers;

use function App\Controllers\renderView;
use function App\Controllers\redirectToRoute;
use App\Models;
use App\Services;


require_once __DIR__ . '/../controllers/controller.php';
require_once __DIR__ . '/../models/model.php';
$loginModel = require_once __DIR__ . '/../models/model-login.php';
$session = require_once __DIR__ . '/../services/session.service.php';

function login(): void {
    global $loginModel, $session;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $loginModel["findUserByLoginAndPassword"]($login, $password);
        
        if ($user) {
            $session['startSession']();
            $session['setSession']("user", $user); 
            redirectToRoute("/promotions");
        } else {
            $errors[] = "Identifiants incorrects.";
            renderView("login/connexion", [
                "errors" => $errors,
                "old" => $_POST
            ]);
        }
    } else {
        renderView("login/connexion");
    }
}

function logout(): void {
    $session = require __DIR__ . '/../services/session.service.php';
    $session['destroySession']();
    redirectToRoute('/login');
}

