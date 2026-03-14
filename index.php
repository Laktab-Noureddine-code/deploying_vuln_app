<?php
// If running via PHP's built-in web server
if (php_sapi_name() === 'cli-server') {
    $url = parse_url($_SERVER['REQUEST_URI']);
    $path = $url['path'];
    
    // Serve static files from public/ directly
    if (is_file(__DIR__ . '/public' . $path) && $path !== '/public/index.php') {
        return false;
    }
    
    // Replicate .htaccess mod_rewrite behavior:
    // Extract the "url" for the App router
    $route = $path;
    $bases = ['/php/public/', '/php/public', '/public/', '/public', '/php/', '/php'];
    foreach ($bases as $base) {
        if (strpos($route, $base) === 0) {
            $route = substr($route, strlen($base));
            break;
        }
    }
    $route = ltrim($route, '/');
    if ($route !== '') {
        $_GET['url'] = $route;
    }
    
    // Change directory to public so requires work properly
    chdir(__DIR__ . '/public');
    require_once 'index.php';
    return;
}

// For Apache / Nginx / other servers
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
header("Location: " . $base . "/public/");
exit();