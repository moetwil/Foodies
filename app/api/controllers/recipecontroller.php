<?php
require 'ApiController.php';
require '../services/recipeservice.php';

class RecipeController extends ApiController
{
    private $service;
    private $recipeId;
    private $recipe;

    public function __construct()
    {
        if (!$_SERVER['REQUEST_METHOD'] == 'GET') return;
        // $this->recipeId = $_GET['recipeId'];
        // $this->recipeId = json_decode(file_get_contents('php://input'), true);
        // $this->recipeId = $this->recipeId['recipeId'];
        $this->service = new RecipeService();
        // $this->recipe = $this->service->getRecipeById($this->recipeId);

    }

    public function ingredients(){
        $this->recipeId = $_GET['recipeId'];
        $recipe = $this->service->getRecipeById($this->recipeId);

        $ingredients = $recipe->Ingredients;
        $this->respond($ingredients);
    }


    public function get()
    {
        $this->recipeId = $_GET['recipeId'];
        $recipe = $this->service->getRecipeById($this->recipeId);

        $this->respond($recipe);
    }

}