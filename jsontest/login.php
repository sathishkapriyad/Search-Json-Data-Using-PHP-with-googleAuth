<?php 

require_once 'configuration.php';
require_once 'authentication.php';
//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <?php require_once 'includes/styles.php' ?>
    <title>Search Job</title>
  </head>
  <body>
    <!--- Header Start --->
    <?php require_once 'includes/header.php' ?>
    <!--- Header End --->
    <div class="container">
        <div class="d-block" style="
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);">
            <a  href="<?php echo $google_client->createAuthUrl();?>">
                <img src="assets/images/google_sign_in.png" />
            </a>
        </div>
    </div>
    
    <?php require_once 'includes/javascripts.php' ?>
    
    <!--- Footer Start --->
    <?php require_once 'includes/footer.php' ?>
    <!--- Footer End --->
  </body>
</html>