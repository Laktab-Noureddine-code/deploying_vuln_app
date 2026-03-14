<?php
require_once __DIR__ . '/../core/Controller.php';

class SearchController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }

    /**
     * Show search page with results
     * VULNERABLE: Reflected XSS — $searchTerm echoed without encoding
     */
    public function index()
    {
        $this->requireAuth();

        $searchTerm = isset($_GET['q']) ? $_GET['q'] : '';
        $results = null;

        if ($searchTerm !== '') {
            $results = $this->userModel->searchUsers($searchTerm);
        }

        $data = [
            'searchTerm' => $searchTerm,
            'results'    => $results
        ];

        $this->view('search/index', $data);
    }
}
