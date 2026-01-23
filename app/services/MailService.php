<?php

namespace App\Services;

class MailService
{
    /**
     * Sends a welcome email to a student with their credentials.
     * 
     * @param string $email The student's email
     * @param string $name The student's name
     * @param string $password The generated password
     * @return bool
     */
    public function sendWelcomeEmail($email, $name, $password)
    {
        $subject = "Bienvenue chez Minerva - Vos identifiants";

        $baseUrl = "http://localhost/php_briefs/Minerva_binomes";
        $loginUrl = $baseUrl . "/login";

        // HTML Template
        $message = "
        <html>
        <head>
            <style>
                .container { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e0e0e0; border-radius: 10px; }
                .header { text-align: center; margin-bottom: 30px; }
                .header h1 { color: #003049; }
                .content { background: #f9f9f9; padding: 20px; border-radius: 5px; }
                .credentials { background: #fff; padding: 15px; border-left: 4px solid #5ABDF1; margin: 20px 0; }
                .footer { text-align: center; margin-top: 30px; font-size: 0.8rem; color: #888; }
                .button { display: inline-block; padding: 10px 20px; background: #5ABDF1; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Minerva</h1>
                    <p>Votre plateforme éducative</p>
                </div>
                <div class='content'>
                    <p>Bonjour <strong>$name</strong>,</p>
                    <p>Bienvenue chez Minerva ! Votre compte étudiant a été créé par votre enseignant.</p>
                    <p>Voici vos identifiants pour vous connecter à la plateforme :</p>
                    
                    <div class='credentials'>
                        <strong>Email :</strong> $email<br>
                        <strong>Mot de passe :</strong> $password
                    </div>

                    <p style='text-align: center;'>
                        <a href='$loginUrl' class='button'>Me connecter</a>
                    </p>

                    <p>Si le bouton ne fonctionne pas, copiez et collez ce lien dans votre navigateur :<br>
                    <small>$loginUrl</small></p>
                </div>
                <div class='footer'>
                    <p>&copy; " . date('Y') . " Minerva. Tous droits réservés.</p>
                </div>
            </div>
        </body>
        </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: Minerva <no-reply@minerva.edu>" . "\r\n";
        $headers .= "Reply-To: no-reply@minerva.edu" . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // In development environment, we log the email for debugging
        $this->logEmail($email, $subject, $message);

        // Try to send the mail
        try {
            // Adding -f parameter can help with some mail configurations
            return @mail($email, $subject, $message, $headers, "-f no-reply@minerva.edu");
        } catch (\Exception $e) {
            error_log("Failed to send email to $email: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Logs the email to a file for development purposes.
     */
    private function logEmail($email, $subject, $message)
    {
        $logDir = dirname(dirname(__DIR__)) . '/logs';
        if (!is_dir($logDir)) {
            @mkdir($logDir, 0777, true);
        }

        $logFile = $logDir . '/mail.log';
        $timestamp = date('Y-m-d H:i:s');

        // Extracting meaningful content for the log
        $cleanContent = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', "", $message);
        $cleanContent = strip_tags($cleanContent);
        $cleanContent = trim(preg_replace('/\s+/', ' ', $cleanContent));

        $logEntry = "[$timestamp] TO: $email | SUBJECT: $subject\n";
        $logEntry .= "BODY: $cleanContent\n";
        $logEntry .= "--------------------------------------------------\n";

        @file_put_contents($logFile, $logEntry, FILE_APPEND);
    }
}
