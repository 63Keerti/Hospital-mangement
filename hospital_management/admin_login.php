<?php
session_start();

// Hardcoded credentials
$admin_email = "";
$admin_password = "";

$error = "";

// Generate random CAPTCHA
function generateCaptcha($length = 6) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $captcha = '';
    for($i=0;$i<$length;$i++){
        $captcha .= $chars[rand(0,strlen($chars)-1)];
    }
    return $captcha;
}

// Generate new captcha if not exists
if(!isset($_SESSION['captcha'])){
    $_SESSION['captcha'] = generateCaptcha();
}

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $captcha = $_POST['captcha'] ?? '';

    if($email === $admin_email && $password === $admin_password){
        if($captcha === $_SESSION['captcha']){
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Incorrect CAPTCHA!";
            $_SESSION['captcha'] = generateCaptcha(); // regenerate captcha
        }
    } else {
        $error = "Invalid email or password!";
        $_SESSION['captcha'] = generateCaptcha(); // regenerate captcha
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login · MediCare</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
body { font-family:'Inter',sans-serif; background:#f5f9fc; display:flex; justify-content:center; align-items:center; height:100vh; }
.login-box { background:white; padding:2.5rem; border-radius:20px; box-shadow:0 15px 40px rgba(0,0,0,0.15); width:350px; }
h2 { text-align:center; color:#1e90ff; margin-bottom:1.5rem; }
input[type="email"], input[type="password"], input[type="text"] { width:100%; padding:0.8rem; margin:0.5rem 0 1rem 0; border-radius:8px; border:1px solid #ccc; }
button { width:100%; padding:0.8rem; background:#1e90ff; color:white; border:none; border-radius:8px; font-weight:600; cursor:pointer; transition:0.3s; }
button:hover { background:#0b5fa5; }
.captcha-box { display:flex; align-items:center; justify-content:space-between; margin-bottom:1rem; }
.captcha-box span { background:#e5f0ff; padding:0.5rem 1rem; font-weight:600; font-family:monospace; border-radius:6px; letter-spacing:2px; }
.error { color:red; margin-bottom:1rem; text-align:center; }
.refresh-btn { cursor:pointer; background:#1e90ff; color:white; padding:0.3rem 0.6rem; border-radius:5px; border:none; font-size:0.9rem; }
.refresh-btn:hover { background:#0b5fa5; }
</style>
<script>
function refreshCaptcha(){
    fetch('admin_login.php?refresh_captcha=1')
    .then(response => response.text())
    .then(data => {
        document.getElementById('captchaText').innerText = data;
    });
}
</script>
</head>
<body>

<div class="login-box">
    <h2>Admin Login</h2>
    <?php if($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <div class="captcha-box">
            <span id="captchaText"><?= $_SESSION['captcha'] ?></span>
            <button type="button" class="refresh-btn" onclick="location.reload();">Refresh</button>
        </div>

        <input type="text" name="captcha" placeholder="Enter CAPTCHA" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>

<?php
// Handle AJAX captcha refresh
if(isset($_GET['refresh_captcha'])){
    $_SESSION['captcha'] = generateCaptcha();
    echo $_SESSION['captcha'];
    exit;
}
?>
