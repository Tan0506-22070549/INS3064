<?php
// Set the session save path
session_save_path('C:/laragon/tmp');
$cookieName = "username";
$value = "Gulnara Serik";

// Set the cookie
setcookie($cookieName, $value, time() + 3600, "/");

// Start the session
session_start();

// Set the session variable
$_SESSION[$cookieName] = $value;

// Display the cookie value
echo "Cookie value: " . $_COOKIE[$cookieName] . "";

// Display the session variable value
echo "Session variable value: " . $_SESSION[$cookieName];

?>
