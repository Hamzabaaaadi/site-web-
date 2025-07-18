<?php include 'BD.php'; ?>

<div class="course-container">
    <header class="course-header">
        <h1 class="course-title">Chapitre 1 : Architecture des ordinateurs</h1>
        <div class="course-progress">
            <div class="progress-bar">
                <div class="progress-fill" style="width: 20%;"></div>
            </div>
            <span>20% complété</span>
        </div>
    </header>

    <main class="course-content">
        <!-- Section 1.1 -->
        <section class="lesson-section">
            <h2 class="lesson-title">1.1 Histoire des ordinateurs</h2>
            
            <div class="exploration-panel">
                <button class="exploration-toggle" onclick="toggleDesc(this)">
                    <i class="fas fa-lightbulb"></i> À explorer et à pratiquer
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="exploration-content">
                    <p>Découvrez l’évolution des ordinateurs à travers la vidéo proposée. Notez les grandes étapes historiques et les inventions majeures qui vous marquent. Utilisez le PDF pour approfondir certains points et partagez sur le forum ce qui vous a surpris ou ce que vous retenez de cette histoire.</p>
                </div>
            </div>
            
            <div class="resources-section">
                <h3 class="resources-title">
                    <i class="fas fa-book-open"></i> Ressources
                </h3>
                
                <div class="resource-grid">
                    <!-- Vidéo -->
                    <div class="resource-card video-resource">
                        <div class="resource-header">
                            <i class="fas fa-video"></i>
                            <h4>Vidéo complémentaire</h4>
                        </div>
                        <div class="video-container">
                            <iframe src="Vidio/1-1 Histoire des ordinateurs.mp4"
                                    frameborder="0"
                                    allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                    
                    <!-- PDF -->
                    <div class="resource-card pdf-resource">
                        <div class="resource-header">
                            <i class="fas fa-file-pdf"></i>
                            <h4>Support de cours</h4>
                        </div>
                        <div class="resource-body">
                            <p>Téléchargez le support de cours complet</p>
                            <a href="PDF/support de cours - Histoire de lévolution des ordinateurs.pdf" download class="download-btn">
                                <i class="fas fa-download"></i> Télécharger le PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 1.2 -->
        <section class="lesson-section">
            <h2 class="lesson-title">1.2 Composant d'un Ordinateur</h2>
            
            <div class="exploration-panel">
                <button class="exploration-toggle" onclick="toggleDesc(this)">
                    <i class="fas fa-lightbulb"></i> À explorer et à pratiquer
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="exploration-content">
                    <p>Regardez attentivement les vidéos sur les composants d'un ordinateur. Essayez d'identifier le rôle de chaque composant et faites un schéma ou une liste pour vous aider à mémoriser. Appuyez-vous sur le support PDF pour compléter vos notes et posez vos questions sur le forum si un élément reste flou.</p>
                </div>
            </div>
            
            <div class="resources-section">
                <h3 class="resources-title">
                    <i class="fas fa-book-open"></i> Ressources
                </h3>
                
                <div class="resource-grid">
                    <!-- Vidéo -->
                    <div class="resource-card video-resource">
                        <div class="resource-header">
                            <i class="fas fa-video"></i>
                            <h4>Vidéo complémentaire</h4>
                        </div>
                        <div class="video-container">
                            <iframe src="Vidio/1-2 Composants principaux d'un ordinateur.mp4" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                    
                    <!-- PDF -->
                    <div class="resource-card pdf-resource">
                        <div class="resource-header">
                            <i class="fas fa-file-pdf"></i>
                            <h4>Support de cours</h4>
                        </div>
                        <div class="resource-body">
                            <p>Téléchargez le support de cours complet</p>
                            <a href="PDF/support de cours - composants des ordinateurs.pdf" download class="download-btn">
                                <i class="fas fa-download"></i> Télécharger le PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 1.3 -->
        <section class="lesson-section">
            <h2 class="lesson-title">1.3 Les périphériques</h2>
            
            <div class="exploration-panel">
                <button class="exploration-toggle" onclick="toggleDesc(this)">
                    <i class="fas fa-lightbulb"></i> À explorer et à pratiquer
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="exploration-content">
                    <p>Visionnez la vidéo sur les périphériques et essayez de distinguer les différents types (entrée, sortie, stockage). Donnez des exemples issus de votre quotidien. Utilisez le PDF pour approfondir et partagez vos exemples ou questions sur le forum pour enrichir la discussion.</p>
                </div>
            </div>
            
            <div class="resources-section">
                <h3 class="resources-title">
                    <i class="fas fa-book-open"></i> Ressources
                </h3>
                
                <div class="resource-grid">
                    <!-- Vidéo -->
                    <div class="resource-card video-resource">
                        <div class="resource-header">
                            <i class="fas fa-video"></i>
                            <h4>Vidéo complémentaire</h4>
                        </div>
                        <div class="video-container">
                            <iframe src="Vidio/1-3 Les périphériques (1).mp4" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                    
                    <!-- PDF -->
                    <div class="resource-card pdf-resource">
                        <div class="resource-header">
                            <i class="fas fa-file-pdf"></i>
                            <h4>Support de cours</h4>
                        </div>
                        <div class="resource-body">
                            <p>Téléchargez le support de cours complet</p>
                            <a href="PDF/support de cours - périphériques dentrée et de sortie.pdf" download class="download-btn">
                                <i class="fas fa-download"></i> Télécharger le PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 1.4 -->
        <section class="lesson-section">
            <h2 class="lesson-title">1.4 Evolution du microprocesseur</h2>
            
            <div class="exploration-panel">
                <button class="exploration-toggle" onclick="toggleDesc(this)">
                    <i class="fas fa-lightbulb"></i> À explorer et à pratiquer
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="exploration-content">
                    <p>Explorez l'évolution du microprocesseur à travers la vidéo. Repérez les grandes avancées technologiques et réfléchissez à leur impact sur la puissance des ordinateurs. Complétez vos connaissances avec le PDF et échangez vos réflexions sur le forum.</p>
                </div>
            </div>
            
            <div class="resources-section">
                <h3 class="resources-title">
                    <i class="fas fa-book-open"></i> Ressources
                </h3>
                
                <div class="resource-grid">
                    <!-- Vidéo -->
                    <div class="resource-card video-resource">
                        <div class="resource-header">
                            <i class="fas fa-video"></i>
                            <h4>Vidéo complémentaire</h4>
                        </div>
                        <div class="video-container">
                            <iframe src="Vidio/1-4 Evolution Du Microprocesseur.mp4" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                    
                    <!-- PDF -->
                    <div class="resource-card pdf-resource">
                        <div class="resource-header">
                            <i class="fas fa-file-pdf"></i>
                            <h4>Support de cours</h4>
                        </div>
                        <div class="resource-body">
                            <p>Téléchargez le support de cours complet</p>
                            <a href="PDF/support de cours - evolution du microprocesseur.pdf" download class="download-btn">
                                <i class="fas fa-download"></i> Télécharger le PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 1.5 -->
        <section class="lesson-section">
            <h2 class="lesson-title">1.5 Fonctionnement du microprocesseur</h2>
            
            <div class="exploration-panel">
                <button class="exploration-toggle" onclick="toggleDesc(this)">
                    <i class="fas fa-lightbulb"></i> À explorer et à pratiquer
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="exploration-content">
                    <p>Regardez la vidéo pour comprendre comment fonctionne un microprocesseur. Essayez de résumer les étapes principales de son fonctionnement avec vos propres mots ou à l'aide d'un schéma. Utilisez le PDF pour vérifier vos réponses et posez vos questions sur le forum si besoin.</p>
                </div>
            </div>
            
            <div class="resources-section">
                <h3 class="resources-title">
                    <i class="fas fa-book-open"></i> Ressources
                </h3>
                
                <div class="resource-grid">
                    <!-- Vidéo -->
                    <div class="resource-card video-resource">
                        <div class="resource-header">
                            <i class="fas fa-video"></i>
                            <h4>Vidéo complémentaire</h4>
                        </div>
                        <div class="video-container">
                            <iframe src="Vidio/1-5 Fonctionnement du microprocesseur.mp4" 
                                    frameborder="0" 
                                    allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                    
                    <!-- PDF -->
                    <div class="resource-card pdf-resource">
                        <div class="resource-header">
                            <i class="fas fa-file-pdf"></i>
                            <h4>Support de cours</h4>
                        </div>
                        <div class="resource-body">
                            <p>Téléchargez le support de cours complet</p>
                            <a href="PDF/support de cours - fonctionnement du microprocesseur.pdf" download class="download-btn">
                                <i class="fas fa-download"></i> Télécharger le PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Feedback Section -->
        <section class="feedback-section">
            <button class="feedback-toggle" id="showAvisForm">
                <i class="fas fa-comment-dots"></i> Donner mon avis sur ce chapitre
            </button>
            
            <form id="avisForm" action="enregistrer_avis.php" method="post" class="feedback-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="domaine">Domaine</label>
                    <select id="domaine" name="domaine" required>
                        <option value="">-- Choisissez un domaine --</option>
                        <option value="Architecture_des_ordinateur">Architecture des ordinateurs</option>
                        <option value="Bureautique">Bureautique</option>
                        <option value="internet&web">Internet & Web</option>
                        <option value="Système_d'exploitation">Système d'exploitation</option>
                        <option value="IA">IA</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="avis">Votre avis</label>
                    <textarea id="avis" name="avis" rows="3" required></textarea>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Envoyer
                </button>
            </form>
        </section>
    </main>
