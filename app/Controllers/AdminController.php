<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\User;
use Mini\Models\Order;

final class AdminController extends Controller {

    public function index(): void {
        $this->isAdmin(); // Bloque l'accès si pas admin
        
        $this->render('admin/dashboard', [
            'title' => 'Tableau de bord Admin'
        ]);
    }

    public function listUsers(): void {
        $this->isAdmin();
        $users = User::getAll();
        
        $this->render('admin/users', [
            'users' => $users
        ]);
    }

    public function showCreateUserForm(): void
    {
        // Affiche le formulaire de création d'utilisateur
        $this->render('/admin/create-user', params: [
            'title' => 'Créer un utilisateur'
        ]);
    }

    public function createUser(): void
    {
        $this->isAdmin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/create-user');
            return;
        }

        $input = $_POST;

        $user = new User();
        $user->setNom($input['nom']);
        $user->setEmail($input['email']);
        // Correction : On ajoute un mot de passe obligatoire pour le save()
        $user->setPassword($input['password']); 
        $user->hashPassword();
        $user->setRole($input['role']); // user par défaut, modifiable après

        if ($user->save()) {
            $this->render('admin/create-user', params: [
                'title' => 'Créer un utilisateur',
                'message' => 'Création de l\'utilisateur réussie.',
                'success' => true,
            ]);
        } else {
            $this->render('admin/create-user', params: [
                'title' => 'Créer un utilisateur',
                'message' => 'Erreur lors de la création de l\'utilisateur.',
                'success' => false,
                'old_values' => $input
            ]);
        }
        
    }

    public function deleteUser(): void {
    $this->isAdmin();

    // 2. Vérifier que la méthode est bien POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /admin/users');
        exit;
    }

    // 3. Récupérer l'ID depuis le champ caché du formulaire
    $id = $_POST['id'] ?? null;

    if ($id) {
        // Empêcher l'admin de se supprimer lui-même (sécurité supplémentaire)
        if ((int)$id === (int)$_SESSION['user']['id']) {
            header('Location: /admin/users?error=self_delete');
            exit;
        }

        // 4. Utiliser le modèle User pour supprimer
        $user = new \Mini\Models\User();
        $user->setId($id);
        
        if ($user->delete()) {
            // Redirection avec un message de succès
            header('Location: /admin/users?message=Utilisateur supprimé');
            exit;
        }
    }

    header('Location: /admin/users?error=delete_failed');
    exit;
}

    // Affiche le formulaire de modification
public function showEditUserForm(): void 
{
    $this->isAdmin();
    
    $id = $_GET['id'] ?? null;
    if (!$id) {
        header('Location: /admin/users');
        exit;
    }

    $userData = \Mini\Models\User::findById((int)$id);
    
    if (!$userData) {
        header('Location: /admin/users?error=not_found');
        exit;
    }

    $this->render('admin/edit-user', [
        'title' => 'Modifier l\'utilisateur',
        'user' => $userData
    ]);
}

// Traite la soumission du formulaire
public function updateUser(): void {
    $this->isAdmin();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /admin/users');
        exit;
    }

    $id = $_POST['id'] ?? null;
    $user = new \Mini\Models\User();
    
    // On hydrate l'objet avec les nouvelles données
    $user->setId($id);
    $user->setNom($_POST['nom']);
    $user->setEmail($_POST['email']);
    $user->setRole($_POST['role']);

    if ($user->update()) {
        // Si on modifie son propre compte, on met à jour la session
        if ($id == $_SESSION['user']['id']) {
            $_SESSION['user']['nom'] = $_POST['nom'];
            $_SESSION['user']['role'] = $_POST['role'];
        }
        
        header('Location: /admin/users?message=Utilisateur mis à jour');
        exit;
    } else {
        header('Location: /admin/users/edit?id=' . $id . '&error=update_failed');
        exit;
    }
}

    public function listOrders(): void {
        $this->isAdmin();
        
        $orders = Order::getValidatedOrders();
        
        $this->render('admin/order-list', params: [
            'title' => 'Commandes validées',
            'orders' => $orders
        ]);
    }
}