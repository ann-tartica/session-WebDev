<?php
require_once __DIR__ . "/session_check.php";
// Already logged in check is handled by session_check.php

$_SESSION = [];

// Delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}


session_destroy();


header('Content-Type: application/json');
echo json_encode(['success' => true, 'message' => 'Logged out successfully!']);
exit;
