<?php
require_once 'apicontroller.php';
require_once '../services/favouriteservice.php';
require_once '../services/recipeservice.php';

class FavouritesController extends ApiController
{
    private $service;
    private $recipeId;
    private $userId;

    public function __construct()
    {
        // check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            // get the recipeId from the POST request
            $data = json_decode(file_get_contents('php://input'), true);
            $this->recipeId = htmlspecialchars($data['recipeId']) ;
        }
        
        // get the userId from the session
        $this->userId = $_SESSION['userId'];
        
        // initialize the FavouriteService with the userId and recipeId
        $this->service = new FavouriteService($this->userId);
    }

    public function add(){
        // call the addToFavourites method of the service
        $this->service->addToFavourites($this->recipeId);
    }

    public function delete(){
        // delete recipe and return response
        if($this->service->deleteFromFavourites($this->recipeId)){
            $this->respond('Recipe deleted from favourites');
        } 
        else {
            $this->respondWithError(500, 'Something went wrong');
        }
    }

    public function check(){
        // call the checkFavourite method of the service and send the result to the front-end
        $this->respond($this->service->checkFavourite($this->recipeId));
    }

    public function getAll(){
        $recipeService = new RecipeService();

        // get all favourites
        $favourites = $this->service->getAllFavourites();

        // fill an array with the recipes
        $recipes = array();
        foreach($favourites as $favourite){
            $recipe = $recipeService->getRecipeById($favourite['recipe_id']);
            array_push($recipes, $recipe);
        }

        // if no favourites found respond with error 404 and message 'No favourites found'
        if(empty($recipes)){
            $this->respondWithError(404, 'No favourites found');
        }
        else{
            $this->respond($recipes);
        }
    }
}