<?php

/**
 * Front Controller — Testing OWASP ZAP
 * All requests are routed through this file via .htaccess
 */

session_start();

// Auto-detect BASE_URL dynamically based on environment
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (preg_match('#^(.*?/public)#i', $requestUri, $matches)) {
    // If the URL naturally contains '/public', use that as the base
    $baseUrl = $matches[1];
} else {
    // Otherwise, calculate the relative path from the document root to this file's folder
    $docRoot = str_replace('\\', '/', rtrim($_SERVER['DOCUMENT_ROOT'], '/\\'));
    $dirPath = str_replace('\\', '/', __DIR__);
    if (strpos($dirPath, $docRoot) === 0) {
        $baseUrl = substr($dirPath, strlen($docRoot));
    } else {
        $scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $baseUrl = ($scriptName === '/' ? '' : $scriptName);
    }
}
$baseUrl = '/' . ltrim($baseUrl, '/');
define('BASE_URL', rtrim($baseUrl, '/'));

// Load the core app router
require_once '../app/core/App.php';

// Dispatch
$app = new App();
