<?php
//require __DIR__ . '/../repositories/api/components/reciperepository.php';
// require reciperepository.php
require_once __DIR__ . '/../repositories/db/favouriterepository.php';
class FavouriteService
{
    private $repository;
    private $userId;

    function __construct($userId)
    {
        $this->repository = new FavouriteRepository();
        $this->userId = $userId;
    }

    public function addToFavourites($recipeId)
    {
        $this->repository->addToFavourites($this->userId, $recipeId);
    }
    
    public function deleteFromFavourites($recipeId)
    {
        $this->repository->deleteFromFavourites($this->userId, $recipeId);
    }
    
    public function checkFavourite($recipeId)
    {
       return $this->repository->checkFavourite($this->userId, $recipeId);
    }

    public function getAllFavourites()
    {
        return $this->repository->getAllFavourites($this->userId);
    }
}