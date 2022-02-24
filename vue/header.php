<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//db.onlinewebfonts.com/c/87088460af720610d2172b7c8a7e77c1?family=ChineseRocksW05-Bold" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="public/style/bootstrap.min.css"> <!-- Inclure le fichier css prédefinie par bootstrap -->
    <link rel="stylesheet" href="public/style/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"> <!-- Importer la bibliothèque d'icones -->
    <title>Pendu</title>
</head>

<body class="d-flex flex-column min-vh-100 fs-5">
    <?php include("vue/navbar.php"); ?>
    <div class="container">
        <div class="row">
            <?php if (end($REQUEST_URI) == "index.php") : ?>
                <?php if ($_SESSION["tour"] == 0) : ?>
                    <?php include("vue/difficulte.php"); ?>
                <?php else : ?>
                    <?php include("vue/pendu.php"); ?>
                    <?php include("vue/formulaire.php"); ?>
                <?php endif; ?>
            <?php else : ?>
                <div class="column">
                    <?php include("vue/ajouterMot.php"); ?>
                    <?php include("vue/supprimerMot.php"); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>