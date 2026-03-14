<?php

/**
 * Base Model — Initializes database connection
 */
class BaseModel
{
    protected $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../db.php';
        $this->conn = $conn;
    }
}
