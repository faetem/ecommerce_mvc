<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);

// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;

// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\User;

final class AuthController extends Controller {

    public function showRegisterForm(): void {
        $this->render('auth/register', params: [
            'title' => 'Inscription | Amazonie' 
        ]);
    }

    public function register(): void {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /auth/register');
            return;
        }

        $input = $_POST;

        // Crée une nouvelle instance User 
        $user = new User();
        $user->setNom($input['nom']);
        $user->setEmail($input['email'] ?? '');
        $user->setPassword($input['password']);
        $user->hashPassword(); // on encrypte le mot de passe
        
        // Sauvegarde l'utilisateur dans la BDD
        if ($user->save()) {
            $this->render('auth/register', params: [
                'title' => 'Inscription',
                'message' => 'Inscription réussie.',
                'success' => true,
            ]);
        } else {
            $this->render('auth/register', params: [
                'title' => 'Inscription',
                'message' => 'Erreur lors de l\'inscription.',
                'success' => false,
                'old_values' => $input
            ]);
        }
    }

    public function showLoginForm(): void {
        $this->render('auth/login', params: [
            'title' => 'Connexion | Amazonie' 
        ]);
    }

    public function login(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            return;
        }
        // On récupère les données envoyées nécessaires à la connexion
        // $nom = $_POST['nom'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // On au model User de chercher l'utilisateur par email
        $userData = User::findByEmail($email);

        // Vérification
        if ($userData && password_verify($password, $userData['password'])) {
            // On stocke l'utilisateur en session
            $_SESSION['user'] = [
                'id' => $userData['id'],
                'nom' => $userData['nom'],
                'email' => $userData['email'], 
                'role' => $userData['role']
            ];
            // Redirection vers l'accueil
            header('Location: /');
            exit;
        } else {
            // On renvoie vers le formulaire avec une erreur en cas d'échec
            $this->render('auth/login', params: [
                'error' => 'Email ou mot de passe incorrect.'
            ]);
        }
    }

    public function logout(): void {
        session_start(); // si aucune session en cours
        session_destroy(); // On vide tout
        header('Location: /'); // Retour à l'index
        exit;
    }
}