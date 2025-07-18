<?php
$domaine = isset($_GET['domaine']) ? $_GET['domaine'] : null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme d'Étude en Informatique</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #06b6d4;
            --accent: #f59e0b;
            --light: #f8fafc;
            --dark: #1e293b;
            --gray: #64748b;
            --card-bg: #ffffff;
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            --shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 15px 45px rgba(0, 0, 0, 0.15);
            --radius: 16px;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }

        /* Header */
        .header-container {
            background: var(--gradient);
            padding: 1.5rem 2rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo img {
            height: 50px;
            width: auto;
        }

        .logo h1 {
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 2rem;
            animation: fadeIn 0.6s ease-out;
        }

        .section-title {
            text-align: center;
            color: var(--primary-dark);
            font-size: 2.2rem;
            margin-bottom: 3rem;
            font-weight: 700;
            position: relative;
            font-family: 'Montserrat', sans-serif;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--accent);
            margin: 1rem auto 0;
            border-radius: 2px;
        }

        /* Domain Cards */
        .domaines-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2.5rem;
        }

        .domaine-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 2.5rem 2rem 2rem;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(37, 99, 235, 0.1);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .domaine-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--gradient);
        }

        .domaine-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }

        .icon {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary);
        }

        .domaine-card h3 {
            color: var(--primary-dark);
            font-size: 1.4rem;
            margin-bottom: 1rem;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
        }

        .domaine-card p {
            color: var(--gray);
            margin-bottom: 2rem;
            font-size: 1rem;
            flex-grow: 1;
        }

        .etudier-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: var(--primary);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: var(--transition);
            margin-top: auto;
            width: fit-content;
        }

        .etudier-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .etudier-btn i {
            font-size: 0.9rem;
        }

        /* Button */
        .btn-retour {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.9rem 2.2rem;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            margin: 3rem auto 0;
            transition: var(--transition);
            font-weight: 500;
            font-size: 1rem;
            box-shadow: var(--shadow);
        }

        .btn-retour:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.2);
        }

        /* Footer */
        footer {
            margin-top: 4rem;
        }

        .footer-content {
            background: var(--dark);
            color: white;
            text-align: center;
            padding: 3rem 2rem 2rem;
        }

        .footer-content h2 {
            color: var(--accent);
            margin-bottom: 1rem;
            font-size: 1.4rem;
            font-weight: 600;
        }

        .footer-content p {
            margin-bottom: 0.8rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .footer-content p:last-child {
            margin-bottom: 0;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .logo {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }
            
            .logo h1 {
                font-size: 1.5rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .domaines-container {
                grid-template-columns: 1fr;
            }
            
            .main-content {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="logo.png" alt="Logo Plateforme">
                <h1>Culture digitale</h1>
            </div>
        </div>
    </header>

    <div class="main-content">
        <h2 class="section-title">Culture digitale</h2>

        <?php if (!$domaine): ?>
            <h2 class="section-title">Choisissez un domaine d'étude :</h2>
            <div class="domaines-container">
                <!-- Architecture des ordinateurs -->
                <div class="domaine-card">
                    <div class="icon"><i class="fas fa-desktop"></i></div>
                    <h3>Architecture des Ordinateurs</h3>
                    <p>Processeurs, mémoire, bus système, architectures CPU/GPU et principes fondamentaux du matériel informatique.</p>
                    <a href="Architecture_des_ordinateur.php" class="etudier-btn">
                        Étudier <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                <!-- Microsoft Office -->
                <div class="domaine-card">
                    <div class="icon"><i class="fas fa-file-alt"></i></div>
                    <h3>Bureautique (Microsoft Office)</h3>
                    <p>Maîtrisez Word, Excel, PowerPoint et les outils essentiels de productivité professionnelle.</p>
                    <a href="Bureautique.php" class="etudier-btn">
                        Étudier <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                <!-- Internet et Web -->
                <div class="domaine-card">
                    <div class="icon"><i class="fas fa-globe"></i></div>
                    <h3>Internet et Technologie Web</h3>
                    <p>HTTP/HTTPS, DNS, navigateurs, HTML/CSS, services cloud et architectures client-serveur modernes.</p>
                    <a href="internet & web.php" class="etudier-btn">
                        Étudier <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                <!-- Systèmes d'exploitation -->
                <div class="domaine-card">
                    <div class="icon"><i class="fas fa-server"></i></div>
                    <h3>Systèmes d'Exploitation</h3>
                    <p>Windows, Linux, macOS, gestion des processus, mémoire virtuelle et systèmes de fichiers avancés.</p>
                    <a href="Système_d'exploitation.php" class="etudier-btn">
                        Étudier <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                <!-- Intelligence Artificielle -->
                <div class="domaine-card">
                    <div class="icon"><i class="fas fa-robot"></i></div>
                    <h3>Intelligence Artificielle</h3>
                    <p>Réseaux neuronaux, traitement du langage naturel, vision par ordinateur avec TensorFlow/PyTorch.</p>
                    <a href="IA.php" class="etudier-btn">
                        Étudier <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <a href="index.php" class="btn-retour">
                <i class="fas fa-arrow-left"></i> Retour à l'accueil
            </a>
        <?php endif; ?>
    </div>

    <footer>
        <div class="footer-content">
            <h2>Contactez-nous</h2>
            <p><i class="fas fa-envelope"></i> Email : Hamza@plateforme-educative.edu</p>
            <p><i class="fas fa-phone"></i> Téléphone : +212 6 12 34 56 78</p>

            <p>Faculté des sciences et techniques Errachidia</p>
            <p>Cycle d'ingénieur ILIA</p>
        </div>
    </footer>
</body>
</html>