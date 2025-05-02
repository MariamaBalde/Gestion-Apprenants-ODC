<?php
namespace Model;

require_once 'model.php';
use function App\Models\jsonToArray;

return [
    'getReferentielsByPromotion' => function (int $promotionId): array {
        $data = jsonToArray(__DIR__ . '/../data/data.json');
        $promotion = array_filter($data['Promotions'], fn($promo) => $promo['id'] === $promotionId);
        $promotion = reset($promotion);

        if (!$promotion || empty($promotion['referentiels'])) {
            return [];
        }

        $referentielService = require __DIR__ . '/../services/referentiel.service.php';
        $allReferentiels = $referentielService['getAllReferentiels']();

        return array_filter($allReferentiels, fn($ref) => isset($ref['id']) && in_array($ref['id'], $promotion['referentiels']));
    },

    'getAllReferentiels' => function (): array {
        $referentielService = require __DIR__ . '/../services/referentiel.service.php';
        return $referentielService['getAllReferentiels']();
    },

    'getReferentielsByActivePromotion' => function (): array {
        $data = jsonToArray(__DIR__ . '/../data/data.json');

        $activePromotion = array_filter($data['Promotions'], fn($promo) => $promo['status'] === 'active');
        $activePromotion = reset($activePromotion);

        if (!$activePromotion || empty($activePromotion['referentiels'])) {
            return []; 
        }

        $referentielService = require __DIR__ . '/../services/referentiel.service.php';
        $allReferentiels = $referentielService['getAllReferentiels']();

        return array_filter($allReferentiels, fn($ref) => in_array($ref['id'], $activePromotion['referentiels']));
    }
];