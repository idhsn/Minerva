<?php

namespace App\Core;

use PDO;
use PDOException;

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }
}

?>