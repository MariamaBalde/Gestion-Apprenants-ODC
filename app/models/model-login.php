<?php
namespace App\Models;

use function App\Models\jsonToArray;
use function App\Models\arrayToJson;

return [
    "findUserByLoginAndPassword" => function (string $login, string $password): ?array {
        $data = jsonToArray();

        foreach (["Admin", "Vigile", "Apprenant"] as $role) {
            foreach ($data[$role] ?? [] as $user) {
                if ($user["login"] === $login && $user["password"] === $password) {
                    return ["role" => ucfirst($role), ...$user];
                }
            }
        }

        return null;
    },

    "findUserByLogin" => function (string $login): ?array {
        $data = jsonToArray();

        foreach (["Admin", "Vigile", "Apprenant"] as $role) {
            foreach ($data[$role] ?? [] as $user) {
                if ($user["login"] === $login) {
                    return ["role" => ucfirst($role), ...$user];
                }
            }
        }

        return null;
    },

    "updatePassword" => function (string $login, string $newPassword): void {
        $data = jsonToArray();

        foreach (["Admin", "Vigile", "Apprenant"] as $role) {
            foreach ($data[$role] ?? [] as $index => $user) {
                if ($user["login"] === $login) {
                    $data[$role][$index]["password"] = $newPassword;
                    arrayToJson($data);
                    return;
                }
            }
        }
    }
];


