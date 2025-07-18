<?php
session_start();
include_once 'BD.php';
require('fpdf.php'); // Inclure la librairie FPDF pour générer des PDF

// Vérification de la restriction de passage du quiz
if (isset($_SESSION['quiz_blocked_until']) && time() < $_SESSION['quiz_blocked_until']) {
    $wait = ceil(($_SESSION['quiz_blocked_until'] - time()) / 3600);
    die('<div style="color:#e74c3c; font-weight:bold; text-align:center; margin:40px 0;">
        ⚠️ Vous devez attendre encore '.$wait.' heure(s) avant de repasser ce quiz.
    </div>');
}

// Fonction pour générer le certificat
function generateCertificate($name, $domain, $score, $total, $logoPath = '') {
    $pdf = new FPDF('L', 'mm', 'A4'); // Paysage
    $pdf->AddPage();

    // Fond dégradé simulé par un grand rectangle bleu clair
    $pdf->SetFillColor(240, 248, 255);
    $pdf->Rect(0, 0, 297, 210, 'F');

    // Bordure décorative
    $pdf->SetDrawColor(38, 208, 206);
    $pdf->SetLineWidth(3);
    $pdf->Rect(8, 8, 281, 194);

    // Logo en haut à gauche
    if (!empty($logoPath) && file_exists($logoPath)) {
        $pdf->Image($logoPath, 18, 15, 36);
    }

    // Titre principal
    $pdf->SetFont('Arial', 'B', 34);
    $pdf->SetTextColor(26, 41, 128);
    $pdf->Cell(0, 35, 'CERTIFICAT DE REUSSITE', 0, 1, 'C');

    // Ligne décorative sous le titre
    $pdf->SetDrawColor(255, 179, 71);
    $pdf->SetLineWidth(1.5);
    $pdf->Line(60, 50, 237, 50);

    // Sous-titre
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 18);
    $pdf->SetTextColor(44, 62, 80);
    $pdf->Cell(0, 12, utf8_decode('Ce certificat est décerné à'), 0, 1, 'C');

    // Nom du participant
    $pdf->SetFont('Arial', 'B', 26);
    $pdf->SetTextColor(38, 208, 206);
    $pdf->Cell(0, 18, utf8_decode($name), 0, 1, 'C');

    // Domaine
    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 16);
    $pdf->SetTextColor(44, 62, 80);
    $pdf->Cell(0, 10, utf8_decode('Pour avoir réussi le quiz du domaine :'), 0, 1, 'C');

    $pdf->SetFont('Arial', 'B', 22);
    $pdf->SetTextColor(255, 179, 71);
    $pdf->Cell(0, 15, strtoupper(utf8_decode($domain)), 0, 1, 'C');

    // Score
    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 16);
    $pdf->SetTextColor(44, 62, 80);
    $pdf->Cell(0, 10, utf8_decode("Avec un score de $score / $total"), 0, 1, 'C');

    // Message de félicitations
    $pdf->Ln(6);
    $pdf->SetFont('Arial', '', 13);
    $pdf->SetTextColor(44, 62, 80);
    $pdf->MultiCell(0, 9, utf8_decode("Félicitations pour votre performance ! Ce certificat atteste de votre engagement et de votre réussite dans le domaine $domain."), 0, 'C');

    // Date et signature
    $pdf->Ln(18);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(44, 62, 80);
    $pdf->Cell(0, 10, utf8_decode('Fait le : '.date('d/m/Y')), 0, 1, 'R');

    $pdf->SetFont('Arial', 'I', 14);
    $pdf->SetTextColor(44, 62, 80);
    $pdf->Cell(0, 10, utf8_decode("Hamza Baadi "), 0, 1, 'R');

    // Sauvegarder le PDF
    if (!is_dir('certificates')) {
        mkdir('certificates');
    }
    $filename = 'certificat_'.str_replace(' ', '_', $name).'_'.date('Ymd').'.pdf';
    $pdf->Output('F', 'certificates/'.$filename);

    return $filename;
}

