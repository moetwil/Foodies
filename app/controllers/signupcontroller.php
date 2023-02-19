<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/signupservice.php';

class SignupController extends Controller
{
    private $service;
    public function index()
    {
        // check if $_GET has error
        if (isset($_GET['error'])) {
            $error = htmlspecialchars($_GET['error']);

            // if it does, check what the error is
            if($error == "emptyinput"){
                $this->displayView("Please fill in all fields");
            }
            if($error == "usernametaken"){
                $this->displayView("Username already taken");
            }
            if($error == "invalidemail"){
                $this->displayView("Invalid email");
            }
            if($error == "passwordsdontmatch"){
                $this->displayView("Passwords don't match");
            }
            if($error == "invalidusername"){
                $this->displayView("Invalid username");
            }

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

    // display error page
    public function error($error)
    {
        $this->displayView($error);
    }


}