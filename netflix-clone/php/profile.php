<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /index.html');
    exit;
}
$user = $_SESSION['user'];
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Profile</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .profile-photo { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid #e50914; }
        .actions { margin-top: 15px; display:flex; gap:10px; }
    </style>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($user['name'] ?? '') ?></h1>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email'] ?? '') ?></p>
    <div>
        <img src="<?= htmlspecialchars($user['photo'] ?? '/php/default-avatar.png') ?>" alt="Profile" class="profile-photo">
    </div>

    <h2>Edit Profile</h2>
    <?php if (!empty($_SESSION['upload_error'])): ?>
        <p style="color:red"><?= htmlspecialchars($_SESSION['upload_error']) ?></p>
        <?php unset($_SESSION['upload_error']); ?>
    <?php endif; ?>

    <form action="save_profile.php" method="post">
        <div>
            <label>Full name: <input type="text" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required></label>
        </div>
        <div>
            <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required></label>
        </div>
        <div>
            <label>Bio:<br>
                <textarea name="bio" rows="4"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
            </label>
        </div>
        <div class="actions">
            <button type="submit">Save Profile</button>
            <a href="/index.html"><button type="button">Back to Site</button></a>
        </div>
    </form>

    <h2>Change Profile Photo</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label>Upload photo: <input type="file" name="photo" accept="image/*" required></label>
        <div class="actions">
            <button type="submit">Upload</button>
        </div>
    </form>

    <form action="logout.php" method="post" style="margin-top:20px;">
        <button type="submit">Sign Out</button>
    </form>
</body>
</html>
