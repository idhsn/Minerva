<?php

namespace App\Models\User;


use App\Core\Model;
use PDO;

abstract class User extends Model
{
    protected $id = null;
    protected $nom;
    protected $email;
    protected $password;
    protected $role;

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRole()
    {
        return $this->role;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function register()
    {
        $rqt = "INSERT INTO users(name, email, password, role) VALUES(:name ,:email, :password, :role)";
        $res = $this->db->prepare($rqt);
        if (
            $res->execute([
                ':name' => $this->nom,
                ':email' => $this->email,
                ':password' => password_hash($this->password, PASSWORD_DEFAULT),
                ':role' => $this->role
            ])
        ) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function findByEmail($email)
    {
        $rqt = "SELECT * FROM users WHERE email = :email";
        $res = $this->db->prepare($rqt);
        $res->execute(['email' => $email]);
        return $res->fetch();
    }

    public function login($email, $password)
    {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}


?>