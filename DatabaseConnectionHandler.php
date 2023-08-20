<?php 
// DatabaseConnectionHandler.php

declare(strict_types=1);

require_once 'db.php';

class DatabaseConnectionHandler
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}
?>