// Étape 1 : Récupérer les domaines
if (!isset($_POST['domain'])) {
    $stmt = $pdo->query("SELECT DISTINCT domain FROM quiz");
    $domains = $stmt->fetchAll(PDO::FETCH_COLUMN);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Quiz Informatique</title>
    <style>/* Global Reset and Base Styles */
* /* Global Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg, #e0e7ff 0%, #f1f5f9 100%);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 20px;
    color: #1f2937;
}

/* Container */
.container {
    max-width: 900px;
    width: 100%;
    margin: 40px auto;
    background: #ffffff;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
    border: 1px solid #e5e7eb;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.container:hover {
    box-shadow: 0 12px 48px rgba(0, 0, 0, 0.1);
}

/* Headings */
h1 {
    font-size: 2.5rem;
    color: #4f46e5;
    text-align: center;
    margin-bottom: 24px;
    font-weight: 700;
    letter-spacing: -0.025em;
}

h2 {
    font-size: 1.75rem;
    color: #4f46e5;
    text-align: center;
    margin-bottom: 20px;
    font-weight: 600;
}

/* Forms and Inputs */
.domain-select, .quiz, .result {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

select, input[type="text"] {
    width: 100%;
    padding: 12px 16px;
    font-size: 1rem;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    background: #f9fafb;
    transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
}

select:focus, input[type="text"]:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    outline: none;
    background: #ffffff;
}

/* Buttons */
button, .btn {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    padding: 12px 24px;
    font-size: 1rem;
    font-weight: 600;
    color: #ffffff;
    background: linear-gradient(90deg, #4f46e5 0%, #7c3aed 100%);
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s, box-shadow 0.2s;
    text-decoration: none;
}

button:hover, .btn:hover {
    background: linear-gradient(90deg, #4338ca 0%, #6d28d9 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

button:active, .btn:active {
    transform: translateY(0);
}

button[disabled], .btn[disabled] {
    background: #d1d5db;
    cursor: not-allowed;
    box-shadow: none;
}

/* Questions */
.question {
    background: #f9fafb;
    padding: 20px;
    border-radius: 12px;
    border-left: 5px solid #4f46e5;
    margin-bottom: 20px;
    transition: transform 0.2s, box-shadow 0.2s;
}

.question:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

.question strong {
    display: block;
    font-size: 1.1rem;
    color: #1f2937;
    margin-bottom: 12px;
}

.options label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
    font-size: 1rem;
    color: #374151;
    cursor: pointer;
}

.options input[type="radio"] {
    width: 18px;
    height: 18px;
    accent-color: #4f46e5;
}

.options input[type="radio"]:checked + span {
    color: #4f46e5;
    font-weight: 600;
}

/* Feedback Styles */
.correct {
    color: #16a34a;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.incorrect {
    color: #dc2626;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Score and Certificate */
.score {
    font-size: 2rem;
    color: #4f46e5;
    text-align: center;
    margin: 24px 0;
    font-weight: 700;
}

.certificate-link {
    text-align: center;
    margin-top: 24px;
}

/* Divider */
hr {
    border: none;
    height: 1px;
    background: #e5e7eb;
    margin: 24px 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    body {
        padding: 16px;
    }

    .container {
        padding: 24px;
        margin: 20px auto;
    }

    h1 {
        font-size: 2rem;
    }

    h2 {
        font-size: 1.5rem;
    }

    button, .btn {
        width: 100%;
        padding: 12px;
    }

    .question {
        padding: 16px;
    }
}

@media (max-width: 480px) {
    h1 {
        font-size: 1.75rem;
    }

    h2 {
        font-size: 1.25rem;
    }

    select, input[type="text"] {
        font-size: 0.95rem;
    }

    .question strong {
        font-size: 1rem;
    }

    .options label {
        font-size: 0.95rem;
    }
}
    </style>
</head>
<body>

<div class="container">
    <h1>Quiz Informatique</h1>

    <?php
    // Étape 1 : Choisir un domaine
    if (!isset($_POST['domain']) && !isset($_POST['answers'])):
    ?>
        <form method="POST" class="domain-select">
            <h2>Choisissez un domaine :</h2>
            <select name="domain" required>
                <option value="">-- Sélectionnez un domaine --</option>
                <?php foreach ($domains as $domain): ?>
                    <option value="<?= htmlspecialchars($domain) ?>"><?= htmlspecialchars($domain) ?></option>
                <?php endforeach; ?>
            </select>
            <div>
                <label for="name">Votre nom :</label>
                <input type="text" name="name" id="name" required>
            </div>
            <button type="submit">Commencer le quiz</button>
        </form>

    <?php
    // Étape 2 : Afficher les questions du domaine choisi
    elseif (isset($_POST['domain']) && !isset($_POST['answers'])):
        $selectedDomain = $_POST['domain'];
        $participantName = $_POST['name'];
        $_SESSION['domain'] = $selectedDomain;
        $_SESSION['name'] = $participantName;

        $stmt = $pdo->prepare("SELECT * FROM quiz WHERE domain = ?");
        $stmt->execute([$selectedDomain]);
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION['questions'] = $questions; // Stocker pour la correction
    ?>

        <form method="POST" class="quiz">
            <h2>Quiz : <?= htmlspecialchars($selectedDomain) ?></h2>
            <p>Participant : <?= htmlspecialchars($participantName) ?></p>

            <?php foreach ($questions as $index => $q): ?>
                <div class="question">
                    <strong><?= ($index + 1) . '. ' . htmlspecialchars($q['question']) ?></strong>
                    <div class="options">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <label>
                                <input type="radio" name="answers[<?= $index ?>]" value="<?= $i ?>" required>
                                <?= htmlspecialchars($q['option'.$i]) ?>
                            </label>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <button type="submit">Valider mes réponses</button>
        </form>

    <?php
    // Étape 3 : Correction du quiz et génération du certificat
    elseif (isset($_POST['answers'])):
        $userAnswers = $_POST['answers'];
        $questions = $_SESSION['questions'];
        $domain = $_SESSION['domain'];
        $name = $_SESSION['name'];

        $score = 0;
        $total = count($questions);

        // Calcul du score
        foreach ($questions as $index => $q) {
            if (isset($userAnswers[$index])) {
                $userAnswerText = $q['option' . $userAnswers[$index]];
                if ($userAnswerText === $q['correct_answer']) {
                    $score++;
                }
            }
        }

        // Vérification du score pour la restriction
        $scoreMin = 12;
        $scoreMax = $total;
        $canRetry = ($score >= $scoreMin);

        // Enregistrement de la date de passage si score insuffisant
        if (!$canRetry) {
            $_SESSION['quiz_blocked_until'] = time() + 24 * 3600;
        }

        // Générer le certificat
        $logoPath = 'logo.png'; // Chemin vers votre logo
        $certificateFile = generateCertificate($name, $domain, $score, $total, $logoPath);
    ?>

        <div class="result">
            <h2>Correction du Quiz</h2>
            <p>Participant : <?= htmlspecialchars($name) ?></p>
            <p>Domaine : <?= htmlspecialchars($domain) ?></p>

            <?php foreach ($questions as $index => $q): ?>
                <div class="question">
                    <strong><?= ($index + 1) . '. ' . htmlspecialchars($q['question']) ?></strong>
                    <div class="options">
                        <p><strong>Votre réponse :</strong> 
                            <?php
                            $userChoice = $userAnswers[$index] ?? null;
                            if ($userChoice) {
                                echo htmlspecialchars($q['option'.$userChoice]);
                            } else {
                                echo "<em>Aucune réponse</em>";
                            }
                            ?>
                        </p>

                        <p><strong>Bonne réponse :</strong> <?= htmlspecialchars($q['correct_answer']) ?></p>

                       <?php
$userAnswerText = $userChoice ? $q['option'.$userChoice] : null;
?>
<?php if ($userAnswerText === $q['correct_answer']): ?>
    <p class="correct">✅ Correct</p>
<?php else: ?>
    <p class="incorrect">❌ Incorrect</p>
<?php endif; ?>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>

            <div class="score">
                <h3>Votre Score : <?= $score ?> / <?= $total ?></h3>
            </div>



            <?php if ($canRetry): ?>
                <div class="certificate-link">
                    <a href="certificates/<?= $certificateFile ?>" class="btn" download>Télécharger votre certificat</a>
                </div>
            <?php else: ?>
                <div style="color:#e74c3c; font-weight:bold; text-align:center; margin:20px 0;">
                    ⚠️ Votre score est inférieur à <?= $scoreMin ?>/<?= $scoreMax ?>.<br>
                    Vous ne pouvez pas télécharger le certificat.<br>
                    Vous pourrez refaire le quiz après 24 heures.
                </div>
            <?php endif; ?>

            <form method="POST">
                <button type="submit" <?= !$canRetry ? 'disabled style="opacity:0.5;cursor:not-allowed;"' : '' ?>>Refaire un quiz</button>
            </form>
        </div>

        <?php session_destroy(); ?>

    <?php
    else:
        // Vérification de la session pour la correction
        if (
            !isset($_SESSION['questions']) ||
            !isset($_SESSION['domain']) ||
            !isset($_SESSION['name'])
        ) {
            echo "<p style='color:red;text-align:center;'>Erreur : Quiz non démarré ou session expirée.<br>Veuillez recommencer depuis la page d'accueil du quiz.</p>";
            exit;
        }
    endif;
    ?>
</div>

</body>
</html>