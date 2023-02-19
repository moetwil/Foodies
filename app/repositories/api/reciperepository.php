<?php
require_once __DIR__ . '/../../models/recipepreview.php';
require_once __DIR__ . '/../../models/recipe.php';

class RecipeRepository
{
    public function getRecipeBySearch($searchWord)
    {
        //get data from api and load into RecipePreview object
        $api = 'https://forkify-api.herokuapp.com/api/search?q=' . $searchWord;
        $response = file_get_contents($api);
        $response = json_decode($response, true);


        // create array of recipes
        $recipes = array();
        foreach ($response['recipes'] as $recipe) {
            $recipe = new RecipePreview($recipe['recipe_id'], $recipe['title'], $recipe['image_url']);
            array_push($recipes, $recipe);
        }

        return $recipes;
    }

    public function getRecipeById($id)
    {
        //get data from api
        $api = 'https://forkify-api.herokuapp.com/api/get?rId=' . $id;
        $response = file_get_contents($api);

        // check if response is false
        if ($response === false) {
            return null;
        }

        $response = json_decode($response, true);
        // create recipe object
        $recipe = new Recipe(
            $response['recipe']['recipe_id'],
            $response['recipe']['title'],
            $response['recipe']['image_url'],
            $response['recipe']['ingredients'],
            $response['recipe']['publisher']
        );
        return $recipe;
        
    }









}