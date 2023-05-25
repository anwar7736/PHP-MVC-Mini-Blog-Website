<?php include base_path('Views/partials/head.blade.php') ?>
<?php include base_path('Views/partials/nav.blade.php') ?>


<div class="container-fluid mt-3 row card p-3 bg-light">
    <h3 class="text-center text-danger"><b>User Login</b></h3>
    <form action="/login" method="POST" class="col-md-4 offset-md-4">
    <div class="mb-3 mt-3">
        <strong class="text-danger"><?= $error ?? '' ?></strong><br>
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?= old('email') ?>">
            <p class="text-danger"><?= $errors['email'] ?? '' ?></p>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="<?= old('password') ?>">
        <p class="text-danger"><?= $errors['password'] ?? '' ?></p>
    </div>
    <div class="form-check mb-3">
        <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
        </label>
    </div>    
    <div class="form-check mb-3">
        <a href="/register">I'm not registered?Register now</a> 
    </div>
    <button type="submit" class="btn btn-success">Login</button>
    </form> 
</div>



<?php include base_path('Views/partials/foot.blade.php') ?>