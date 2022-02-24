<div class="col col-md-6 position-relative">
    <figure class="figure mt-5 col col-md-">
        <img src="./public/image/<?= $_SESSION["etatDuPendu"] ?>.png" class="figure-img img-fluid">
    </figure>
    <?php if ($_SESSION["message"]["perdu"]) : ?>
        <figure class="figure mt-5 position-absolute col col-md-12 bottom-0">
            <img src="./public/image/gagné.gif" class="figure-img img-fluid ">
        </figure>
    <?php endif; ?>
    <?php if ($_SESSION["message"]["gagné"]) : ?>
        <figure class="figure mt-5 position-absolute col col-md-6 top-50 bottom-0">
            <img src="./public/image/joe-dalton-les-dalton.gif" class="figure-img img-fluid ">
        </figure>
    <?php endif; ?>
</div>