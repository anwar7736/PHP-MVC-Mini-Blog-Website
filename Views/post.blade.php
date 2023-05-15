<?php require('partials/head.blade.php') ?>
<?php require('partials/nav.blade.php') ?>


<div class="container-fluid mt-3">
  <h3 class="text-center text-danger">View Post</h3>
    <div align="left">
            <a href="/" class="btn btn-secondary btn-sm" >Back to Home</a>
    </div>    
    <div align="right">
        <a href="/publish-post" class="btn btn-success btn-sm" >Publish New Post</a>
    </div>
    <hr>
   <div class="row">
    <div class="card col-md-6 offset-md-3">
        <img src="public/images/<?= $post['image'] ?>" class="card-img-top" alt="" height="300">
        <div class="card-body">
            <h5 class="card-title"><?= $post['title'] ?></h5>
            <p class="card-text"><?= $post['body'] ?></p><hr>
            <p class="card-text"><?= $post['view'] ?> views <br>
                Published at : <?= date('d F, Y', strtotime($post['published_at'])) ?><br>
                Published By : <?= $post['name'] ?>
            </p>
            <?php if($post['user_id'] == 1){ ?>
                <a href="javascript:void(0)" class="btn btn-success btn-sm" >Edit</a>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this post?')">Delete</a>
            <?php } ?>
        </div>
    </div>  
    </div>
</div>



<?php require('partials/foot.blade.php') ?>