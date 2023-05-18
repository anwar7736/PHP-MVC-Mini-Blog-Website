
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">     
        <li class="nav-item">
          <a class="nav-link <?= isActive('/') ?>" href="/">All Posts</a>
        </li>          
        <li class="nav-item">
          <a class="nav-link <?= isActive('/posts') ?>" href="/publish-post">Publish New Post</a>
        </li>  
        <?php if(Auth::user()) { ?>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><?= Auth::name() ?></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">My Profile</a></li>
            <li><a class="dropdown-item" href="#">Change Password</a></li>
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