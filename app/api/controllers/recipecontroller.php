<?php
require_once 'apicontroller.php';
require_once '../services/recipeservice.php';

class RecipeController extends ApiController
{
    private $service;
    private $recipeId;
    private $recipe;

    public function __construct()
    {
        // create service object only if request method is GET
        if (!$_SERVER['REQUEST_METHOD'] == 'GET') return;
        $this->service = new RecipeService();
    }

    public function ingredients(){

        // get recipeId from request body
        $this->recipeId = htmlspecialchars($_GET['recipeId']) ;

        // get recipe by id
        $recipe = $this->service->getRecipeById($this->recipeId);

        // get ingredients
        $ingredients = $recipe->Ingredients;

        // if no ingredients found respond with error 404 and message 'No ingredients found'
        if(empty($ingredients)){
            $this->respondWithError(404, 'No ingredients found');
        }
        else{
            $this->respond($ingredients);
        }
    }


    public function get()
    {
        // get recipeId from request body
        $this->recipeId = htmlspecialchars($_GET['recipeId']);

        // get recipe by id
        $recipe = $this->service->getRecipeById($this->recipeId);

        // if no recipe found respond with error 404 and message 'Recipe not found'
        if(empty($recipe)){
            $this->respondWithError(404, 'Recipe not found');
        }
        else{
            $this->respond($recipe);
        }
    }

}