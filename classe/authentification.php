<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();

include_once __DIR__ . '/../includes/header.php';
include_once __DIR__ . '/autentification.php';


// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check the CSRF token when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        // The CSRF token is valid
        AuthController::login();

        // Regenerate CSRF token after successful form submission
        $_SESSION['csrf_token'] = generateCsrfToken();

	
    } else {
        // The CSRF token is invalid or missing
        die('Invalid CSRF token');
    }
}

ob_end_flush();
?>
