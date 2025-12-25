<?php 
require_once "config.php"; // importe toutes les classes
$role = Session::get('role'); // récupère le role de l'utilisateur, si il n'est pas connecté : null
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- pour que le site s'adapte aux petits écrans -->
    <title>Bibliothèque universitaire</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> <!-- Librairie FontAwesome pour tous les icones -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet"> <!-- Police de google -->
    <script src="js/script.js"></script>
</head>
<body>
    <header> <!-- banière du haut du site -->
        <div class="box">
            <div id="item1">
                <img src="img/logo_uca.png" alt="logo UCA">
            </div>
            <div id="item2">
                <h1>Bibliothèque universitaire</h1> 
            </div>
            <div id="item3">
                <?php if(in_array($role, ['utilisateur', 'biblio', 'admin'])): ?>
                    <a id=bouton_connexion href="script/logout.php">Déconnexion</a>
                <?php else: ?>
                    <a id=bouton_connexion href="login.php">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
        <div class = "menu"> <!-- barre de navigation -->
            <a class="onglet" href="index.php">Accueil</a>
            <a class="onglet" href="search.php">Rechercher</a>
            <a class="onglet" href="info.php">Informations</a>
            <?php if (in_array($role, ['utilisateur', 'biblio', 'admin'])): ?> <!-- uniquement si l'utilisteur est connecté -->
                <a class="onglet" href="compte.php">Mon compte</a>
                <a class="onglet_utilisateur" href="reserv.php">Réservations</a>
                <a class="onglet_bibli" href="pret.php">Prêts/Retours</a>
            <?php endif; ?>
            <?php if(in_array($role, ['biblio', 'admin'])): ?> <!-- uniquement si l'utilisateur est un bibliothéquaire ou un administrateur -->
                <a class="onglet_bibli" href="livre.php">Gestion des livres</a>
                <a class="onglet_bibli" href="user.php">Gestion des utilisateurs</a>
                <a class="onglet_bibli" href="dashboard.php">Statistiques</a>
            <?php endif; ?>
        </div>
    </header>
    <div class="contenu">
        <?php if(Session::get('error') !== null): ?> <!-- affichage des notifications d'erreurs -->
            <div class="alert alert-error">
                <span><?= Session::get('error') ?></span>
                <span class="alert-close" onclick="this.parentElement.style.display='none'">&times;</span>
                <?php Session::remove('error'); ?>
            </div>
        <?php endif; ?>
        <?php if(Session::get('success') !== null): ?> <!-- affichage des notifications de succès -->
            <div class="alert alert-success">
                <span><?= Session::get('success') ?></span>
                <span class="alert-close" onclick="this.parentElement.style.display='none'">&times;</span>
                <?php Session::remove('success'); ?>
            </div>
        <?php endif; ?>