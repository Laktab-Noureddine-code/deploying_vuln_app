<?php
require_once __DIR__ . '/../core/Model.php';

/**
 * UserModel — Handles all user-related database queries
 * NOTE: Vulnerabilities are INTENTIONAL for educational OWASP ZAP testing
 */
class UserModel extends BaseModel
{
    /**
     * VULNERABLE: SQL Injection — Direct string concatenation
     */
    public function login($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return false;
    }

    /**
     * Fetch all users for the directory
     */
    public function getAllUsers()
    {
        $sql = "SELECT id, username, student_major FROM users";
        return $this->conn->query($sql);
    }

    /**
     * VULNERABLE: SQL Injection — Direct string concatenation in LIKE
     */
    public function searchUsers($term)
    {
        $sql = "SELECT id, username, student_major FROM users WHERE username LIKE '%$term%' OR student_major LIKE '%$term%'";
        return $this->conn->query($sql);
    }

    /**
     * VULNERABLE: IDOR — No permission check, fetches any user by ID
     * Also exposes password field intentionally
     */
    public function getUserById($id)
    {
        $sql = "SELECT id, username, password, student_major FROM users WHERE id = '$id'";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }
}
