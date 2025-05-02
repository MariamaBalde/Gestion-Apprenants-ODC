<?php
require_once __DIR__ . '/../models/model.php';
use function App\Models\jsonToArray;

return [
    'validateForgotPassword' => function (array $data): array {
        $errors = [];

        if (empty($data['login'])) {
            $errors[] = "Le matricule/email est requis.";
        }

        if (empty($data['password'])) {
            $errors[] = "Le mot de passe est requis.";
        }

        return $errors;
    },
    'validatePromotionForm' => function (array $data, array $file, array $services): array {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = "Le nom de la promotion est obligatoire.";
        } elseif (!$services['isPromotionNameUnique']($data['name'])) {
            $errors['name_unique'] = "Une promotion avec ce nom existe déjà (active ou inactive).";
        }

        if (empty($data['start_date']) || empty($data['end_date'])) {
            $errors['dates'] = "Les dates de début et de fin sont obligatoires.";
        }

        if (empty($data['referentiels'])) {
            $errors['referentiels'] = "Veuillez sélectionner au moins un référentiel.";
        }

        if ($file['error'] === UPLOAD_ERR_NO_FILE) {
            $errors['image'] = "L'image est obligatoire.";
        } else {
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if (!in_array($extension, $allowedExtensions)) {
                $errors['image_format'] = "Le format de l'image doit être JPG ou PNG.";
            }

            if ($file['size'] > 2 * 1024 * 1024) {
                $errors['image_size'] = "La taille de l'image ne doit pas dépasser 2MB.";
            }
        }

        return $errors;
    },
    'isPromotionNameUnique' => function (string $name): bool {
        $data = jsonToArray(__DIR__ . '/../data/data.json');
        $normalizedInputName = strtolower(trim(preg_replace('/\s+/', '', $name))); 

        foreach ($data['Promotions'] as $promotion) {
            $normalizedExistingName = strtolower(trim(preg_replace('/\s+/', '', $promotion['name'])));
            if ($normalizedInputName === $normalizedExistingName && in_array($promotion['status'], ['active', 'inactive'])) {
                return false; 
            }
        }
        return true; 
    },
];
