<?php
/**
 * Base Controller — Provides helper methods for loading views and models
 */
class BaseController
{
    /**
     * Load a model class
     */
    protected function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    /**
     * Load a view with data
     */
    protected function view($view, $data = [])
    {
        $viewFile = '../app/views/' . $view . '.php';
        if (file_exists($viewFile)) {
            extract($data);
            require_once $viewFile;
        } else {
            die('View "' . $view . '" not found.');
        }
    }

    /**
     * Redirect to a URL
     */
    protected function redirect($url)
    {
        header('Location: ' . BASE_URL . '/' . $url);
        exit();
    }

    /**
     * Check if user is logged in, redirect to login if not
     */
    protected function requireAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth');
        }
    }
}
