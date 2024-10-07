<?php
session_start();

// Generar un texto CAPTCHA aleatorio
$captcha_text = substr(md5(rand()), 0, 6);
$_SESSION['captcha_text'] = $captcha_text;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAPTCHA</title>
    <link rel="stylesheet" type="text/css" href="../css/capchat.css">
    
</head>
<body>
    <div class="captcha-container">
        <div class="captcha-text"><?php echo htmlspecialchars($captcha_text); ?></div>
    </div>
</body>
</html>
