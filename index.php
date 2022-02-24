<?php


session_start();

$REQUEST_URI = explode("/", $_SERVER["REQUEST_URI"]);

if (isset($_REQUEST["reset"])) {
    session_destroy();
    header("Location: index.php");
}

$DIFFICULTE = [
    "FACILE"    => 4,
    "MOYEN"     => 6,
    "DIFFICILE" => 10
];

$listeDeMots = file("mots.txt"); // On recupere le fichier sous forme de tableau

/**
 * A chaque fois, on incremente le tour dans la session,
 * si il existe
 * sinon on l'initialise à 0
 */
if (isset($_SESSION["tour"])) {
    $_SESSION["tour"]++;
} else {
    $_SESSION["tour"] = 0;
}

/**
 * Quand le tour vaut 0
 * On initialise les variables qui vont nous permettre de jouer 
 */
if ($_SESSION["tour"] == 0) {

    $_SESSION["lettresTrouvees"] = [];
    $_SESSION["mauvaisesLettres"] = [];
    $_SESSION["message"] = [
        "bon"       => false,
        "mauvais"   => false,
        "gagné"     => false,
        "perdu"     => false,
    ];

    $_SESSION["etatDuPendu"] = 1;

    /**
     * Si le tour vaut 1, 
     * On génére le mot aléatoire depuis la liste
     */
} elseif ($_SESSION["tour"] == 1) {

    if (empty($_REQUEST)) {
        session_destroy();
        header("Location:index.php");
    }


    // Génération des mots en fonction de la difficulté
    $tableauDeMots  = array_values(array_filter($listeDeMots, function ($mot) use ($DIFFICULTE) {
        return strlen(trim($mot)) <= $DIFFICULTE[current($_REQUEST)];
    }));

    // Generation du mot caché
    $mot_cache  = utf8_encode(strtolower($tableauDeMots[rand(0, count($tableauDeMots) - 1)])); // Recupere un mot aléatoire parmis la liste des mots contenus dans le fichier

    // Si le paramètre "mot" n'existe pas dans la session, 
    // alors on le créer et on attribue la valeur de $mot_cache 
    $_SESSION["mot"] = trim($mot_cache);
} else if ($_SESSION["etatDuPendu"] == 7) {
    // Quand l'état du pendu est à 7, Averell est completement pendu,
    // Le joueur a perdu la partie

    $_SESSION["etatDuPendu"]++;
    $_SESSION["message"]["perdu"] = true;
} else if (isset($_REQUEST["lettre"])) {
    /**
     * Ici se trouve le cycle normal du jeu 
     * On recupere l'entrée du joueur et on regarde si elle correspond à une lettre
     * du mot caché 
     */
    $lettre = strtolower($_REQUEST["lettre"]); // On stocke la lettre issue de l'input

    /**
     * Si la lettre n'est pas dans le mot et qu'elle n'est pas dans le tableau
     * de mauvais mots entrés 
     * Alors on la stocke dans ce tableau (mauvais mots entrés)
     * Et on incremente l'etat du pendu d'un cran
     */
    if (!in_array($lettre, str_split($_SESSION["mot"])) && !in_array($lettre, $_SESSION["mauvaisesLettres"])) {
        $_SESSION["etatDuPendu"] += 1;
        $_SESSION["mauvaisesLettres"][] = $lettre;
        $_SESSION["message"]["mauvais"] = true;
        /**
         * Sinon si la lettre ne se trouve pas parmi les lettresTrouvees 
         * et qu'elle n'est pas dans les mauvaises lettres
         * alors on l'ajotue au tableau de lettreTrouvees
         * 
         */
    } else if (!in_array($lettre, $_SESSION["lettresTrouvees"]) && !in_array($lettre, $_SESSION["mauvaisesLettres"])) {
        $_SESSION["lettresTrouvees"][] = $lettre;
        $_SESSION["message"]["bon"] = true;
        /**
         * 
         * Sinon, si toutes les conditions ci-dessus ne sont pas vérifiées, 
         * on considère que la lettre entrée n'est pas bonne 
         */
    } else {
        $_SESSION["etatDuPendu"] += 1;
        $_SESSION["message"]["mauvais"] = true;
    }

    /**
     * Le do... while() permet d'executer d'abord l'instruction, puis vérifie la requête
     * 
     * On veut verifier que parmis toutes les lettres trouvées, si elles correspondent toutes 
     * aux lettres du mot caché 
     * Si c'est le cas, le joueur a gagné, sinon on continue
     */
    $index = 0;
    do {
        if ($index == strlen($_SESSION["mot"]) - 1) {
            $_SESSION["message"]["gagné"] = true;
        }
        $index++;
    } while (!$_SESSION["message"]["gagné"] && in_array($_SESSION["mot"][$index], $_SESSION["lettresTrouvees"]));
}

include("vue/header.php");
include("vue/footer.php");

/**
 * On passe tous les messages à false pour le prochain tour
 */
$_SESSION["message"]["mauvais"] = false;
$_SESSION["message"]["bon"]     = false;
$_SESSION["message"]["perdu"]   = false;
$_SESSION["message"]["gagné"]   = false;
