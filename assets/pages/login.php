<div class="login d-flex justify-content-center align-items-center vh-100 bg-light  ">
    <div class="col-4 bg-white border rounded p-4 shadow-sm">
        <form method="post" action="assets/php/actions.php?login">
            <div class="d-flex justify-content-center">
                <img class="mb-4" src="assets/images/pictogram.png" alt="" height="50">
            </div>
            

            <div class="form-floating mb-3">
                <input type="text" name="username_email" value="<?= showFormData('username_email') ?>" 
                    class="form-control rounded-0 border-secondary" placeholder="Username or Email" id="username_email">
                <label for="username_email" class="text-secondary">Username or Email</label>
            </div>
            <?= showError('username_email') ?>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control rounded-0 border-secondary" 
                    id="floatingPassword" placeholder="Password">
                <label for="floatingPassword" class="text-secondary">Password</label>
            </div>
            <?= showError('password') ?>
            <?= showError('checkuser') ?>

            <button class="btn btn-primary w-100 rounded-pill mt-3" type="submit">Log In</button>

            <div class="text-center my-3 text-muted">OR</div>

            <button class="btn btn-primary w-100 rounded-pill">
                <i class="bi bi-facebook"></i> Log in with Facebook
            </button>

            <a href="?forgotpassword&newfp" class="text-decoration-none d-block text-center mt-3 text-primary small">
                Forgot Password?
            </a>
        </form>

        <div class="text-center mt-4 border-top pt-3">
            <p class="mb-0">Don't have an account? 
                <a href="?signup" class="text-decoration-none text-primary fw-bold">Sign up</a>
            </p>
        </div>
    </div>
</div>
