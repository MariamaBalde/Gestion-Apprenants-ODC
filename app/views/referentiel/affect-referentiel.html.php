<!-- filepath: /home/mariama-balde/Documents/PHP/ProjetApprenantsODC/app/views/referentiel/assign-referentiels.html.php -->
<div class="modal">
    <div class="modal-header">
        <h1>Affecter des Référentiels</h1>
        <p>Promotion active : <?= htmlspecialchars($activePromotion['name']) ?></p>
    </div>

    <form action="/referentiels/assign/store" method="POST" class="form">
        <div class="form-group">
            <label for="referentiels">Sélectionnez les référentiels</label>
            <select id="referentiels" name="referentiels[]" multiple>
                <?php foreach ($referentiels as $referentiel): ?>
                    <option value="<?= htmlspecialchars($referentiel['id']) ?>">
                        <?= htmlspecialchars($referentiel['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <button type="button" class="cancel-btn" onclick="window.history.back()">Annuler</button>
            <button type="submit" class="submit-btn">Affecter</button>
        </div>
    </form>
</div>