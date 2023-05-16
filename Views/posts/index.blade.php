<?php require('Views/partials/head.blade.php') ?>
<?php require('Views/partials/nav.blade.php') ?>


<div class="container-fluid mt-3">
  <h3 class="text-center text-danger">All Post List</h3><hr>
  <div class="mb-3" align="center">
    <a href="javascript:void(0)" class="btn btn-success btn-sm" >Publish New Post</a>
</div>
   <div class="row">
    <?php foreach($posts as $key => $post) { ?>
    <div class="card col-md-3">
        <img src="public/images/<?= $post['image'] ?>" class="card-img-top" alt="" height="200">
        <div class="card-body">
            <h5 class="card-title"><?= $post['title'] ?></h5>
            <p class="card-text"><?= substr($post['body'], 0, 250) ?></p><hr>
            <p class="card-text"><?= $post['view'] ?> views <br>
                Published at : <?= date('d F, Y', strtotime($post['published_at'])) ?><br>
                Published By : <?= $post['name'] ?>
            </p>
            <a href="/post-show?id=<?= $post['id'] ?>" class="btn btn-success">Read More...</a>
        </div>`
    </div>  
    <?php } ?>
    </div>
</div>



<?php require('Views/partials/foot.blade.php') ?>