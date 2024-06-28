<?php
session_start();
require 'db.php';

$error_message = '';

// Admin kullanıcıyı eklemek için bu işlemi yalnızca bir kez yapmalısınız
$stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE is_admin = 1");
$count = $stmt->fetchColumn();

if ($count == 0) {
    $kullanici_adi = 'admin';
    $sifre = password_hash('admin123', PASSWORD_DEFAULT); // Şifre hashleme

    $stmt = $pdo->prepare("INSERT INTO users (username, password, is_admin) VALUES (?, ?, 1)");
    $stmt->execute([$kullanici_adi, $sifre]);

    echo "Admin kullanıcı eklendi!";
}

// Kullanıcı kaydı işlemi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kullanici_adi = $_POST['kullanici_adi'];
    $sifre = $_POST['sifre'];

    // Kullanıcı adının daha önce kullanılıp kullanılmadığını kontrol et
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$kullanici_adi]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $error_message = "Bu kullanıcı adı zaten kullanılıyor!";
    } else {
        // Şifreyi hashle ve veritabanına yeni kullanıcıyı ekle
        $hashed_password = password_hash($sifre, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$kullanici_adi, $hashed_password]);

        echo "Kayıt başarılı! <a href='login.php'>Giriş yap</a>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kayıt Sayfası</title>
</head>
<body>
    <h2>Kullanıcı Kaydı</h2>
    <form method="POST" action="">
        <label for="kullanici_adi">Kullanıcı Adı:</label><br>
        <input type="text" id="kullanici_adi" name="kullanici_adi" required><br><br>
        <label for="sifre">Şifre:</label><br>
        <input type="password" id="sifre" name="sifre" required><br><br>
        <button type="submit">Kayıt Ol</button>
    </form>
    <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
</body>
</html>
