<!-- add head and header -->
<?php
require_once __DIR__ . '../../components/head.php';
require_once __DIR__ . '../../components/header.php';
?>

<section class="vh-100 bg-image">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Login</h2>

                            <form method="post" action="/login/login">

                                <div class="form-outline mb-4">
                                    <input name="uid" type="text" id="form3Example1cg"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example1cg">Username or email</label>
                                </div>


                                <div class="form-outline mb-4">
                                    <input name="password" type="password" id="form3Example4cg"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example4cg">Password</label>
                                </div>

                                <div class="errorLabel">
                                    <p>
                                        <?= $model != null ? $model : ''; ?>
                                    </p>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" name="submit"
                                        class="button btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Don't have an account yet? <a href="/signup"
                                        class="fw-bold text-body"><u>Signup here</u></a></p>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>