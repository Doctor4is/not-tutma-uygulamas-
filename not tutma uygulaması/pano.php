<?php
session_start();
require 'db.php';

$stmt = $pdo->query("SELECT * FROM admin_notes ORDER BY created_at DESC");
$admin_notlari = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pano</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Pano</h1>
        <?php if ($_SESSION && $_SESSION['is_admin']): ?>
            <form method="POST" action="admin_panel.php">
                <label for="icerik">Admin Notu Ekle:</label><br>
                <textarea id="icerik" name="icerik" rows="4" cols="50" required></textarea><br>
                <button type="submit">Ekle</button>
            </form>
        <?php endif; ?>
        
        <h2>Admin Notları</h2>
        <ul>
            <?php foreach ($admin_notlari as $not): ?>
                <li><?= htmlspecialchars($not['content']) ?> - <?= $not['created_at'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
