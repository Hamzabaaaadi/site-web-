<?php
// Fichier: logout.php

// Démarrer la session
session_start();

// Détruire toutes les données de session
$_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également
// le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Finalement, détruire la session
session_destroy();

// Rediriger vers la page d'accueil avec un message de succès
header("Location: index.php?logout=1");
exit();
?>