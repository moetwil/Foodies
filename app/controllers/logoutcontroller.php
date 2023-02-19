<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/loginservice.php';
require_once __DIR__ . '/../models/user.php';

class LogoutController extends Controller
{
    public function index()
    {
        // redirect to last page
        $_SESSION['prev'] = explode('/', $_SERVER['HTTP_REFERER'])[3];
        $redirect = '<script> window.location.href = "/' . $_SESSION['prev'] . '"</script>';


        // unset session variables
        session_unset();
        session_destroy();

        // redirect to last page
        echo $redirect;
    }


}