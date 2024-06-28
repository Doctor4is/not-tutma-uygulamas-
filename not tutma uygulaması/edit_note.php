<?php
session_start();
require 'db.php';

// Oturum kontrolü
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Not ID kontrolü
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$not_id = $_GET['id'];

// Not bilgilerini çekme
$stmt = $pdo->prepare("SELECT * FROM notes WHERE id = ? AND user_id = ?");
$stmt->execute([$not_id, $_SESSION['user_id']]);
$not = $stmt->fetch();

// Not bulunamadıysa ana sayfaya yönlendir
if (!$not) {
    header("Location: index.php");
    exit;
}

// Notu güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $icerik = $_POST['icerik'];

    $stmt = $pdo->prepare("UPDATE notes SET content = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$icerik, $not_id, $_SESSION['user_id']]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Düzenle</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Not Düzenle</h1>
        <form method="POST" action="">
            <textarea name="icerik" rows="4" cols="50" required><?= htmlspecialchars($not['content']) ?></textarea><br><br>
            <button type="submit" class="btn">Kaydet</button>
        </form>
        <a href="index.php" class="btn">İptal</a>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
