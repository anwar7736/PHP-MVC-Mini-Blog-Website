<?php include('./Views/partials/head.blade.php') ?>
<?php include('./Views/partials/nav.blade.php') ?>


<div class="container-fluid mt-3 row card p-3 bg-light">
<h3 class="text-center text-danger"><b>User Register</b></h3>
    <form action="/register" method="POST" class="col-md-4 offset-md-4">
    <div class="mb-3 mt-3">
        <strong class="text-danger"><?= $error ?? '' ?></strong><br>
        <label for="name" class="form-label">Name:</label>
        <input type="name" class="form-control" id="name" placeholder="Enter name" name="name" value="<?= old('name') ?>">
            <p class="text-danger"><?= $errors['name'] ?? '' ?></p>
    </div>    
    <div class="mb-3 mt-3">
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
        <a href="/login">Already i have an account?Login</a> 
    </div>
    <button type="submit" class="btn btn-success">Register</button>
    </form> 
</div>



<?php include('./Views/partials/foot.blade.php') ?>