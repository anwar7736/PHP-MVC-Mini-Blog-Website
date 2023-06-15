<?php use App\Http\Controllers\Auth\Auth; ?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <img src="<?= getFilePath('default', 'site_logo.png') ?>" alt="" height="50" width="70">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">     
      <li class="nav-item">
          <a class="nav-link <?= isActive('/') ?>" href="/">All Posts</a>
      </li>        
      <?php if(Auth::user()) { ?>
      <li class="nav-item">
        <a class="nav-link <?= isActive('/my-post') ?>" href="/my-post">My Posts (<?= auth_post_count() ?>)</a>
      </li>    
      <?php } ?>      
      <li class="nav-item">
        <a class="nav-link <?= isActive('/post-create') ?>" href="/post-create">Publish New Post</a>
      </li>  
        <?php if(Auth::user()) { ?>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><?= Auth::name() ?></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/my-profile">My Profile</a></li>
            <li><a class="dropdown-item" href="/my-post">My Posts (<?= auth_post_count() ?>)</a></li>
            <li>
              <form method="POST" action="/logout" id="logout-form">
                <a class="dropdown-item" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
              </form>
            </li>
          </ul>
        </li>
        <?php } else  {  ?>
          <li class="nav-item">
            <a class="nav-link <?= isActive('/login') ?>" href="/login">Login</a>
          </li>            
          <li class="nav-item">
            <a class="nav-link <?= isActive('/register') ?>" href="/register">Register</a>
          </li>  

        <?php } ?>
      </ul>
    </div>
  </div>
</nav>