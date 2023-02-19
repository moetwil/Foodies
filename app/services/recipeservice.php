<?php
//require __DIR__ . '/../repositories/api/components/reciperepository.php';
// require reciperepository.php
require __DIR__ . '/../repositories/api/reciperepository.php';
class RecipeService
{
    private $repository;

    function __construct()
    {
        $this->repository = new RecipeRepository();
    }


    public function getRecipeById($id)
    {
        $recipe = $this->repository->getRecipeById($id);
        return $recipe;
    }

    public function getRecipesBySearch($searchWord)
    {
        if (!$this->checkValidSearchword($searchWord)) {
            return null;
        }
        $recipes = $this->repository->getRecipeBySearch($searchWord);
        return $recipes;
    }

    private function checkValidSearchword($searchword){
        // make searchword lowercase
        $searchword = strtolower($searchword);

        // get file with all available searchwords
        $file = fopen(__DIR__ . "/../available-searchwords.txt", "r");

        // check if searchword is in file
        while(!feof($file)) {
            // get line from the file and convert to lowercase
            $line = fgets($file);
            $line = strtolower($line);

            // check if line is the same as the searchword
            if (trim($line) == $searchword) {
                fclose($file);
                return true;
            }
        }

        // close the file and return false
        fclose($file);
        return false;
    }

}
?>