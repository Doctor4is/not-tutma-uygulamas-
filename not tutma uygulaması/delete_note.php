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

// Notu silme işlemi
$stmt = $pdo->prepare("DELETE FROM notes WHERE id = ? AND user_id = ?");
$stmt->execute([$not_id, $_SESSION['user_id']]);

header("Location: index.php");
exit;
?>
