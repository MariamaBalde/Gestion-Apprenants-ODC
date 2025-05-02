<?php
namespace Model;

require_once 'model.php';
use function App\Models\jsonToArray;
use function App\Models\arrayToJson;


return [
    'getAllPromos' => fn(): array => jsonToArray(__DIR__ . '/../data/data.json')['Promotions'] ?? [],
    'addPromotion' => function (array $promotion): void {
        $data = jsonToArray(__DIR__ . '/../data/data.json');

       

        $data['Promotions'][] = $promotion;
        arrayToJson($data, __DIR__ . '/../data/data.json');
    },

    'toggleStatus' => function (string $name): void {
     $data = jsonToArray(__DIR__ . '/../data/data.json');

    foreach ($data['Promotions'] as &$promotion) {
        if (strtolower($promotion['name']) === strtolower($name)) {
            // Si la promotion est déjà active, ne rien faire
            if ($promotion['status'] === 'active') {
                return;
            }

            // Désactiver toutes les autres promotions
            foreach ($data['Promotions'] as &$otherPromotion) {
                $otherPromotion['status'] = 'inactive';
            }

            // Activer la promotion sélectionnée
            $promotion['status'] = 'active';
            break;
        }
    }
    arrayToJson($data, __DIR__ . '/../data/data.json');
},

'savePromotions' => function (array $promotions): void {
    $data = jsonToArray(__DIR__ . '/../data/data.json');
    $data['Promotions'] = $promotions;
    arrayToJson($data, __DIR__ . '/../data/data.json');
}
];

