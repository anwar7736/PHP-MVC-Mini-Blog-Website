<?php 
    included('partials.head');
    included('partials.nav') ;
    use App\Http\Controllers\Auth\Auth;
?>



<div class="container-fluid mt-3">
  <h3 class="text-center text-danger">View Post</h3>
    <div align="left">
            <a href="/" class="btn btn-secondary btn-sm" >Back to Home</a>
    </div>    
    <div align="right">
        <a href="/post-create" class="btn btn-success btn-sm" >Publish New Post</a>
    </div>
    <hr>
   <div class="row">
    <div class="card col-md-6 offset-md-3">
        <img src="<?= getFilePath('posts', $post['image'])?>" class="card-img-top" alt="" height="300">
        <div class="card-body">
            <h5 class="card-title"><?= $post['title'] ?></h5>
            <p class="card-text"><?= $post['body'] ?></p><hr>
            <p class="card-text"><?= $post['view'] ?> views <br>
                Published at : <?= date('d F, Y', strtotime($post['published_at'])) ?><br>
                Published By : <?= $post['name'] ?>
            </p>
            <?php if(Auth::user() && $post['user_id'] == Auth::id()){ ?>
                <a href="/post-edit?id=<?= $post['id'] ?>" class="btn btn-success btn-sm" >Edit</a>
                <form action="/post-destroy" method="POST" id="delete-form" class="mt-2">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete</button>
                </form>
            <?php } ?>
        </div>
    </div>  
    </div>
</div>

<?php included('partials.foot') ?>
