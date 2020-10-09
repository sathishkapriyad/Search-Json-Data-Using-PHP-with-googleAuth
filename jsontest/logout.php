<?php 
require_once 'configuration.php';

//Reset OAuth access token
// $google_client->revokeToken();

//Destroy entire session data.
session_destroy();

//redirect page to login.php
header('location:login.php');
?>