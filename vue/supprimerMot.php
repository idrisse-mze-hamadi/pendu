<div class="col col-md-6 mt-5">
    <form action="" method="POST">
        <div class="col-auto">
            <label for="supprimerMot" class="form-label">Supprimer mot</label>
            <select name="supprimerMot" class="form-select">
                <?php foreach ($listeDeMots as $mot) : ?>
                    <option value="<?= trim($mot) ?>">
                        <?= trim($mot) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row g-3 align-item-center mt-3 text-center">
            <button type="submit" class="btn col-auto btn-primary">
                Supprimer
            </button>
        </div>
    </form>
</div>