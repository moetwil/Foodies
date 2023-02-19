<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/signupservice.php';

class SignupController extends Controller
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

    public function signup()
    {
        // save info from post request
        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $passwordRepeat = htmlspecialchars($_POST["passwordRepeat"]);

        // create service
        $this->service = new SignupService($username, $email, $password, $passwordRepeat);
        $this->service->signupUser();

        // redirect to home page
        header("location: /");
    }

    public function error($error)
    {
        $this->displayView($error);
    }


}