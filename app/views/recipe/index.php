<div class="container py-5 px-auto ">
    <div class="row py-5">
        <div class="col-lg-5 col-sm-12 mt-sm-5 d-none d-sm-block">
            <img class="img recipeDetailImg" src="<?= $model->ImageUrl;?>" alt="recipe image">
        </div>
        <div class="col">
            <h1><?= $model->Title;?></h1>
            <h4>Publisher: <?= $model->Publisher;?></h4>
            <div class="ingredients-container">
                <h4>Ingredients</h4>
            </div>
            <div class="amount mt-3">
                <h4>Number of persons:</h4>
                <input type="number" value="1" min="1" name="amount" id="amountInput">
            </div>
            <div id="button-container" class="mt-5 d-sm-flex"></div>
        </div>
    </div>
</div>

<script defer src="/js/recipe.js"></script>