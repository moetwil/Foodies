<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/loginservice.php';
require_once __DIR__ . '/../models/user.php';

class LogoutController extends Controller
{
    public function index()
    {
        session_unset();
        session_destroy();
        header("location: /");
    }


}