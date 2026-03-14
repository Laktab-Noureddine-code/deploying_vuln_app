<?php
require_once __DIR__ . '/../core/Controller.php';

class DashboardController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }

    /**
     * Show dashboard with student directory
     */
    public function index()
    {
        $this->requireAuth();

        $data = [
            'users' => $this->userModel->getAllUsers()
        ];

        $this->view('dashboard/index', $data);
    }
}
