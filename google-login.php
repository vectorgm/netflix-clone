<?php
// Demo popup page to simulate Google OAuth sign-in for local testing.
// In a real app this endpoint would redirect to Google's OAuth flow.
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Google Sign-In (Demo)</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;padding:20px}</style>
</head>
<body>
    <h2>Google Sign-In (Demo)</h2>
    <p>This page simulates a successful Google sign-in. Click the button to continue.</p>
    <button id="continue">Continue as Google User</button>

    <script>
        document.getElementById('continue').addEventListener('click', () => {
            const user = { name: 'Google Demo', email: 'googleuser@example.com', bio: 'Signed in with Google (demo)' };
            if (window.opener && !window.opener.closed) {
                window.opener.postMessage({ provider: 'google', success: true, user }, '*');
            }
            window.close();
        });
    </script>
</body>
</html>

