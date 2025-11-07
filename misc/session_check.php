<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!function_exists('is_user_logged_in')) {
    function is_user_logged_in()
    {
        return !empty($_SESSION['user_id']);
    }
}
