<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $icerik = $_POST['icerik'];
    $kullanici_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO notes (user_id, content) VALUES (?, ?)");
    $stmt->execute([$kullanici_id, $icerik]);

    echo "Not eklendi!";
}
?>

<!DOCTYPE html>
<html>
head>
    <title>Not Ekle</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Not Ekle</h1>
        <form method="POST">
            Not: <textarea name="icerik" required></textarea><br>
            <button type="submit">Ekle</button>
        </form>
        <a href="index.php">Anasayfa</a>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
