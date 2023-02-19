<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/adminservice.php' ;

class AdminController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new AdminService();
    }

    public function index()
    {
        // redirect to home if user is not logged in or is not an admin
        $this->service->checkLoggedIn();
        $this->service->checkAdmin();

        $this->displayView(null);
    }
}