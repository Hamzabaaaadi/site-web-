<?php
session_start();
require 'BD.php'; // Votre fichier de connexion à la DB

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Requête pour récupérer l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Vérification du mot de passe
        if (password_verify($password, $user['password'])) {
            // Création de la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['niveau_etude'] = $user['niveau_etude'];
            
            // Redirection avec exit() pour s'assurer que le script s'arrête
            header("Location: index.php");
            exit();
        } else {
            $error = "Mot de passe incorrect";
        }
    } else {
        $error = "Aucun compte trouvé avec cet email";
    }
}

// Si l'utilisateur est déjà connecté, rediriger vers index.php
if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Plateforme Éducative</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --error-gradient: linear-gradient(135deg, #ff6b6b 0%, #ffa8a8 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
            --text-light: #718096;
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --shadow-xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
            z-index: -1;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 100px;
            height: 100px;
            top: 15%;
            left: 15%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 150px;
            height: 150px;
            top: 25%;
            right: 15%;
            animation-delay: 3s;
        }

        .shape:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 25%;
            left: 25%;
            animation-delay: 6s;
        }

        .shape:nth-child(4) {
            width: 60px;
            height: 60px;
            bottom: 15%;
            right: 30%;
            animation-delay: 1s;
        }

        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg) scale(1); 
                opacity: 0.7;
            }
            50% { 
                transform: translateY(-30px) rotate(180deg) scale(1.1); 
                opacity: 1;
            }
        }

        .welcome-animation {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            animation: pulse 4s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes pulse {
            0%, 100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 0.3;
            }
            50% {
                transform: translate(-50%, -50%) scale(1.2);
                opacity: 0.1;
            }
        }

        header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo i {
            font-size: 2rem;
            background: var(--secondary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.3));
            }
            to {
                filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.6));
            }
        }

        .logo h1 {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 160px);
            padding: 2rem;
            position: relative;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            box-shadow: var(--shadow-xl);
            animation: slideUp 0.8s ease-out;
            position: relative;
            z-index: 10;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            border-radius: 24px 24px 0 0;
        }

        .form-container::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, rgba(255,255,255,0.1), transparent, rgba(255,255,255,0.1));
            border-radius: 26px;
            z-index: -1;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .section-title {
            text-align: center;
            color: white;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--secondary-gradient);
            border-radius: 2px;
        }

        .section-subtitle {
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            margin-bottom: 2.5rem;
            font-weight: 400;
        }

        .welcome-message {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .welcome-message h3 {
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .welcome-message p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 16px;
            margin-bottom: 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: shake 0.5s ease-in-out;
        }

        .alert-error {
            background: rgba(255, 107, 107, 0.15);
            border: 1px solid rgba(255, 107, 107, 0.3);
            color: #ff6b6b;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 1.25rem 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            color: white;
            font-size: 1rem;
            font-weight: 400;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            position: relative;
        }

        .form-control:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-group {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .form-group:nth-child(1) { animation-delay: 0.2s; }
        .form-group:nth-child(2) { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn {
            width: 100%;
            padding: 1.25rem;
            background: var(--secondary-gradient);
            border: none;
            border-radius: 16px;
            color: white;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out 0.6s forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: translateY(-1px);
        }

        .register-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            animation: fadeInUp 0.6s ease-out 0.8s forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .register-link p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .register-link a {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .forgot-password {
            text-align: center;
            margin-top: 1rem;
        }

        .forgot-password a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: white;
        }

        footer {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem 0;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }

        .footer-content h2 {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-content p {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        @media (max-width: 768px) {
            .form-container {
                margin: 1rem;
                padding: 2rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .header-container,
            .footer-content {
                padding: 0 1rem;
            }

            .welcome-message {
                padding: 1rem;
            }
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: 3px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="welcome-animation"></div>

    <header>
        <div class="header-container">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
                <h1>Plateforme Éducative</h1>
            </div>
        </div>
    </header>

    <div class="main-content">
        <div class="form-container">
            <h2 class="section-title">Connexion</h2>
            <p class="section-subtitle">Accédez à votre espace personnel</p>
            
            <div class="welcome-message">
                <h3><i class="fas fa-hand-wave"></i> Bon retour !</h3>
                <p>Connectez-vous pour continuer votre parcours d'apprentissage</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= $error ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" id="loginForm">
                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Adresse email
                    </label>
                    <input type="email" id="email" name="email" class="form-control" 
                           placeholder="votre@email.com" required>
                </div>
                
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Mot de passe
                    </label>
                    <input type="password" id="password" name="password" class="form-control" 
                           placeholder="Votre mot de passe" required>
                </div>

                <div class="forgot-password">
                    <a href="#"><i class="fas fa-key"></i> Mot de passe oublié ?</a>
                </div>
                
                <button type="submit" class="btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Se connecter
                </button>
            </form>
            
            <div class="register-link">
                <p>Première visite sur notre plateforme ?</p>
                <a href="inscription.php">
                    <i class="fas fa-user-plus"></i>
                    Créer un compte gratuitement
                </a>
            </div>
        </div>
    </div>

    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <footer>
        <div class="footer-content">
            <h2>Contactez-nous</h2>
            <p><i class="fas fa-envelope"></i> contact@plateforme-educative.edu</p>
            <p><i class="fas fa-phone"></i> +212 6 12 34 56 78</p>
        </div>
    </footer>

    <script>
        // Animation du formulaire de connexion
        document.getElementById('loginForm').addEventListener('submit', function() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        });

        // Animation des champs au focus
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Animation de typing pour le titre
        function typeWriter(element, text, speed = 100) {
            let i = 0;
            element.innerHTML = '';
            
            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            type();
        }

        // Démarrer l'animation après le chargement
        window.addEventListener('load', function() {
            setTimeout(() => {
                const title = document.querySelector('.section-title');
                typeWriter(title, 'Connexion', 150);
            }, 500);
        });
    </script>
</body>
</html>