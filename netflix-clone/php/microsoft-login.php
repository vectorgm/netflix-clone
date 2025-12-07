<?php
// Simple demo verifier for Microsoft ID token.
// Accepts JSON POST body: { id_token: '...' }
// For production, validate signature, audience, issuer and expiration using Microsoft's JWKS.
header('Content-Type: application/json');

$input = file_get_contents('php://input');
if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No input']);
    exit;
}

$body = json_decode($input, true);
if (!$body || !isset($body['id_token'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'id_token is required']);
    exit;
}

$id_token = $body['id_token'];

// Simple decode of JWT payload (insecure - demo only)
$parts = explode('.', $id_token);
if (count($parts) < 2) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid id_token format']);
    exit;
}

$payload = $parts[1];
$payload .= str_repeat('=', (4 - strlen($payload) % 4) % 4);
$decoded = base64_decode(strtr($payload, '-_', '+/'));
$claims = json_decode($decoded, true);
if (!$claims) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Failed to decode id_token']);
    exit;
}

$email = isset($claims['email']) ? $claims['email'] : (isset($claims['preferred_username']) ? $claims['preferred_username'] : null);
$name = isset($claims['name']) ? $claims['name'] : ($email ? explode('@', $email)[0] : 'Microsoft User');

$user = [
    'name' => $name,
    'email' => $email,
    'photo' => isset($claims['picture']) ? $claims['picture'] : null,
    'bio' => 'Signed in with Microsoft (demo)'
];

// Store in server session
session_start();
$_SESSION['user'] = $user;

echo json_encode(['success' => true, 'user' => $user, 'claims' => $claims]);
exit;
?>
