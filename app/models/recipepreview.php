<?php


class RecipePreview
{
    public string $RecipeId;
    public string $Title;
    public string $ImageUrl;

    public function __construct($recipeId, $title, $imageUrl)
    {
        $this->RecipeId = $recipeId;
        $this->Title = $title;
        $this->ImageUrl = $imageUrl;
    }
}
?>