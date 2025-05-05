<div class="referentiels-container">
    <div class="page-header">
        <div class="page-title">
            <h1>Référentiels</h1>
            <p>Gérer les référentiels de la promotion</p>
        </div>
    </div>

    <div class="actions-container">
        <div class="search-box">
            <input type="text" placeholder="Rechercher un référentiel..." aria-label="Rechercher">
            <i class="search-icon"></i>
        </div>
        <div class="action-buttons">
             <button class="btn btn-secondary" onclick="window.location.href='/referentiels/all'">
                   <i class="list-icon"><i class="fa-solid fa-book"></i></i>  
                    Tous les référentiels
             </button>
            <button class="btn btn-primary" onclick="window.location.href='/referentiels/assign'">
                <i class="plus-icon"><i class="fa-solid fa-plus"></i></i> Ajouter à la       promotion
            </button>
        </div>
    </div>

    <div class="referentiels-grid">
        <?php if (!empty($referentiels)): ?>
            <?php foreach ($referentiels as $referentiel): ?>
                <div class="referentiel-card">
                    <!-- Image du référentiel -->
                    <div class="referentiel-image" style="background-image: url('<?= htmlspecialchars($referentiel['image_url'] ?? '/assets/images/default-referentiel.jpg') ?>');"></div>
                    
                    <!-- Contenu du référentiel -->
                    <div class="referentiel-content">
                        <h3><?= htmlspecialchars($referentiel['nom']) ?></h3>
                        <div class="referentiel-modules">
                            <span><?= $referentiel['modules'] ?? 0 ?> modules</span>
                        </div>
                        <p class="referentiel-description"><?= htmlspecialchars($referentiel['description'] ?? 'Aucune description') ?></p>
                        
                        <!-- Indicateur d'apprenants -->
                        <div class="apprenants-indicator">
                            <div class="apprenants-dots">
                                <span class="dot <?= ($referentiel['apprenants'] ?? 0) > 0 ? 'active' : '' ?>"></span>
                                <span class="dot <?= ($referentiel['apprenants'] ?? 0) > 1 ? 'active' : '' ?>"></span>
                                <span class="dot <?= ($referentiel['apprenants'] ?? 0) > 2 ? 'active' : '' ?>"></span>
                            </div>
                            <span class="apprenants-count"><?= $referentiel['apprenants'] ?? 0 ?> apprenants</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-referentiels">Aucun référentiel trouvé pour la promotion active.</p>
        <?php endif; ?>
    </div>
</div>



