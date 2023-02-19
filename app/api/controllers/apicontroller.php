<?php
class ApiController
{
    // respond with json data
    function respond($data)
    {
        $this->respondWithCode(200, $data);
    }

    // respond with error message
    function respondWithError($httpcode, $message)
    {
        $data = array('errorMessage' => $message);
        $this->respondWithCode($httpcode, $data);
    }

    // respond with json data and http code
    private function respondWithCode($httpcode, $data)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($httpcode);
        echo json_encode($data);
    }
}