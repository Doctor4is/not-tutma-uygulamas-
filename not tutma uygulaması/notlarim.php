<?php
session_start();
require 'db.php';

// Oturum kontrolü
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$kullanici_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ?");
$stmt->execute([$kullanici_id]);
$notlar = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notlarım</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Notlarım</h1>
        <a href="add_note.php" class="btn">Yeni Not Ekle</a>
        <ul class="not-listesi">
            <?php foreach ($notlar as $not): ?>
                <li>
                    <?= htmlspecialchars($not['content']) ?> - <?= $not['created_at'] ?>
                    <a href="edit_note.php?id=<?= $not['id'] ?>" class="btn">Düzenle</a>
                    <a href="delete_note.php?id=<?= $not['id'] ?>" class="btn" onclick="return confirm('Bu notu silmek istediğinizden emin misiniz?')">Sil</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php if ($_SESSION['is_admin']): ?>
            <a href="admin_panel.php" class="btn admin-btn">Admin Paneli</a>
        <?php endif; ?>
        <a href="logout.php" class="btn logout-btn">Çıkış Yap</a>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
