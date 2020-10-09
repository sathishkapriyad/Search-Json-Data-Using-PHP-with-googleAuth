<?php 
require_once dirname(__FILE__).'\vendor\google-api-php-client-master\vendor\autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('214990389471-88k2okbc3e5jr4juq0dodmj85bqdc4ef.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('fqKrphXYX5o2_0wsjRv9Q4nX');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost:84/searchjob/login.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();
?>