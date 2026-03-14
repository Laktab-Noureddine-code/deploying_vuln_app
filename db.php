<?php
// =============================================
// Database Connection - Student Directory Hub
// FOR EDUCATIONAL USE ONLY
// =============================================

$db_host = getenv('DB_HOST') ?: 'db';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : 'rootpassword';
$db_name = getenv('DB_NAME') ?: 'zap_demo';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
