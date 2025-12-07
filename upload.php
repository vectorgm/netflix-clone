<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /index.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
    $file = $_FILES['photo'];
    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadsDir = __DIR__ . '/../uploads';
        if (!is_dir($uploadsDir)) mkdir($uploadsDir, 0755, true);

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('profile_') . '.' . $ext;
        $dest = $uploadsDir . '/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $dest)) {
            // update users.json
            $usersFile = __DIR__ . '/users.json';
            $users = [];
            if (file_exists($usersFile)) {
                $users = json_decode(file_get_contents($usersFile), true) ?: [];
            }

            $original = $_SESSION['user']['_original_email'] ?? $_SESSION['user']['email'];
            foreach ($users as &$u) {
                if (isset($u['email']) && $u['email'] === $original) {
                    $u['photo'] = '/uploads/' . $filename;
                    break;
                }
            }
            unset($u);
            file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

            // update session
            $_SESSION['user']['photo'] = '/uploads/' . $filename;
            header('Location: /php/profile.php');
            exit;
        } else {
            $_SESSION['upload_error'] = 'Failed to move uploaded file.';
        }
    } else {
        $_SESSION['upload_error'] = 'Upload error code: ' . $file['error'];
    }
}

header('Location: /php/profile.php');
exit;
?>
