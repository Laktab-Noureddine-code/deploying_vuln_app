<?php
require_once __DIR__ . '/../core/Controller.php';

class ProfileController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }

    /**
     * Show student profile
     * VULNERABLE: IDOR — No ownership check on the profile ID
     */
    public function show($id = 0)
    {
        $this->requireAuth();

        // Also support ?id= query param for backwards compatibility
        if ($id == 0 && isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $data = [
            'student' => $this->userModel->getUserById($id),
            'id'      => $id
        ];

        $this->view('profile/show', $data);
    }

    /**
     * Default action redirects to dashboard
     */
    public function index()
    {
        $this->redirect('dashboard');
    }
}
