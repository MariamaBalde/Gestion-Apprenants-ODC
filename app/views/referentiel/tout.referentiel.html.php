



<div class="referentiels-container">
   

   <div class="page-header">
        <div class="page-title">
        <a href="/referentiels" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Retour aux référentiels actifs
        </a>
            <h1>Tous les Référentiels</h1>
            <p>Liste complète des référentiels de formation</p>
         </div>
   </div>

    <div class="actions-container">
        <div class="search-box">
          <form method="GET" action="/referentiels/all">
           <input type="text" name="search" placeholder="Rechercher un référentiel..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
          </form>
            <i class="search-icon"></i>
        </div>
        <!-- <div class="action-buttons">  -->
           <button class="btn btn-primary" onclick="window.location.href='/referentiels/create'">
            <i class="fa-solid fa-plus"></i> Créer un référentiel
           </button>
        <!-- </div> -->
    </div>


    <div class="referentiels-grid" id="referentiels-grid">
        <?php foreach ($referentiels as $referentiel): ?>
            <div class="referentiel-card">
                <div class="referentiel-image" style="background-image: url('<?= htmlspecialchars($referentiel['image_url'] ?? '/assets/images/default-referentiel.jpg') ?>');"></div>
                <div class="referentiel-content">
                    <h3><?= htmlspecialchars($referentiel['nom']) ?></h3>
                    <p class="referentiel-description"><?= htmlspecialchars($referentiel['description']) ?></p>
                    <span class="referentiel-capacity">Capacité: <?= htmlspecialchars($referentiel['apprenants']) ?> places</span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
</div>
