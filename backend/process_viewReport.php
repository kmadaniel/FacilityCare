<?php
session_start();
require_once '../connection.php';

$report_id = $_GET['id'] ?? null;
if (!$report_id) {
    die("Invalid report ID.");
}

// Insert 'open' status only if not already 'open'
if (isset($_GET['open']) && $_GET['open'] == 1 && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Check if latest status is not 'open'
    $checkStmt = $pdo->prepare("
        SELECT status FROM StatusLog 
        WHERE report_id = ? 
        ORDER BY timestamp DESC 
        LIMIT 1
    ");
    $checkStmt->execute([$report_id]);
    $latestStatus = $checkStmt->fetchColumn();

    if ($latestStatus !== 'open') {
        $insertStmt = $pdo->prepare("
            INSERT INTO StatusLog (report_id, status, notes, changed_by, timestamp)
            VALUES (?, 'open', 'Report has been opened', ?, NOW())
        ");
        $insertStmt->execute([$report_id, $user_id]);
    }

    // Redirect to clean URL (without &open=1)
    header("Location: viewReport.php?id=" . $report_id);
    exit();
}

// Fetch report info
$stmt = $pdo->prepare("
    SELECT r.*, u.name AS reporter_name, u.email AS reporter_email
    FROM Report r
    JOIN User u ON r.user_id = u.user_id
    WHERE r.report_id = ?
");
$stmt->execute([$report_id]);
$report = $stmt->fetch();

if (!$report) {
    die("Report not found.");
}

// Fetch media files
$mediaStmt = $pdo->prepare("SELECT file_path, media_type FROM Media WHERE report_id = :id");
$mediaStmt->execute(['id' => $report_id]);
$mediaFiles = $mediaStmt->fetchAll();

// Fetch current status
$statusStmt = $pdo->prepare("
    SELECT status, notes, changed_by, timestamp 
    FROM StatusLog 
    WHERE report_id = ? 
    ORDER BY timestamp DESC 
    LIMIT 1
");
$statusStmt->execute([$report_id]);
$currentStatus = $statusStmt->fetch();

// Fetch all status history
$historyStmt = $pdo->prepare("
    SELECT sl.status, sl.notes, sl.timestamp, u.name AS changed_by 
    FROM StatusLog sl
    JOIN User u ON u.user_id = sl.changed_by
    WHERE sl.report_id = ?
    ORDER BY sl.timestamp DESC
");
$historyStmt->execute([$report_id]);
$statusHistory = $historyStmt->fetchAll();
?>