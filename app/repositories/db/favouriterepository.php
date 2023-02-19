<?php
require_once __DIR__ . '/../repository.php';

class FavouriteRepository extends Repository
{

    public function addToFavourites($userId, $recipeId)
    {
        $sql = 'INSERT INTO Favourites (user_id, recipe_id) VALUES (:userId, :recipeId);';

        // prepare and bind the statement
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':userId', $userId);
        $statement->bindParam(':recipeId', $recipeId);

        // execute the statement
        if (!$statement->execute()) {
            $statement = null;
            header("location: ../../recipe.php?error=stmtfailed");
            exit();
        }

        // close the statement
        $statement = null;
    }
    
    public function deleteFromFavourites($userId, $recipeId)
    {
        $sql = 'DELETE FROM Favourites WHERE user_id = :userId AND recipe_id = :recipeId;';

        // prepare and bind the statement
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':userId', $userId);
        $statement->bindParam(':recipeId', $recipeId);

        // execute the statement
        if (!$statement->execute()) {
            $statement = null;
            header("location: ../../recipe.php?error=stmtfailed");
            exit();
        }

        // close the statement
        $statement = null;
    }
    
    public function checkFavourite($userId, $recipeId)
    {
        // sql query to check if recipe is already in favourites
        $sql = 'SELECT user_id, recipe_id FROM Favourites WHERE user_id = :userId AND recipe_id = :recipeId;';

        // prepare and bind the statement
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':recipeId', $recipeId);

        // execute the statement
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../../recipe.php?error=stmtfailed");
            exit();
        }

        // return if the recipe is in favourites
        return $stmt->rowCount() > 0;
    }

    public function getAllFavourites($userId)
    {
        // sql query to get all favourites by user id
        $sql = 'SELECT recipe_id FROM Favourites WHERE user_id = :userId;';

        // prepare and bind the statement
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':userId', $userId);

        // execute the statement
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../../recipe.php?error=stmtfailed");
            exit();
        }

        // return the result
        return $stmt->fetchAll();
    }

}