<?php
 namespace App\Models;

 function jsonToArray(?string $filename = null): array {
    // $filename = $filename ?? '/home/mariama-balde/Documents/Projet/ProjetApprenantsODC/app/data/data.json';
    $filename = $filename ?? '/home/mariama-balde/Documents/PHP/ProjetApprenantsODC/app/data/data.json';
    if (!file_exists($filename)) {
        return []; 
    }

    $data = file_get_contents($filename);
    $decoded = json_decode($data, true);


    return $decoded ?? [];
}


function arrayToJson(array $data, ? string $filename = null): void {
    $filename = $filename ?? __DIR__ . '/../data/data.json';
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
}


