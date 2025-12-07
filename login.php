<?php
// Simple login endpoint for local development.
// Accepts POST 'email' and 'password' and returns JSON and sets a PHP session user.
header('Content-Type: application/json');
session_start();

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (!$email || !$password) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email and password required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
    exit;
}

// Demo acceptance: any valid email + password works
$user = [
    'name' => explode('@', $email)[0],
    'email' => $email,
    'bio' => 'Demo user',
    'photo' => null
];

// Store user in session (server-side)
$_SESSION['user'] = $user;

echo json_encode(['success' => true, 'user' => $user]);
exit;
?>
<?php
session_start();
$usersFile = __DIR__ . '/users.json';
$users = [];
if (file_exists($usersFile)) {
    $content = file_get_contents($usersFile);
    $users = json_decode($content, true) ?: [];
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $found = null;
    foreach ($users as $u) {
        if (isset($u['email']) && $u['email'] === $email && isset($u['password']) && $u['password'] === $password) {
            $found = $u;
            break;
        }
    }

    if ($found) {
        // Remove password before storing in session
        unset($found['password']);
        $_SESSION['user'] = $found;
        // Keep original email to locate user record later
        $_SESSION['user']['_original_email'] = $email;
        header('Location: /php/profile.php');
        exit;
    } else {
        $_SESSION['login_error'] = 'Invalid credentials';
        header('Location: /index.html');
        exit;
    }
}

header('Location: /index.html');
exit;
?>
