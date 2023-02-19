<?php
//require __DIR__ . '/../repositories/api/components/reciperepository.php';
// require reciperepository.php
require __DIR__ . '/../repositories/db/signuprepository.php';
class SignupService
{
    private $repository;

    private $username;
    private $email;
    private $password;
    private $passwordRepeat;

    function __construct($username, $email, $password, $passwordRepeat)
    {
        $this->repository = new SignupRepository();
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
    }

    public function signupUser()
    {
        if ($this->emptyInput() == true) {
            header("location: /signup?error=emptyinput");
            exit();
        }

        if ($this->invalidUsername() == true) {
            header("location: ../../signup.php?error=invalidusername");
            exit();
        }

        if ($this->invalidEmail() == true) {
            header("location: ../../signup.php?error=invalidemail");
            exit();
        }

        if ($this->passwordMatch() == false) {
            header("location: ../../signup.php?error=passwordsdontmatch");
            exit();
        }

        if ($this->userExists() == true) {
            header("location: ../../signup.php?error=usernametaken");
            exit();
        }

        $this->repository->createUser($this->username, $this->email, $this->password);
    }

    private function emptyInput()
    {
        return empty($this->username) || empty($this->email) || empty($this->password) || empty($this->passwordRepeat);
    }

    private function invalidUsername()
    {
        return !preg_match("/^[a-zA-Z0-9]*$/", $this->username);
    }

    private function invalidEmail()
    {
        return !filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    private function passwordMatch()
    {
        return $this->password == $this->passwordRepeat;
    }

    private function userExists()
    {
        return $this->repository->checkUser($this->username, $this->email);
    }



}