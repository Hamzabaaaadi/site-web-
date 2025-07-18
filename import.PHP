<?php
require 'quiz_data.php';

// Connexion à MySQL
$conn = new mysqli("localhost", "root", "", "culture");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Insérer les questions
foreach ($quizzes as $quiz) {
    $domain = $conn->real_escape_string($quiz["domain"]);
    $question = $conn->real_escape_string($quiz["question"]);
    $options = array_map([$conn, 'real_escape_string'], $quiz["options"]);
    $answer = $quiz["answer"];

    $sql = "INSERT INTO quiz (domain, question, option1, option2, option3, option4, correct_answer)
            VALUES ('$domain', '$question', '{$options[0]}', '{$options[1]}', '{$options[2]}', '{$options[3]}', $answer)";
    if (!$conn->query($sql)) {
        echo "Erreur : " . $conn->error . "<br>";
    }
}

echo "✅ Importation des quiz terminée avec succès !";
$conn->close();
?>
