<?php
session_start();
include __DIR__ . "/database.php"; 
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$retype = $_POST['retypePassword'] ?? '';

if ($password !== $retype) {
    echo json_encode(['success' => false, 'message' => 'Passwords do not match']);
    exit;
}
if (strlen($username) < 3 || strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => 'Username or password too short']);
    exit;
}

// ensure unique username or email
$stmt = $conn->prepare("SELECT id FROM users WHERE user = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Username or email already exists']);
    exit;
}

// insert
$hashed = password_hash($password, PASSWORD_DEFAULT);
$ins = $conn->prepare("INSERT INTO users (`user`, `pass`, `email`, `reg_date`) VALUES (?, ?, ?, NOW())");
$ins->bind_param("sss", $username, $hashed, $email);
if ($ins->execute()) {
    $_SESSION['user_id'] = $conn->insert_id;
    $_SESSION['username'] = $username;
    echo json_encode(['success' => true, 'message' => 'Account created and logged in']);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>
