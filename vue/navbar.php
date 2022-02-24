<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Le pendu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="admin.php">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php?reset">Rejouer</a>
                </li>
            </ul>
            <?php if (isset($_SESSION["etatDuPendu"]) && 7 - $_SESSION["etatDuPendu"] >= 0) : ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item fw-bold">
                        Nombre de chance restante : <?= 7 - $_SESSION["etatDuPendu"] ?>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>