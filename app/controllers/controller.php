<?php
class Controller
{
    // constructor
    public function __construct()
    {

    }

    function displayView($model)
    {
        require_once __DIR__ . '/../views/components/head.php';
        require_once __DIR__ . '/../views/components/header.php';
        $directory = strtolower(substr(get_class($this), 0, -10));
        $view = debug_backtrace()[1]['function'];
        require_once __DIR__ . "/../views/$directory/$view.php";
        require_once __DIR__ . '/../views/components/footer.php';
    }

}