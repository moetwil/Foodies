<?php
//require __DIR__ . '/../repositories/api/components/reciperepository.php';
// require reciperepository.php
require_once __DIR__ . '/../repositories/db/loginrepository.php';
class LoginService
{
    private $repository;

    private $uid;
    private $password;

    function __construct($uid, $password)
    {
        $this->repository = new LoginRepository();
        $this->uid = $uid;
        $this->password = $password;
    }

    public function login()
    {
        // check if input is empty
        if ($this->emptyInput() == true) {
            header("location: /login?error=emptyinput");
            exit();
        }

        $this->repository->login($this->uid, $this->password);
    }



    private function emptyInput()
    {
        return empty($this->uid) || empty($this->password);
    }




}