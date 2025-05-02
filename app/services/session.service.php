<?php

namespace App\Services;

return [
    "startSession" => function () {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    },
    "setSession" => function ($key, $value) {
        $_SESSION[$key] = $value;
    },
    "getSession" => function ($key) {
        return $_SESSION[$key] ?? null;
    },
    "destroySession" => function () {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
    },
    "isAuthenticated" => function () {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user']);
    }
];
