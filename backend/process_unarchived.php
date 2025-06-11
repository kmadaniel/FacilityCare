<?php
session_start();
require_once '../connection.php';

$report_id = $_GET['id'] ?? null;

if ($report_id) {
    $stmt = $pdo->prepare("UPDATE report SET archive = 0 WHERE report_id = ?");
    $stmt->execute([$report_id]);

    header("Location: ../admin/archived.php?restored=1");
    exit();
}
?>
