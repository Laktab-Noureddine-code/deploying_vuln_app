<?php
// =============================================
// Database Connection - Student Directory Hub
// FOR EDUCATIONAL USE ONLY
// =============================================

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'zap_demo';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
