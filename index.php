<?php
session_start();
require 'BD.php';

// Vérification de la connexion
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Récupération des informations de l'utilisateur
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Culture Digitale</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
    :root {
        --primary: #4361ee;
        --primary-light: #e0e7ff;
        --secondary: #3f37c9;
        --dark: #1e293b;
        --light: #f8fafc;
        --gray: #94a3b8;
        --success: #10b981;
        --danger: #ef4444;
        --warning: #f59e0b;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: #f1f5f9;
        color: var(--dark);
        line-height: 1.6;
    }

    /* Header */
    .header {
        background: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .header-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .logo img {
        width: 50px;
        height: 50px;
        object-fit: contain;
    }

    .logo-text {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
    }

    .nav-links {
        display: flex;
        gap: 1.5rem;
        align-items: center;
    }

    .nav-link {
        color: var(--dark);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
    }

    .nav-link:hover {
        color: var(--primary);
        background: var(--primary-light);
    }

    .btn {
        padding: 0.5rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
        border: 2px solid var(--primary);
    }

    .btn-primary:hover {
        background: var(--secondary);
        border-color: var(--secondary);
        transform: translateY(-2px);
    }

    .btn-outline {
        background: transparent;
        color: var(--primary);
        border: 2px solid var(--primary);
    }

    .btn-outline:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
    }

    .welcome-banner {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        padding: 1rem 2rem;
        text-align: center;
    }

    .welcome-text {
        max-width: 1200px;
        margin: 0 auto;
        font-size: 1.1rem;
    }

    /* Main Content */
    .main-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 2rem;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .card {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        padding: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .info-list {
        list-style: none;
    }

    .info-item {
        display: flex;
        margin-bottom: 1rem;
    }

    .info-label {
        font-weight: 600;
        color: var(--dark);
        min-width: 120px;
    }

    .info-value {
        color: var(--gray);
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .action-btn {
        text-align: center;
        padding: 0.75rem;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.3s;
    }

    .hero {
        background: white;
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .hero-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .hero-text {
        color: var(--gray);
        max-width: 700px;
        margin: 0 auto 1.5rem;
    }

    /* Footer */
    .footer {
        background: var(--dark);
        color: white;
        padding: 3rem 2rem 2rem;
        margin-top: 3rem;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .footer-logo {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: white;
    }

    .footer-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: white;
    }

    .footer-links {
        list-style: none;
    }

    .footer-link {
        color: #cbd5e1;
        text-decoration: none;
        margin-bottom: 0.5rem;
        display: block;
        transition: color 0.3s;
    }

    .footer-link:hover {
        color: white;
    }

    .footer-bottom {
        text-align: center;
        padding-top: 2rem;
        margin-top: 2rem;
        border-top: 1px solid #334155;
        color: #94a3b8;
    }

    /* Chatbot */
    .chatbot {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 100;
    }

    .chatbot-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s;
    }

    .chatbot-btn:hover {
        background: var(--secondary);
        transform: scale(1.1);
    }

    .chatbot-btn i {
        font-size: 1.5rem;
    }

    .chatbot-container {
        position: absolute;
        bottom: 80px;
        right: 0;
        width: 350px;
        background: white;
        border-radius: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transform: translateY(20px);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
    }

    .chatbot-container.active {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
    }

    .chatbot-header {
        background: var(--primary);
        color: white;
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chatbot-title {
        font-weight: 600;
    }

    .chatbot-close {
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .chatbot-messages {
        height: 300px;
        overflow-y: auto;
        padding: 1rem;
        background: #f8fafc;
    }

    .message {
        margin-bottom: 1rem;
        display: flex;
    }

    .message-user {
        justify-content: flex-end;
    }

    .message-bot {
        justify-content: flex-start;
    }

    .message-content {
        max-width: 80%;
        padding: 0.75rem 1rem;
        border-radius: 1rem;
        font-size: 0.9rem;
    }

    .message-user .message-content {
        background: var(--primary);
        color: white;
        border-bottom-right-radius: 0.25rem;
    }

    .message-bot .message-content {
        background: white;
        color: var(--dark);
        border: 1px solid #e2e8f0;
        border-bottom-left-radius: 0.25rem;
    }

    .chatbot-input {
        display: flex;
        padding: 1rem;
        border-top: 1px solid #e2e8f0;
    }

    .chatbot-input input {
        flex: 1;
        padding: 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        outline: none;
        font-family: inherit;
    }

    .chatbot-input button {
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 0.5rem;
        padding: 0 1rem;
        margin-left: 0.5rem;
        cursor: pointer;
        transition: background 0.3s;
    }

    .chatbot-input button:hover {
        background: var(--secondary);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .header-container {
            flex-direction: column;
            gap: 1rem;
            padding: 1rem;
        }

        .nav-links {
            width: 100%;
            justify-content: center;
        }

        .main-container {
            padding: 0 1rem;
        }

        .hero-title {
            font-size: 1.5rem;
        }

        .chatbot-container {
            width: 300px;
        }
    }

    @media (max-width: 480px) {
        .nav-links {
            flex-direction: column;
            gap: 0.5rem;
        }

        .grid {
            grid-template-columns: 1fr;
        }

        .chatbot-container {
            width: 280px;
            right: -20px;
        }
    }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <img src="logo2.png" alt="Logo Plateforme">
                <span class="logo-text">Culture Digitale</span>
            </div>
            <nav class="nav-links">
                <a href="index.php" class="nav-link">Accueil</a>
                <a href="cours.php" class="nav-link">Cours</a>
                <a href="goo_QUIZ.php" class="nav-link">Quiz</a>
                <a href="logout.php" class="btn btn-outline">Déconnexion</a>
            </nav>
        </div>
        <div class="welcome-banner">
            <div class="welcome-text">
                Bienvenue, <?= htmlspecialchars($user['prenom']) ?> <?= htmlspecialchars($user['nom']) ?>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-container">
        <section class="hero">
            <h1 class="hero-title">Bienvenue sur Mon palteforme </h1>
            <p class="hero-text">
                Explorez nos ressources éducatives et améliorez vos compétences en informatique.
            </p>
        </section>

        <div class="grid">
            <!-- User Info Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Vos Informations</h2>
                </div>
                <div class="card-body">
                    <ul class="info-list">
                        <li class="info-item">
                            <span class="info-label">Nom :</span>
                            <span class="info-value"><?= htmlspecialchars($user['nom']) ?></span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Prénom :</span>
                            <span class="info-value"><?= htmlspecialchars($user['prenom']) ?></span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Email :</span>
                            <span class="info-value"><?= htmlspecialchars($user['email']) ?></span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Niveau d'étude :</span>
                            <span class="info-value"><?= htmlspecialchars($user['niveau_etude']) ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Resources Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Ressources Disponibles</h2>
                </div>
                <div class="card-body">
                    <div class="action-buttons">
                        <a href="cours.php" class="action-btn btn btn-primary">Accéder aux cours</a>
                        <a href="goo_QUIZ.php" class="action-btn btn btn-outline">Passer les quiz</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col">
                <div class="footer-logo">Plateforme  De Culture Digitale </div>
                <p>Votre plateforme d'apprentissage en ligne pour maîtriser l'informatique.</p>
            </div>
            <div class="footer-col">
                <h3 class="footer-title">Liens rapides</h3>
                <ul class="footer-links">
                    <li><a href="index.php" class="footer-link">Accueil</a></li>
                    <li><a href="cours.php" class="footer-link">Cours</a></li>
                    <li><a href="goo_QUIZ.php" class="footer-link">Quiz</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3 class="footer-title">Contact</h3>
                <ul class="footer-links">
                    <li><a href="mailto:contact@plateforme-educative.edu" class="footer-link">contact@plateforme-educative.edu</a></li>
                    <li><a href="tel:+212612345678" class="footer-link">+212 6 12 34 56 78</a></li>
                </ul>
            </div>
        </div>

    </footer>

    <!-- Chatbot -->
    <div class="chatbot">
        <button class="chatbot-btn" onclick="toggleChatbot()">
            <i class="fas fa-robot"></i>
        </button>
        <div class="chatbot-container" id="chatbotContainer">
            <div class="chatbot-header">
                <h3 class="chatbot-title">Assistant Virtuel</h3>
                <button class="chatbot-close" onclick="toggleChatbot()">×</button>
            </div>
            <div class="chatbot-messages" id="chatbotMessages">
                <div class="message message-bot">
                    <div class="message-content">
                        Bonjour ! Je suis votre assistant virtuel. Comment puis-je vous aider aujourd'hui ?
                    </div>
                </div>
            </div>
            <div class="chatbot-input">
                <input type="text" id="userInput" placeholder="Tapez votre message..." onkeypress="handleKeyPress(event)">
                <button onclick="sendMessage()">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
    function toggleChatbot() {
        const chatbot = document.getElementById('chatbotContainer');
        chatbot.classList.toggle('active');
    }

    function handleKeyPress(event) {
        if (event.key === 'Enter') {
            sendMessage();
        }
    }

    function sendMessage() {
        const userInput = document.getElementById('userInput');
        const message = userInput.value.trim();

        if (message) {
            // Afficher le message utilisateur
            addMessage(message, 'user');
            userInput.value = '';

            // Envoyer à Rasa via REST
            fetch("http://localhost:5005/webhooks/rest/webhook", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    sender: "user", // ID de session (tu peux le rendre dynamique)
                    message: message
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    addMessage("Je n'ai pas compris, pouvez-vous reformuler ?", 'bot');
                } else {
                    data.forEach(msg => {
                        if (msg.text) {
                            addMessage(msg.text, 'bot');
                        }
                    });
                }
            })
            .catch(error => {
                console.error("Erreur Rasa :", error);
                addMessage("Erreur de communication avec le serveur. Veuillez réessayer plus tard.", 'bot');
            });
        }
    }

    function addMessage(text, sender) {
        const chatMessages = document.getElementById('chatbotMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `message message-${sender}`;
        messageDiv.innerHTML = `<div class="message-content">${text}</div>`;
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    </script>
</body>
</html>