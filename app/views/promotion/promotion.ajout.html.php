<div class="modal">
    <div class="modal-header">
        <h1>Créer une nouvelle promotion</h1>
        <p>Remplissez les informations ci-dessous pour créer une nouvelle promotion.</p>
    </div>

    <?php if (!empty($errors)): ?>
        <ul class="error-list">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="/promotions/store" method="POST" enctype="multipart/form-data" class="form">
        <div class="form-group">
            <label for="name">Nom de la promotion</label>
            <input type="text" id="name" name="name" placeholder="Ex: Promotion 2025" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            <?php if (!empty($errors['name_unique'])): ?>
                <small class="error"><?= htmlspecialchars($errors['name_unique']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="start_date">Date de début</label>
                <input type="date" id="start_date" name="start_date" value="<?= htmlspecialchars($_POST['start_date'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="end_date">Date de fin</label>
                <input type="date" id="end_date" name="end_date" value="<?= htmlspecialchars($_POST['end_date'] ?? '') ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="image">Photo de la promotion</label>
            <div class="file-upload">
                <label for="image" class="file-label">Ajouter ou glisser</label>
                <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png">
                <small>Format JPG, PNG. Taille max 2MB</small>
            </div>
        </div>

        <div class="form-group">
            <label for="referentiels">Référentiels</label>
            <select id="referentiels" name="referentiels[]" multiple>
                <?php foreach ($referentiels as $referentiel): ?>
                    <option value="<?= $referentiel['id'] ?>"><?= htmlspecialchars($referentiel['nom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <button type="button" class="cancel-btn" onclick="window.history.back()">Annuler</button>
            <button type="submit" class="submit-btn">Créer la promotion</button>
        </div>
    </form>
</div>