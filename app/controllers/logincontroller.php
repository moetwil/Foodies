<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/loginservice.php';
require_once __DIR__ . '/../models/user.php';

class LoginController extends Controller
{
    private $service;
    public function index()
    {
        // check if $_GET has error
        if (isset($_GET['error'])) {
            // if it does, check what the error is

            $this->displayView($_GET['error']);
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


        //redirect to home
        echo '
        <script>
            window.location.href = "/";
        </script>
        ';
    }

}