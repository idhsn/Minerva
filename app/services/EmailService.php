<?php

namespace App\Services;

class EmailService
{
    /**
     * Simulates sending a welcome email with credentials
     */
    public static function sendWelcomeEmail($email, $name, $password)
    {
        // For simulation, we just return a formatted message
        // In a real app, this would use mail() or a library like PHPMailer
        $message = "Bienvenue sur Minerva, $name !\n\n";
        $message .= "Votre compte a été créé par votre enseignant.\n";
        $message .= "Voici vos identifiants :\n";
        $message .= "Email : $email\n";
        $message .= "Mot de passe : $password\n\n";
        $message .= "Veuillez vous connecter et changer votre mot de passe dès que possible.";

        // We could log this to a file for verification if needed
        error_log("SIMULATED EMAIL TO $email:\n$message");

        return true;
    }
}
