<?php

// ID of the Excel file on OneDrive
$file_id = '1234567890';

// Client ID and secret for your OneDrive app
$client_id = '57f1dc6d-6e2b-4101-827d-aa46682c16ce';
$client_secret = '3208a652-a82b-4440-9f99-b9054e3189e2';

// Redirect URI for your OneDrive app
$redirect_uri = 'http://localhost';

// Scope of the permissions you are requesting
$scopes = 'files.read';

// Generate a random state value to prevent CSRF attacks
$state = bin2hex(random_bytes(5));

// Store the state value in the session
session_start();
$_SESSION['state'] = $state;

// Construct the authorization URL
$auth_url = "https://login.microsoftonline.com/common/oauth2/v2.0/authorize?" .
            "client_id=$client_id&response_type=code&redirect_uri=$redirect_uri" .
            "&response_mode=query&scope=$scopes&state=$state";

// Redirect the user to the authorization URL
header("Location: $auth_url");

?>