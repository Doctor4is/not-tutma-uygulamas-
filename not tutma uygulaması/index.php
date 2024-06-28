<?php
session_start();
require 'db.php';

// Admin notlarını listeleme
$stmt = $pdo->query("SELECT * FROM admin_notes");
$admin_notlari = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Tutma Uygulaması - Ana Sayfa</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Not Tutma Uygulaması</h1>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Oturum açmış kullanıcı için notlar -->
            <h2>Son Notum</h2>
            <?php
            $kullanici_id = $_SESSION['user_id'];
            $stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
            $stmt->execute([$kullanici_id]);
            $son_not = $stmt->fetch();
            ?>
            <?php if ($son_not): ?>
                <p><?= htmlspecialchars($son_not['content']) ?> - <a href="note_detail.php?id=<?= $son_not['id'] ?>">Detaylar</a></p>
            <?php else: ?>
                <p>Henüz not eklemediniz.</p>
            <?php endif; ?>
            <a href="add_note.php" class="btn">Yeni Not Ekle</a>
            <p><a href="notlarim.php">Tüm Notlarım için Tıklayınız</a></p>
            <?php if ($_SESSION['is_admin']): ?>
                <a href="admin_panel.php" class="btn admin-btn">Admin Paneli</a>
            <?php endif; ?>
            <a href="logout.php" class="btn logout-btn">Çıkış Yap</a>
        <?php else: ?>
            <!-- Oturum açmamış kullanıcı için giriş veya kayıt ol bağlantıları -->
            <p>Lütfen devam etmek için giriş yapın veya kayıt olun.</p>
        <?php endif; ?>

        <!-- Admin notları her durumda göster -->
        <h2>Admin Notları</h2>
        <ul class="not-listesi">
            <?php foreach ($admin_notlari as $not): ?>
                <li><?= htmlspecialchars($not['content']) ?></li>
            <?php endforeach;
