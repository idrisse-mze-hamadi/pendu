<div class="col col-md-6 mt-5">
    <!-- "^" correspond au ou exclusif : la sortie est vraie seulement si l'une dès deux entrées est vraie -->
    <form action="<?php !$_SESSION["message"]["perdu"] ^ $_SESSION["message"]["gagné"] ? "index.php" : session_destroy() ?>" method="POST">
        <div class="row g-3 align-item-center mb-3">
            <?php for ($i = 0; $i < strlen($_SESSION["mot"]); $i++) : ?>
                <div class="col-auto">
                    <input type="text" class="form-control" name="<?= $i ?>" value="<?= in_array($_SESSION["mot"][$i], $_SESSION["lettresTrouvees"]) ? $_SESSION["mot"][$i] : "" ?>" name="<?= $i ?>" size="1" maxlength="1" disabled>
                </div>
            <?php endfor; ?>
        </div>
        <div class="col-1">
            <input type="text" class="form-control" name="lettre" size="3" maxlength="1" <?= !$_SESSION["message"]["perdu"] ^ $_SESSION["message"]["gagné"] ? "required autofocus" : "disabled" ?>>
        </div>
        <div class="row g-3 align-item-center mt-3">
            <button type="submit" class="btn col-auto <?= !$_SESSION["message"]["perdu"] ^ $_SESSION["message"]["gagné"] ? "btn-primary" : "btn-info" ?>">
                <?= $_SESSION["message"]["perdu"] ^ $_SESSION["message"]["gagné"] ? "Rejouer" : "Valider" ?>
            </button>
        </div>
    </form>
    <div class="row">
        <div class="d-flex col justify-content-end">
            <div class="card w-75 opacity-75">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-undo"></i>
                        Tour: <?= $_SESSION["tour"] ?>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        Mauvaise(s) lettre(s) trouvée(s):
                        <div class="d-flex row">
                            <?php foreach ($_SESSION["mauvaisesLettres"] as $mauvaisLettre) : ?>
                                <div class="fw-bold col-auto">
                                    <?= $mauvaisLettre ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </h6>
                    <p class="card-text">
                    <div class="fw-bold">
                        <?php if ($_SESSION["message"]["gagné"]) : ?>
                            <div class="text-success">
                                <i class="fas fa-hat-cowboy"></i> Vous avez réussi à vous échapper, bien joué cow-boy
                            </div>
                        <?php elseif ($_SESSION["message"]["mauvais"]) : ?>
                            <div class="text-danger">
                                <i class="fas fa-skull-crossbones"></i> Mauvaise lettre...
                            </div>
                        <?php elseif ($_SESSION["message"]["bon"]) : ?>
                            <div class="text-success">
                                <i class="fas fa-hat-cowboy"></i> Bonne lettre, bien joué cow-boy !
                            </div>
                        <?php elseif ($_SESSION["message"]["perdu"]) : ?>
                            <div class="text-dark">
                                <i class="fas fa-skull-crossbones"></i> Vous avez perdu, que la terre vous soit légère...
                            </div>
                            <div>
                                Le mot caché était : <p class="fs-5"><?= strtoupper($_SESSION["mot"]) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>