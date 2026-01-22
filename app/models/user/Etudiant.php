<?php

namespace App\Models\User;

use PDO;

class Etudiant extends User
{
    protected $role = 'student';
}
