<?php
require_once 'apicontroller.php';
require_once '../services/favouriteservice.php';

class UserController extends ApiController
{
    private $userId;

    public function __construct()
    {
        if (!$_SERVER['REQUEST_METHOD'] == 'GET') return;
    }

    public function loggedIn(){
        if(isset($_SESSION['userId'])){
            $this->respond(true);
        } else {
            $this->respond(false);
        }
    }
    
}