
<?php
// namespace App\Controllers;

use App\Services\Session;

$services = include __DIR__ . '/../services/session.service.php';

$session = $services['session']; 
$session['start']();

$user = $session['get']('user');

if (!$user) {
    header('Location: /?route=login');
    exit;
}


require_once __DIR__ . '/../views/dashboard/dashboard.html.php';
