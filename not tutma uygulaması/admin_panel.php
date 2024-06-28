<?php
session_start();
require 'db.php';

// Kullanıcı admin değilse, anasayfaya yönlendir
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit;
}

// Tüm kullanıcıların notlarını çek
$stmt = $pdo->query("SELECT notes.id, notes.content, notes.created_at, users.username FROM notes JOIN users ON notes.user_id = users.id");
$notlar = $stmt->fetchAll();

// Tüm kullanıcıları çek
$stmt = $pdo->query("SELECT id, username FROM users");
$kullanicilar = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Paneli</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .sidebar {
            position: fixed;
            top: 120px; /* Navbar yüksekliği */
            right: 20px;
            width: 200px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar h3 {
            margin-top: 0;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Admin Paneli</h1>
        
        <h2>Tüm Kullanıcıların Notları</h2>
        <ul>
            <?php foreach ($notlar as $not): ?>
                <li>
                    <strong>Kullanıcı:</strong> <?= htmlspecialchars($not['username']) ?><br>
                    <strong>Not:</strong> <?= htmlspecialchars($not['content']) ?><br>
                    <strong>Oluşturma Tarihi:</strong> <?= $not['created_at'] ?><br>
                    <a href="admin_edit_note.php?id=<?= $not['id'] ?>" class="btn">Düzenle</a>
                    <a href="admin_delete_note.php?id=<?= $not['id'] ?>" class="btn" onclick="return confirm('Bu notu silmek istediğinizden emin misiniz?')">Sil</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="sidebar">
        <h3>Kullanıcılar</h3>
        <ul>
            <?php foreach ($kullanicilar as $kullanici): ?>
                <li><?= htmlspecialchars($kullanici['username']) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
