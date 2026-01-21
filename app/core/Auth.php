<?php

namespace App\Core;

class Auth{
    public static function check(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    public static function user(){
        if(self::check()){
            return [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'],
                'email' => $_SESSION['user_email'],
                'role' => $_SESSION['user_role']
            ];
        }
        return null;
    }

    public static function requireLogin(){
        if(!self::check()){
            header("location: /login");
            exit();
        }
    }

    public static function login($user){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['user_email'] = $user['user_email'];
        $_SESSION['user_role'] = $user['user_role'];
    }

    public static function logout(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION = [];
        session_destroy();
        header("location: /login");
        exit();
    }
}