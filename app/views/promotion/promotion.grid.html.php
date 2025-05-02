<?php ?>
<div class="page-header">
   <div class="page-title">
       <h1>Promotion</h1>
       <p>Gérer les promotions de l'école</p>
   </div>
   <button class="add-btn" style="background-color: #008b87;" onclick="window.location.href='/promotions/add'">
       <i class="fa-solid fa-plus"></i> Ajouter une promotion
   </button>
</div>


<div class="stats-cards">
   <!-- Card 1: Nombre d'apprenants -->
   <div class="stat-card">
       <div class="stat-info">
           <div class="number"><?= htmlspecialchars($stats['apprenants_count']) ?></div>
           <div class="label">Apprenants</div>
       </div>
       <div class="icon">
           <i class="fa-solid fa-users"></i>
       </div>
   </div>


   <!-- Card 2: Nombre de référentiels -->
   <div class="stat-card">
       <div class="stat-info">
           <div class="number"><?= htmlspecialchars($stats['referentiels_count']) ?></div>
           <div class="label">Référentiels</div>
       </div>
       <div class="icon">
           <i class="fa-solid fa-book"></i>
       </div>
   </div>


   <!-- Card 3: Promotions actives -->
   <div class="stat-card">
       <div class="stat-info">
           <div class="number"><?= htmlspecialchars($stats['active_count']) ?></div>
           <div class="label">Promotions actives</div>
       </div>
       <div class="icon">
           <i class="fa-solid fa-check"></i>
       </div>
   </div>


   <!-- Card 4: Total promotions -->
   <div class="stat-card">
       <div class="stat-info">
           <div class="number"><?= htmlspecialchars($stats['total_count']) ?></div>
           <div class="label">Total promotions</div>
       </div>
       <div class="icon">
           <i class="fa-regular fa-folder"></i>
       </div>
   </div>
</div>


<div class="filter-section">
   <div class="search-filter">
       <input type="text" placeholder="Rechercher...">
   </div>
  
   <div class="view-controls">
       <div class="dropdown-filter">
           <select>
               <option>Tous</option>
           </select>
       </div>
       <div class="view-controls">
    <button class="view-btn <?= ($_GET['view'] ?? 'grid') === 'grid' ? 'active' : '' ?>" onclick="window.location.href='?view=grid'">Grille</button>
    <button class="view-btn <?= ($_GET['view'] ?? 'grid') === 'list' ? 'active' : '' ?>" onclick="window.location.href='?view=list'">Liste</button>
</div>
     
   </div>
</div>


<div class="promotions-grid">
    <?php foreach ($promotions as $promotion): ?>
        <div class="promotion-card">
            <div class="card-header">
                <form action="/promotions/toggle-status" method="POST" style="display: inline;">
                    <input type="hidden" name="name" value="<?= htmlspecialchars($promotion['name']) ?>">
                    <input type="hidden" name="view" value="grid"> <!-- Vue actuelle -->
                    <button type="submit" class="status-toggle-btn <?= ($promotion['status'] === 'active') ? 'status-active' : 'status-inactive' ?>">
                        <span class="status-label"><?= ($promotion['status'] === 'active') ? 'Active' : 'Inactive' ?></span>
                        <i class="fa-solid fa-power-off"></i>
                    </button>
                </form>
            </div>

            <div class="promotion-info">
                <div class="promotion-logo">
                    <img src="/assets/images/<?= htmlspecialchars($promotion['image'] ?? 'default.png') ?>" alt="<?= htmlspecialchars($promotion['name'] ?? 'Promotion') ?>">
                </div>
                <div class="promotion-details">
                    <h3><?= htmlspecialchars($promotion['name'] ?? 'Promotion') ?></h3>
                    <div class="promotion-date">
                        <i class="fa-regular fa-calendar"></i> <?= htmlspecialchars($promotion['start_date'] ?? 'Date non définie') ?> - <?= htmlspecialchars($promotion['end_date'] ?? 'Date non définie') ?>
                    </div>
                </div>
            </div>

            <div class="learners-count">
                <i class="fa-solid fa-users"></i> <?= htmlspecialchars($promotion['apprenants_count'] ?? 0) ?> apprenants
            </div>
            <a href="/promotions/details/<?= htmlspecialchars($promotion['id'] ?? '') ?>" class="view-details">
                Voir détails <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>&view=grid" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>
</div>

