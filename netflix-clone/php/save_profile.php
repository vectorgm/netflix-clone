<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /index.html');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$bio = trim($_POST['bio'] ?? '');

$usersFile = __DIR__ . '/users.json';
$users = [];
if (file_exists($usersFile)) {
    $users = json_decode(file_get_contents($usersFile), true) ?: [];
}

$original = $_SESSION['user']['_original_email'] ?? $_SESSION['user']['email'];

foreach ($users as &$u) {
    if (isset($u['email']) && $u['email'] === $original) {
        $u['name'] = $name;
        $u['email'] = $email;
        $u['bio'] = $bio;
        break;
    }
}
unset($u);

file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

// Update session and original email
$_SESSION['user']['name'] = $name;
$_SESSION['user']['email'] = $email;
$_SESSION['user']['bio'] = $bio;
$_SESSION['user']['_original_email'] = $email;

header('Location: /php/profile.php');
exit;
?>
