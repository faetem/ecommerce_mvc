<?php

// Ici je définit le namespace ou il y aura ma class
namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class User
{
    private $id;
    private $nom;
    private $email;
    private $password;
    private $role;

    // =====================
    // Getters / Setters
    // =====================

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function hashPassword() 
    {
        // hash du mot de passe dans la BDD pour la sécurité 
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role; // 'ROLE_USER'; // user normal par défaut
    }

    // =====================
    // Méthodes CRUD
    // =====================

    /**
     * Récupère tous les utilisateurs
     * @return array
     */
    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM user ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un utilisateur par son ID
     * @param int $id
     * @return array|null
     */
    public static function findById($id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un utilisateur par son email
     * @param string $email
     * @return array|null
     */
    public static function findByEmail($email)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouvel utilisateur
     * @return bool
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO user (nom, email, password, role) VALUES (?, ?, ?, ?)");

        // Si le rôle n'est pas défini dans l'objet, on met 'ROLE_USER' par défaut
        $roleToSave = $this->role ?? 'ROLE_USER';

        return $stmt->execute([
            $this->nom, 
            $this->email, 
            $this->password, 
            $roleToSave
        ]);
    }

    /**
     * Met à jour les informations d’un utilisateur existant
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("UPDATE user SET nom = ?, email = ?, role = ? WHERE id = ?");
        return $stmt->execute([
            $this->nom, 
            $this->email, 
            $this->role, 
            $this->id
        ]);
    }

    /**
     * Supprime un utilisateur
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM user WHERE id = ?");
        return $stmt->execute([$this->id]);
    }
}
