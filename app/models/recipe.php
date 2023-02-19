<?php
class Recipe extends RecipePreview
{
    public array $Ingredients;
    public string $Publisher;

    public function __construct($recipeId, $title, $imageUrl, $ingredients, $publisher)
    {
        parent::__construct($recipeId, $title, $imageUrl);
        $this->Ingredients = $ingredients;
        $this->Publisher = $publisher;
    }
}
?>