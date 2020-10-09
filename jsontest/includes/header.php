<?php
  $hasAuthenticated = false;
  if(isset($_SESSION['access_token'])) {
    $hasAuthenticated = true;
  }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
  <a class="navbar-brand" href="#">Swivel Group Search Engine</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <?php if($hasAuthenticated) { ?>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo isset($_SESSION['user_image']) ? $_SESSION['user_image'] : 'http://placehold.it/30x30' ?>" class="profile-image" style="border-radius: 50%; height: 30px; width: 30px"> <?php echo $_SESSION['user_first_name'] ?> <b class="caret"></b>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
           
    </ul>
    </div>
  <?php }?>
    </div>
</nav>