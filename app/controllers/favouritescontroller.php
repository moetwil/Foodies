<?php
require_once __DIR__ . '/controller.php';

class FavouritesController extends Controller
{
    public function __construct()
    {
        // Check if user is logged in before allowing access to this view
        if(!isset($_SESSION['userId']))
            header('Location: /');
    }

    public function index()
    {
        $this->displayView(null);
    }
}