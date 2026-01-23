<?php

namespace App\Models\User;

use PDO;

class Enseignant extends User
{
    protected $role = 'teacher';
}
