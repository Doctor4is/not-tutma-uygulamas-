<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kullanici_adi = $_POST['kullanici_adi'];
    $sifre = $_POST['sifre'];

    // Kullanıcıyı veritabanından sorgula
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$kullanici_adi]);
    $user = $stmt->fetch();

    // Kullanıcı varsa ve şifre doğruysa oturum başlat ve yönlendir
    if ($user && password_verify($sifre, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];
        header("Location: index.php");
        exit;
    } else {
        $error_message = "Geçersiz kullanıcı adı veya şifre!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Giriş Yap</title>
</head>
<body>
    <h2>Giriş Yap</h2>
    <form method="POST" action="">
        <label for="kullanici_adi">Kullanıcı Adı:</label><br>
        <input type="text" id="kullanici_adi" name="kullanici_adi" required><br><br>
        <label for="sifre">Şifre:</label><br>
        <input type="password" id="sifre" name="sifre" required><br><br>
        <button type="submit">Giriş Yap</button>
    </form>
    <p>Kayıtlı değil misiniz? <a href="register.php">Kayıt Ol</a></p>
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
</body>
</html>
