
<?php
require_once(__DIR__ . '/../components/head.php');
require_once(__DIR__ . '/../components/header.php');
?>
<div class="container py-5">
    <div class="row py-5">
        <h1>No recipes found with searchword: <?= $_GET['search'];?></h1>
    </div>
</div>

<?php
require_once(__DIR__ . '/../components/footer.php');