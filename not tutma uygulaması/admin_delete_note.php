<?php
session_start();
require 'db.php';

// Kullanıcı admin değilse, anasayfaya yönlendir
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit;
}

$note_id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM notes WHERE id = ?");
$stmt->execute([$note_id]);

header("Location: admin_panel.php");
exit;
?>
