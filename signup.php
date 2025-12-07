<?php
header('Content-Type: application/json');
session_start();

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (!$name || !$email || !$password) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Name, email and password are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email.']);
    exit;
}

// NOTE: This is a demo stub. Do not store passwords like this in production.
$user = [
    'name' => $name,
    'email' => $email,
    'bio' => 'New demo user',
    'photo' => null
];

// Save server-side session
$_SESSION['user'] = $user;

echo json_encode(['success' => true, 'user' => $user]);
exit;
?>
