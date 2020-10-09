<?php 
require_once 'configuration.php';

if(!isset($_SESSION['access_token'])) {
  //redirect page to login.php
  header('location:login.php');
}

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
    <title>Swivel Group Search Engine</title>
  </head>
  <body>
    <!--- Header Start --->
    <?php require_once 'includes/header.php' ?>
    <!--- Header End --->
    <div class="container">
      <ul class="nav nav-tabs mt-5">
        <li class="nav-item">
          <a class="nav-link <?php  echo (!isset($_GET['tab']) || $_GET['tab'] == 'organization') ? 'active': ''?>" href="?tab=organization">Organization</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php  echo isset($_GET['tab']) && $_GET['tab'] == 'users' ? 'active': ''?>" href="?tab=users">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php  echo isset($_GET['tab']) && $_GET['tab'] == 'tickets' ? 'active': ''?>" href="?tab=tickets">Tickets</a>
       </li>
      </ul>
      <div class="d-flex mt-5">
        <input type="text" id="search-text" placeholder="Search.." class="form-control mr-5" /> 
        <button type="button" id="search" class="btn btn-primary">Search</button>
      </div>
      <div id="filteredList" style="padding-bottom: 100px">
      </div>
     </div>
    
    <?php require_once 'includes/javascripts.php' ?>
    
    <!--- Footer Start --->
    <?php require_once 'includes/footer.php' ?>
    <!--- Footer End --->
  </body>
</html>