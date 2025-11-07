<?php
// Minimal session helper used by several handlers.
// Keeps behavior simple: start session if not already started.
// Add any lightweight session checks here if needed later.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Optional helper: check if user is logged in
if (!function_exists('is_user_logged_in')) {
    function is_user_logged_in()
    {
        return !empty($_SESSION['user_id']);
    }
}
