<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/recipeservice.php';

class SearchController extends Controller
{
    private $recipeService;

    function __construct()
    {
        $this->recipeService = new RecipeService();
    }

    public function index()
    {
        // get recipe from url
        $recipes = $this->recipeService->getRecipesBySearch($_GET['search']);

        // if no recipes found, display no recipes found page
        if($recipes == null) require_once(__DIR__ . '/../views/search/norecipes.php');
        else $this->displayView($recipes);
    }

    public function searchForm()
    {
        $search = htmlspecialchars($_POST['search']);
        header("Location: /search?search=$search");
    }
}