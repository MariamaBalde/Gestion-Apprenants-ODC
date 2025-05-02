<?php
namespace App\Controllers;

use App\Services;
use App\Models;

require_once __DIR__ . '/controller.php';
$validator = include __DIR__ . '/../services/validator.service.php';
$userModel = include __DIR__ . '/../models/model-login.php';



function forgotPassword(): void {
    global $validator, $userModel;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';

        $errors = $validator['validateForgotPassword']($_POST);

        if (empty($errors)) {
            $user = $userModel['findUserByLogin']($login);

            if ($user) {
                $userModel['updatePassword']($login, $password);
                redirectToRoute('/');
            } else {
                $errors[] = "Aucun utilisateur trouvé avec ce login.";
            }
        }

        renderView("login/forgot-password", [
            "errors" => $errors,
            "old" => $_POST
        ]);
    } else {
        renderView("login/forgot-password");
    }
}
