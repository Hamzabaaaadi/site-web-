<?php
require 'BD.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nettoyage des entrées
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $cin = htmlspecialchars(trim($_POST['cin']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $niveau_etude = htmlspecialchars(trim($_POST['niveau_etude']));
    
    // Validation des données
    if (empty($nom) || empty($prenom) || empty($cin) || empty($email) || empty($_POST['password']) || empty($niveau_etude)) {
        $error = "Tous les champs sont obligatoires";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format d'email invalide";
    } elseif (strlen($_POST['password']) < 8) {
        $error = "Le mot de passe doit contenir au moins 8 caractères";
    } else {
        // Hachage sécurisé du mot de passe
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        
        try {
            // Vérification des doublons
            $stmt = $pdo->prepare("SELECT id FROM users WHERE cin = ? OR email = ?");
            $stmt->execute([$cin, $email]);
            
            if ($stmt->rowCount() > 0) {
                $error = "Ce CIN ou email est déjà utilisé";
            } else {
                // Insertion sécurisée
                $stmt = $pdo->prepare("INSERT INTO users (nom, prenom, cin, email, password, niveau_etude) VALUES (?, ?, ?, ?, ?, ?)");
                
                if ($stmt->execute([$nom, $prenom, $cin, $email, $password, $niveau_etude])) {
                    $_SESSION['inscription_success'] = true;
                    header("Location: login.php?success=1");
                    exit();
                }
            }
        } catch (PDOException $e) {
            $error = "Erreur technique: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Plateforme Éducative</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --error-gradient: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
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
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 20%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
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
        }

        .form-container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 500px;
            box-shadow: var(--shadow-xl);
            animation: slideUp 0.8s ease-out;
            position: relative;
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

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title {
            text-align: center;
            color: white;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .section-subtitle {
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            margin-bottom: 2rem;
            font-weight: 400;
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
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.25rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            color: white;
            font-size: 1rem;
            font-weight: 400;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
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

        .password-hint {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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

        .login-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .login-link p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
        }

        .login-link a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .login-link a:hover {
            background: rgba(255, 255, 255, 0.1);
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
                font-size: 1.75rem;
            }
            
            .header-container,
            .footer-content {
                padding: 0 1rem;
            }
        }

        /* Animation d'apparition des éléments */
        .form-group {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }
        .form-group:nth-child(6) { animation-delay: 0.6s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn {
            animation: fadeInUp 0.6s ease-out 0.7s forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .login-link {
            animation: fadeInUp 0.6s ease-out 0.8s forwards;
            opacity: 0;
            transform: translateY(20px);
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

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
            <h2 class="section-title">Créer un compte</h2>
            <p class="section-subtitle">Rejoignez notre plateforme éducative innovante</p>
            
            <?php if ($error): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= $error ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" autocomplete="off">
                <div class="form-group">
                    <label for="nom"><i class="fas fa-user"></i> Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" 
                           value="<?= isset($nom) ? $nom : '' ?>" 
                           placeholder="Votre nom de famille" required>
                </div>

                <div class="form-group">
                    <label for="prenom"><i class="fas fa-user"></i> Prénom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" 
                           value="<?= isset($prenom) ? $prenom : '' ?>" 
                           placeholder="Votre prénom" required>
                </div>
                
                <div class="form-group">
                    <label for="cin"><i class="fas fa-id-card"></i> Numéro CIN</label>
                    <input type="text" id="cin" name="cin" class="form-control" 
                           value="<?= isset($cin) ? $cin : '' ?>" 
                           placeholder="Votre numéro CIN" required>
                </div>
                
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="email" name="email" class="form-control" 
                           value="<?= isset($email) ? $email : '' ?>" 
                           placeholder="votre@email.com" required>
                </div>
                
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" 
                           placeholder="Créez un mot de passe sécurisé" required>
                    <div class="password-hint">
                        <i class="fas fa-info-circle"></i>
                        Minimum 8 caractères
                    </div>
                </div>

                <div class="form-group">
                    <label for="niveau_etude"><i class="fas fa-graduation-cap"></i> Niveau d'étude</label>
                    <select id="niveau_etude" name="niveau_etude" class="form-control" required>
                        <option value="">Sélectionnez votre niveau...</option>
                        <option value="Bac" <?= (isset($niveau_etude) && $niveau_etude === 'Bac') ? 'selected' : '' ?>>Baccalauréat</option>
                        <option value="Licence" <?= (isset($niveau_etude) && $niveau_etude === 'Licence') ? 'selected' : '' ?>>Licence</option>
                        <option value="Master" <?= (isset($niveau_etude) && $niveau_etude === 'Master') ? 'selected' : '' ?>>Master</option>
                        <option value="Doctorat" <?= (isset($niveau_etude) && $niveau_etude === 'Doctorat') ? 'selected' : '' ?>>Doctorat</option>
                    </select>
                </div>
                
                <button type="submit" class="btn">
                    <i class="fas fa-user-plus"></i>
                    S'inscrire maintenant
                </button>
            </form>
            
            <div class="login-link">
                <p>Déjà membre de notre plateforme ?</p>
                <a href="login.php">
                    <i class="fas fa-sign-in-alt"></i>
                    Se connecter
                </a>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <h2>Contactez-nous</h2>
            <p><i class="fas fa-envelope"></i> contact@plateforme-educative.edu</p>
            <p><i class="fas fa-phone"></i> +212 6 12 34 56 78</p>
        </div>
    </footer>
</body>
</html>