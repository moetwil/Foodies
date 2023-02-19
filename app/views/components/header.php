<nav class="navbar navbar-expand-lg navbar-light fixed-top navColor" id="mainNav">
    <div class="container px-5 ">

    <div class="d-flex justify-center ">
        <a class="navbar-brand d-flex align-items-center" href="/">
            Foodies
        </a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="bi-list"></i>
        </button>
    </div>
        <div class="navbar-collapse collapse" id="navbarResponsive" style="">
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                <li class="nav-item"><a class="nav-link me-lg-3" href="#">Home</a></li>
            </ul>

            <!-- Show login or logout button -->
            <?php
            if (isset($_SESSION['userId'])) {
            ?>
            <button id="favourites-button" class="btn btn-primary rounded-pill px-3 mb-2 mx-2 mb-lg-0"
                data-bs-toggle="modal" data-bs-target="#feedbackModal">
                <span class="d-flex align-items-center">
                    <i class="bi bi-heart-fill me-2"></i>
                    <span class="small">Favourites</span>
                </span>
            </button>
            <button id="logout-button" class="btn btn-outline-primary rounded-pill px-3 mb-2 mb-lg-0"
                data-bs-toggle="modal" data-bs-target="#feedbackModal">
                <span class="d-flex align-items-center">
                    <i class="bi bi-box-arrow-left me-2"></i>
                    <span class="small">Logout</span>
                </span>
            </button>
            <?php
            } else {
            ?>


            <button id="login-button" class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" data-bs-toggle="modal"
                data-bs-target="#feedbackModal">
                <span class="d-flex align-items-center">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    <span class="small">Login</span>
                </span>
            </button>

            </li>
            <?php
            }
            ?>
        </div>
    </div>
</nav>
<script src="/js/header.js"></script>