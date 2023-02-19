<?php
require_once __DIR__ . '/../repository.php';

class SignupRepository extends Repository
{
    public function createUser($username, $email, $password)
    {
        $role = 0;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO Users (username, email, password, role) VALUES (:username, :email, :password, :role);';

        // prepare and bind the statement
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $hashedPassword);
        $statement->bindParam(':role', $role);
        
        // execute the statement
        if (!$statement->execute()) {
            $statement = null;
            header("location: ../../signup.php?error=stmtfailed");
            exit();
        }

        // close the statement
        $statement = null;
    }

    public function checkUser($username, $email)
    {
        $sql = "SELECT id, username FROM Users WHERE username = :username OR email = :email;";

        // prepare and bind the statement
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);

        // execute the statement
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../../signup.php?error=stmtfailed");
            exit();
        }

        // return if the user exists
        return $stmt->rowCount() > 0;
    }
}