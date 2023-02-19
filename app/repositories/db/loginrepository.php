<?php
require __DIR__ . '/../repository.php';

class LoginRepository extends Repository
{
    public function login($uid, $password)
    {
        $sql = 'SELECT password FROM Users WHERE username = :username OR email = :email;';

        // prepare and bind the statement
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $uid);
        $stmt->bindParam(':email', $uid);


        // execute the statement
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: /login?error=stmtfailed");
            exit();
        }

        // check if the user is found
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: /login?error=userNotFound");
            exit();
        }

        // check if the password is correct
        $passwordHashed = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['password'];
        $checkPassword = password_verify($password, $passwordHashed);

        // if the password is wrong
        if (!$checkPassword) {
            $stmt = null;
            header("location: /login?error=wrongpassword");
            exit();
        } 
        
        // if the password is correct
        elseif ($checkPassword) {
            $sql = "SELECT id, username, email, password, role FROM Users WHERE username = :username OR email = :email AND password = :password;";

            // prepare and bind the statement
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':username', $uid);
            $stmt->bindParam(':email', $uid);
            $stmt->bindParam(':password', $passwordHashed);

            // execute the statement
            if (!$stmt->execute()) {
                $stmt = null;
                header("location: /login?error=stmtfailed");
                exit();
            }

            // check if the user is found
            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: /login?error=userNotFound");
                exit();
            }

            // get the user
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // set the session variables
            $_SESSION['userId'] = $user[0]["id"];
            $_SESSION['userUid'] = $user[0]["username"];
            $_SESSION['userRole'] = $user[0]["role"];
        }

        $stmt = null;
    }


}