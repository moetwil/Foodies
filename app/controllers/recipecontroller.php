<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/recipeservice.php';

class RecipeController extends Controller
{
    private $recipeService;
    private $recipe;
    private $isInFavourites;

    function __construct()
    {
        $this->recipeService = new RecipeService();
        $this->recipe = $this->recipeService->getRecipeById(htmlspecialchars($_GET['id']));
    }

    public function index()
    {
        // check if recipe is null  
        if($this->recipe == null) {
            echo '<script> window.location="/404" </script>';
        }
        else{
            $this->displayView($this->recipe);
        }

        
    }

}
?>