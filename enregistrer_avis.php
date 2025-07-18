<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "culture"; // Remplace par le nom de ta base

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

if (
    isset($_POST['prenom'], $_POST['nom'], $_POST['avis'])
) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $avis = $_POST['avis'];

    // Préparation et exécution de la requête
    $stmt = $conn->prepare("INSERT INTO avis (prenom, nom, email, avis) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $prenom, $nom, $email, $avis);

    if ($stmt->execute()) {
        echo "Merci pour votre avis !";
    } else {
        echo "Erreur lors de l'enregistrement : " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Veuillez remplir tous les champs obligatoires.";
}
$conn->close();
?>