</div>

<script>
    // Toggle exploration content
    function toggleDesc(button) {
        const content = button.parentElement.querySelector('.exploration-content');
        const icon = button.querySelector('.fa-chevron-down');
        
        content.classList.toggle('active');
        icon.classList.toggle('active');
        
        if (content.classList.contains('active')) {
            content.style.maxHeight = content.scrollHeight + 'px';
        } else {
            content.style.maxHeight = '0';
        }
    }

    // Toggle feedback form
    document.getElementById('showAvisForm').addEventListener('click', function(e) {
        e.preventDefault();
        const form = document.getElementById('avisForm');
        form.classList.toggle('active');
        
        if (form.classList.contains('active')) {
            form.style.maxHeight = form.scrollHeight + 'px';
        } else {
            form.style.maxHeight = '0';
        }
    });

    // Initialize all exploration contents as closed
    document.addEventListener('DOMContentLoaded', function() {
        const contents = document.querySelectorAll('.exploration-content');
        contents.forEach(content => {
            content.style.maxHeight = '0';
        });
        
        // Initialize feedback form as closed
        const feedbackForm = document.getElementById('avisForm');
        feedbackForm.style.maxHeight = '0';
    });
</script>

<style>
    :root {
        --primary: #4361ee;
        --primary-light: #e0e7ff;
        --primary-dark: #3a0ca3;
        --secondary: #4cc9f0;
        --accent: #f72585;
        --success: #2ec4b6;
        --warning: #ff9f1c;
        --danger: #e71d36;
        --dark: #1a1a2e;
        --gray: #6c757d;
        --light: #f8f9fa;
        --light-gray: #e9ecef;
        --border-radius: 12px;
        --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', 'Roboto', sans-serif;
        line-height: 1.6;
        color: var(--dark);
        background-color: #f5f7ff;
        padding: 20px;
    }

    .course-container {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
    }

    .course-header {
        padding: 30px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        text-align: center;
        position: relative;
    }

    .course-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent), var(--secondary));
    }

    .course-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .course-progress {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        margin-top: 15px;
    }

    .progress-bar {
        width: 200px;
        height: 8px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: white;
        border-radius: 4px;
        transition: width 0.5s ease;
    }

    .course-content {
        padding: 30px;
    }

    .lesson-section {
        margin-bottom: 40px;
        border-bottom: 1px solid var(--light-gray);
        padding-bottom: 30px;
    }

    .lesson-section:last-child {
        border-bottom: none;
    }

    .lesson-title {
        font-size: 1.5rem;
        color: var(--primary-dark);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--light-gray);
    }

    .exploration-panel {
        margin-bottom: 25px;
    }

    .exploration-toggle {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        padding: 15px 20px;
        background: var(--primary-light);
        color: var(--primary-dark);
        border: none;
        border-radius: var(--border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
    }

    .exploration-toggle:hover {
        background: #d5dcff;
    }

    .exploration-toggle i.fa-chevron-down {
        margin-left: auto;
        transition: transform 0.3s ease;
    }

    .exploration-toggle i.fa-chevron-down.active {
        transform: rotate(180deg);
    }

    .exploration-content {
        padding: 0 20px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        background: #f8f9ff;
        border-radius: 0 0 var(--border-radius) var(--border-radius);
    }

    .exploration-content.active {
        padding: 20px;
        max-height: 500px;
    }

    .exploration-content p {
        margin-bottom: 0;
    }

    .resources-section {
        margin-top: 30px;
    }

    .resources-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.25rem;
        color: var(--primary);
        margin-bottom: 20px;
    }

    .resource-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .resource-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
        transition: var(--transition);
    }

    .resource-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .video-resource {
        grid-column: 1 / -1;
    }

    .resource-header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px 20px;
        background: var(--primary-light);
        color: var(--primary-dark);
    }

    .resource-header i {
        font-size: 1.2rem;
    }

    .resource-header h4 {
        margin: 0;
        font-size: 1.1rem;
    }

    .video-container {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        height: 0;
        overflow: hidden;
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    .resource-body {
        padding: 20px;
    }

    .resource-body p {
        margin-bottom: 15px;
        color: var(--gray);
    }

    .download-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: var(--primary);
        color: white;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
    }

    .download-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    .feedback-section {
        margin-top: 50px;
        padding-top: 30px;
        border-top: 1px solid var(--light-gray);
    }

    .feedback-toggle {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px 25px;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        margin: 0 auto;
    }

    .feedback-toggle:hover {
        background: #d91862;
        transform: translateY(-2px);
    }

    .feedback-form {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease;
        margin-top: 20px;
    }

    .feedback-form.active {
        max-height: 1000px;
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        flex: 1;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--primary-dark);
    }

    input, select, textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid var(--light-gray);
        border-radius: 6px;
        font-family: inherit;
        transition: var(--transition);
    }

    input:focus, select:focus, textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .submit-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 25px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
    }

    .submit-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .course-header {
            padding: 20px;
        }
        
        .course-title {
            font-size: 1.5rem;
        }
        
        .resource-grid {
            grid-template-columns: 1fr;
        }
        
        .form-row {
            flex-direction: column;
            gap: 15px;
        }
    }

    @media (max-width: 480px) {
        body {
            padding: 10px;
        }
        
        .course-content {
            padding: 20px;
        }
        
        .lesson-title {
            font-size: 1.3rem;
        }
        
        .exploration-toggle {
            padding: 12px 15px;
            font-size: 0.9rem;
        }
    }
</style>