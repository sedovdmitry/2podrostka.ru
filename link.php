<?php
$url = $_GET["url"];

// Validate the URL to prevent potential security issues
if (filter_var($url, FILTER_VALIDATE_URL)) {
    // Set a 5-second delay
    sleep(5);

    // Perform the redirect
    header("Location: $url");
    exit(); // Make sure to exit after the header to ensure a proper redirect
} else {
    echo "Invalid URL";
}
?>
