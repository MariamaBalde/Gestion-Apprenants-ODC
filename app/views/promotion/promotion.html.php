<?php
$session = require __DIR__ . '/../../services/session.service.php';


if ($_SERVER['REQUEST_URI'] !== '/login' && !$session['isAuthenticated']()) {
   header('Location: /login');
   exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $title ?? 'Sonatel Academy' ?></title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="/assets/css/promotion.css"/>
</head>
<body>
   <div class="container">
       <!-- Sidebar -->
       <div class="sidebar">
           <div class="sidebar-top">
               <div class="logo">
                   <img src="/assets/images/logo-removebg-preview.png" alt="Sonatel Logo" class="logo-img" />
               </div>
               <div class="sidebar-header">
                   Promotion - 2025
               </div>
           </div>
           <hr class="sidebar-divider">
           <div class="sidebar-menu">
               <a href="#"><i class="fa-solid fa-house" style="color: #b4b6bb;"></i> Tableau de bord</a>
               <a href="#" class="active"><i class="fa-solid fa-folder" style="color: #b1b2b4;"></i> Promotions</a>
               <a href="#"><i class="fa-solid fa-book" style="color: #a7a8aa;"></i> Référentiels</a>
               <a href="#"><i class="fa-solid fa-users" style="color: #a4a5a8;"></i> Apprenants</a>
               <a href="#"><i class="fa-regular fa-file" style="color: #a7a8aa;"></i> Gestion des présences</a>
               <a href="#"><i class="fa-solid fa-laptop" style="color: #b6b7b9;"></i> Kits & Laptops</a>
               <a href="#"><i class="fa-solid fa-signal" style="color: #c8c9cb;"></i> Rapports & Stats</a>
           </div>
           <button class="logout-btn">
               <i class="fa-solid fa-arrow-right-to-bracket" style="color: #d53958;"></i> Déconnexion
           </button>
       </div>


       <!-- Main Content -->
       <div class="main-content">
           <!-- Header with search and profile -->
           <div class="top-bar">
               <div class="search-bar">
                   <i class="fa-solid fa-magnifying-glass" style="color: #b7b9bd;"></i>
                   <input type="text" placeholder="Rechercher...">
               </div>
               <div class="profile">
                   <div class="notifications">
                       <i class="fa-regular fa-bell" style="color: #aeb0b2;"></i>
                   </div>
                   <div class="avatar">A</div>
                   <div class="user-info">
                       <div class="email">admin@sonatel-academy.sn</div>
                       <div class="role">Administrateur</div>
                   </div>
               </div>
           </div>


           <!-- Dynamic Content -->
           <?php require $view; ?>
       </div>
   </div>
</body>
</html>





