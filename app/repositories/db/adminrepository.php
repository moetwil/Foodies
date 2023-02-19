<?php
require_once __DIR__ . '/../repository.php';
require_once __DIR__ . '/../../models/user.php';


class AdminRepository extends Repository
{ 
    public function getAllUsers()
    {
        // sql query to get all favourites by user id
        $sql = 'SELECT id, username, email, password, role FROM Users';

        // prepare and bind the statement
        $stmt = $this->connection->prepare($sql);

        // execute the statement
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../../admin?error=stmtfailed");
            exit();
        }

        $result = $stmt->fetchAll();

        // create array of users
        $users = array();
        foreach ($result as $user) {
            $user = new User(
                $user['id'], 
                $user['username'], 
                $user['email'], 
                $user['password'], 
                $user['role']);

            array_push($users, $user);
        }

        return $users;
    }
    
    public function getUserById($id)
    {
        // sql query to get all favourites by user id
        $sql = 'SELECT id, username, email, password, role FROM Users WHERE id = :id';

        // prepare and bind the statement
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);

        // execute the statement
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../../admin?error=stmtfailed");
            exit();
        }

        $result = $stmt->fetchAll();

        // create user
        $user = new User(
            $result[0]['id'], 
            $result[0]['username'], 
            $result[0]['email'], 
            $result[0]['password'], 
            $result[0]['role']);

        return $user;
    }

    public function updateUser($user)
    {
        // sql query to get all favourites by user id
        $sql = 'UPDATE Users SET username = :username, email = :email , role = :role WHERE id = :id;';

        // prepare and bind the statement
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $user["username"]);
        $stmt->bindParam(':email', $user["email"]);
        $stmt->bindParam(':role', $user["role"]);
        $stmt->bindParam(':id', $user["id"]);

        // execute the statement
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../../admin?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }

    public function deleteUser($id)
    {
        // sql query to get all favourites by user id
        $sql = 'DELETE FROM Users WHERE id = :id;';

        // prepare and bind the statement
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);

        // execute the statement
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../../admin?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }

    

}