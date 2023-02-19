<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/loginservice.php';
require_once __DIR__ . '/../models/user.php';

class LoginController extends Controller
{
    private $service;
    private $previousPage;

    public function __construct()
    {   
        
    }
    public function index()
    {
        $_SESSION['prev'] = explode('/', $_SERVER['HTTP_REFERER'])[3];
        // check if $_GET has error
        if (isset($_GET['error'])) {
            $error = htmlspecialchars($_GET['error']);

            if($error == "emptyinput"){
                $this->displayView("Please fill in all fields");
            }
            if($error == "userNotFound" || $error == "wrongpassword"){
                $this->displayView("Login failed, please try again");
            }
        } else {
            $this->displayView(null);
        }

    }

    public function login()
    {
        // save info from post request
        $uid = htmlspecialchars($_POST["uid"]);
        $password = htmlspecialchars($_POST["password"]);

        // create service
        $this->service = new LoginService($uid, $password);
        $this->service->login();


        $redirect = '<script> window.location.href = "/' . $_SESSION['prev'] . '"</script>';
        // echo '<script> window.location.href = "/"</script>';
        echo $redirect;
        //redirect to home

        // ';
    }
}