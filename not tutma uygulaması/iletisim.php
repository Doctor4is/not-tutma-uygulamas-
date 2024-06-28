<?php
session_start();
require 'db.php';

// Form gönderildiğinde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Veritabanına ekle
    $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $message]);

    // Geri bildirim mesajı
    $feedback_message = "Mesajınız başarıyla gönderildi!";
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>İletişim</h1>
        <p>Herhangi bir sorunuz veya geri bildiriminiz için bizimle iletişime geçebilirsiniz.</p>
        <p>Email: info@notlarim.com | Telefon: +90 555 555 5555</p>
        
        <?php if (isset($feedback_message)): ?>
            <p class="feedback"><?= $feedback_message ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="name">Adınız:</label><br>
            <input type="text" id="name" name="name" required><br><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            <label for="message">Mesajınız:</label><br>
            <textarea id="message" name="message" required></textarea><br><br>
            <button type="submit" class="btn">Gönder</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
