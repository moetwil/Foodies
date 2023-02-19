<div class="container py-5 ">
    <div class="col py-5">
        <h1>Searchresults for: <?= $_GET['search'] ?></h1>
    </div>
    <div class="col">
        <div class="row ">
            <?php
                foreach ($model as $recipe) {
                    require('recipepreview.php');
                }
            ?>
        </div>
    </div>
</div>