<div class="page-header">
    <div class="page-title">
        <h1>Promotion</h1>
        <p><?= htmlspecialchars($stats['apprenants_count'] ?? '0') ?> apprenants</p>
    </div>
    <button class="add-btn" style="background-color: #008b87;" onclick="window.location.href='/promotions/add'">
        <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i> Ajouter promotion
    </button>
</div>

<?php if (!empty($error)): ?>
    <div class="error-message">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<!-- Stats Cards -->
<div class="stats-cards">
    <div class="stat-card">
        <div class="stat-left-content">
            <div class="stat-icon-circle">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number"><?= htmlspecialchars($stats['apprenants_count'] ?? '0') ?></div>
                <div class="stat-label">Apprenants</div>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-left-content">
            <div class="stat-icon-circle">
                <i class="fa-solid fa-folder"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number"><?= htmlspecialchars($stats['referentiels_count'] ?? '0') ?></div>
                <div class="stat-label">Référentiels</div>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-left-content">
            <div class="stat-icon-circle">
                <i class="fa-solid fa-cubes"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number">5</div>
                <div class="stat-label">Stagiaires</div>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-left-content">
            <div class="stat-icon-circle">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number">13</div>
                <div class="stat-label">Permanent</div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Controls -->
<div class="search-controls">
    <div class="search-box">
        <i class="fa-solid fa-search"></i>
        <input type="text" placeholder="Rechercher...">
    </div>
    
    <div class="filter-controls">
        <div class="filter-dropdown">
            <select>
                <option>Filtre par classe</option>
            </select>
        </div>
        
        <div class="filter-dropdown">
            <select>
                <option>Filtre par status</option>
            </select>
        </div>
    </div>
</div>

<!-- Promotions Table -->
<div class="promotions-table">
    <table>
        <thead>
            <tr>
                <th>Photo</th>
                <th>Promotion</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Référentiel</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($promotions as $promotion): ?>
                <tr>
                    <td class="photo-cell">
                        <img src="/assets/images/<?= htmlspecialchars($promotion['image'] ?? 'default.png') ?>" alt="<?= htmlspecialchars($promotion['name'] ?? 'Promotion') ?>" class="promotion-img">
                    </td>
                    <td><?= htmlspecialchars($promotion['name'] ?? 'Promotion') ?></td>
                    <td><?= htmlspecialchars($promotion['start_date'] ?? '01/02/20XX') ?></td>
                    <td><?= htmlspecialchars($promotion['end_date'] ?? '01/02/20XX') ?></td>
                    <td class="referentiels-cell">
                    <?php if (!empty($promotion['referentiels'])): ?>
    <?php foreach ($promotion['referentiels'] as $referentielId): ?>
        <?php 
            $refName = htmlspecialchars($referentiels[$referentielId]['nom'] ?? 'Inconnu');
            $refClass = '';
            
            // Déterminer la classe CSS en fonction du nom du référentiel
            switch ($refName) {
                case 'DEV WEB/MOBILE':
                    $refClass = 'dev-web';
                    break;
                case 'REF DIG':
                    $refClass = 'ref-dig';
                    break;
                case 'DEV DATA':
                    $refClass = 'dev-data';
                    break;
                case 'AWS':
                    $refClass = 'aws';
                    break;
                case 'HACKEUSE':
                    $refClass = 'hackeuse';
                    break;
                default:
                    $refClass = 'referentiel-tag'; 
            }
        ?>
        <span class="referentiel-tag <?= $refClass ?>"><?= $refName ?></span>
    <?php endforeach; ?>
<?php else: ?>
    Aucun
<?php endif; ?>
                    </td>
                    <td>
                        <form action="/promotions/toggle-status" method="POST" style="display: inline;">
                            <input type="hidden" name="name" value="<?= htmlspecialchars($promotion['name']) ?>">
                            <input type="hidden" name="view" value="list"> <!-- Vue actuelle -->
                            <button type="submit" class="status-toggle-btn <?= ($promotion['status'] === 'active') ? 'status-active' : 'status-inactive' ?>">
                                <span class="status-label"><?= ($promotion['status'] === 'active') ? 'Active' : 'Inactive' ?></span>
                                <i class="fa-solid fa-power-off"></i>
                            </button>
                        </form>
                    </td>
                    <td class="actions-cell">
                        <div class="dropdown">
                            <button class="dropdown-btn">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <div class="dropdown-content">
                                <a href="/promotions/details/<?= htmlspecialchars($promotion['id'] ?? '') ?>">Détails</a>
                                <a href="/promotions/edit/<?= htmlspecialchars($promotion['id'] ?? '') ?>">Modifier</a>
                                <a href="/promotions/delete/<?= htmlspecialchars($promotion['id'] ?? '') ?>">Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="pagination-container">
    <div class="pagination-info">
        <span>page</span>
        <select class="page-select">
            <option>5</option>
            <option>10</option>
            <option>20</option>
        </select>
    </div>
    
    <div class="pagination-pages">
        <span>1 à 5 pour <?= htmlspecialchars($totalPromotions) ?></span>
    </div>
    
    <div class="pagination-controls">
        <a href="?page=<?= max(1, $page - 1) ?>&view=list" class="page-btn prev <?= $page <= 1 ? 'disabled' : '' ?>">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&view=list" class="page-btn <?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
        
        <a href="?page=<?= min($totalPages, $page + 1) ?>&view=list" class="page-btn next <?= $page >= $totalPages ? 'disabled' : '' ?>">
            <i class="fa-solid fa-chevron-right"></i>
        </a>
    </div>
</div>
