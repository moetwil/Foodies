<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/recipeservice.php';

class RecipeController extends Controller
{
    private $recipeService;
    private $recipe;
    private $isInFavourites;

    function __construct()
    {
        $this->recipeService = new RecipeService();
        $this->recipe = $this->recipeService->getRecipeById($_GET['id']);
    }

    public function index()
    {
        $this->displayView($this->recipe);
    }

}
?>