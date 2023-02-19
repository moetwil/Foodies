<div class="col py-3 d-flex justify-content-center align-items-center">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <img class="card-img-top" src="<?= $recipe->ImageUrl ?>" alt="Recipe preview image">
            <h5 class="card-title"><?= $recipe->Title?></h5>
            <a href="/recipe?id=<?= $recipe->RecipeId?>" class="button btn btn-primary">See recipe</a>
        </div>
    </div>
</div>