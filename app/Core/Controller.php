<?php
// Active le mode strict pour les types
declare(strict_types=1);
// Espace de noms du noyau (Core)
namespace Mini\Core;
// Déclare une classe abstraite de contrôleur de base
class Controller
{
    // Méthode utilitaire pour rendre une vue avec des paramètres
    protected function render(string $view, array $params = []): void
    {
        // Extrait les paramètres en variables locales, sans écraser les existantes
        extract(array: $params);
        // Construit le chemin du fichier de vue
        $viewFile = dirname(__DIR__) . '/Views/' . $view . '.php';
        // Construit le chemin du layout principal
        $layoutFile = dirname(__DIR__) . '/Views/layout.php';

        // Démarre la temporisation de sortie pour capturer le rendu de la vue
        ob_start();
        // Inclut la vue spécifique
        require $viewFile;
        
        // Récupère le contenu rendu et nettoie le tampon
        $content = ob_get_clean();

        // Inclut le layout qui utilise la variable $content
        require $layoutFile;
    }

    // Vérifie que l'user connecté est admin ou non (fonction accessible partout)
    protected function isAdmin(): void {
        // Si pas connecté du tout -> vers la page de login
        if (!isset($_SESSION['user'])) {
            header('Location: /auth/login');
            exit;
        }
    
        // Si connecté mais pas admin -> vers l'accueil avec un message d'erreur
        if ($_SESSION['user']['role'] !== 'ROLE_ADMIN') {
            header('Location: /?error=access_denied');
            exit;
        }
    }
}


