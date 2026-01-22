<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $this->view('/auth/login');
    }

    public function loginPost()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $this->view('auth/login', [
                'email_error' => empty($email) ? 'Veuillez saisir votre email !' : '',
                'password_error' => empty($password) ? 'Veuillez saisir votre mot de passe !' : ''
            ]);
            return;
        }

        // Get a temporary model to find the user
        $tempModel = $this->model('Etudiant', 'user');
        $userData = $tempModel->findByEmail($email);

        if (!$userData) {
            $this->view('auth/login', ['erreur' => 'Invalid Credentials']);
            return;
        }

        $modelName = (strtolower($userData['role']) === 'student') ? 'Etudiant' : 'Enseignant';
        $userModel = $this->model($modelName, 'user');
        $user = $userModel->login($email, $password);

        if ($user) {
            Auth::login($user);
            $role = strtolower($user['role']);
            $this->redirect("/php_briefs/Minerva_binomes/$role/dashboard");
        } else {
            $this->view('auth/login', ['erreur' => 'Invalid Credentials']);
        }
    }

    public function register()
    {
        $this->view('auth/register');
    }

    public function registerPost()
    {
        $data = [
            'nom' => $_POST['nom'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'role' => $_POST['role'] ?? ''
        ];

        $confirm = $_POST['password_confirmation'] ?? '';

        if (empty($data['nom']) || empty($data['email']) || empty($data['password']) || empty($confirm) || empty($data['role'])) {
            $this->view('auth/register', ['erreur' => 'Veuillez remplir tous les champs']);
            return;
        }

        $modelName = (strtolower($data['role']) === 'student') ? 'Etudiant' : 'Enseignant';
        $userModel = $this->model($modelName, 'user');

        $userModel->setNom($data['nom']);
        $userModel->setEmail($data['email']);
        $userModel->setPassword($data['password']);
        $userModel->setRole($data['role']);

        if ($userModel->register()) {
            Auth::setFlash('succes', 'Votre compte a été créé avec succès');
            $this->redirect('/php_briefs/Minerva_binomes/login');
        } else {
            $this->view('auth/register', ['erreur' => 'Erreur lors de la création du compte']);
        }
    }

    public function logout()
    {
        Auth::logout();
    }
}

?>