<?php
session_start();
require 'db.php';

// Kullanıcı admin değilse, anasayfaya yönlendir
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $note_id = $_POST['id'];
    $icerik = $_POST['icerik'];

    $stmt = $pdo->prepare("UPDATE notes SET content = ? WHERE id = ?");
    $stmt->execute([$icerik, $note_id]);

    header("Location: admin_panel.php");
    exit;
}

$note_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM notes WHERE id = ?");
$stmt->execute([$note_id]);
$not = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Notu Düzenle</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Notu Düzenle</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= $note_id ?>">
            <label for="icerik">Not İçeriği:</label><br>
            <textarea id="icerik" name="icerik" rows="4" cols="50" required><?= htmlspecialchars($not['content']) ?></textarea><br>
            <button type="submit">Güncelle</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
