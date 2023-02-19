<div class="container py-5 ">
    <div class="row pt-5">
        <div class="col">
            <h1>Search results for: <?= htmlspecialchars($_GET['search'])  ?></h1>
        </div>
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