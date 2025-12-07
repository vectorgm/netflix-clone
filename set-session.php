<?php
// Simple endpoint to set server-side session user from client-provided data (demo only).
// Expects JSON POST: { user: { name: '', email: '', ... } }
header('Content-Type: application/json');
session_start();

$input = file_get_contents('php://input');
if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No input']);
    exit;
}

$body = json_decode($input, true);
if (!$body || !isset($body['user'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'user object required']);
    exit;
}

// In production you must validate and sanitize this data and authenticate the request.
$_SESSION['user'] = $body['user'];

echo json_encode(['success' => true]);
exit;
?>
