<?php
require_once 'includes/config.php';

// Unset all of the session variables related to Discord
if (isset($_SESSION['discord'])) {
    unset($_SESSION['discord']);
}

// Optionally, destroy the session entirely if you don't use it for anything else
session_destroy();

// Redirect to homepage or login page
header('Location: ' . $website['url']);
exit;