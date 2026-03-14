<?php
require_once __DIR__ . '/../core/Controller.php';

class AuthController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }

    /**
     * Show login page
     */
    public function index()
    {
        // If already logged in, go to dashboard
        if (isset($_SESSION['user_id'])) {
            $this->redirect('dashboard');
        }

        $data = ['error' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->login($username, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['student_major'] = $user['student_major'];
                $this->redirect('dashboard');
            } else {
                $data['error'] = 'Invalid username or password.';
            }
        }

        $this->view('auth/login', $data);
    }

    /**
     * Logout and destroy session
     */
    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . '/auth');
        exit();
    }
}
