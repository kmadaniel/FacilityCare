<?php
session_name("admin_session");
session_start();
require_once '../connection.php';

$report_id = $_GET['id'] ?? null;
if (!$report_id) {
    die("Invalid report ID.");
}

// Handle comment POST (from comment form)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notes'], $_SESSION['user_id'], $_POST['report_id'])) {
    $report_id = $_POST['report_id']; 
    $user_id = $_SESSION['user_id'];
    $notes = trim($_POST['notes']);

    if (!empty($notes)) {
        // Get current status
        $stmt = $pdo->prepare("
            SELECT status FROM StatusLog 
            WHERE report_id = ? 
            ORDER BY timestamp DESC 
            LIMIT 1
        ");
        $stmt->execute([$report_id]);
        $currentStatus = $stmt->fetchColumn() ?: 'open';

        // Insert new statuslog with same status, just adding comment
        $insert = $pdo->prepare("
            INSERT INTO StatusLog (report_id, status, notes, changed_by, timestamp)
            VALUES (?, ?, ?, ?, NOW())
        ");
        $insert->execute([$report_id, $currentStatus, $notes, $user_id]);
    }

    // Redirect to prevent resubmission
    header("Location: viewReport.php?id=" . $report_id);
    exit();
}

// Handle `?open=1` - insert 'open' status if not already
if (isset($_GET['open']) && $_GET['open'] == 1 && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $checkStmt = $pdo->prepare("
        SELECT status FROM StatusLog 
        WHERE report_id = ? 
        ORDER BY timestamp DESC 
        LIMIT 1
    ");
    $checkStmt->execute([$report_id]);
    $latestStatus = $checkStmt->fetchColumn();

   if (!$latestStatus) {
        // Hanya insert "open" kalau report ini belum ada status langsung
        $insertStmt = $pdo->prepare("
            INSERT INTO statuslog (report_id, status, notes, changed_by, timestamp)
            VALUES (?, 'open', 'Report has been opened', ?, NOW())
        ");
        $insertStmt->execute([$report_id, $user_id]);
    }

    // Redirect to clean URL
    header("Location: viewReport.php?id=" . $report_id);
    exit();
}


// Fetch report info
$stmt = $pdo->prepare("
    SELECT r.*, u.name AS reporter_name, u.email AS reporter_email, u.position
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
$mediaStmt = $pdo->prepare("SELECT file_path, media_type, uploaded_by_role FROM Media WHERE report_id = :id");
$mediaStmt->execute(['id' => $report_id]);
$mediaFiles = $mediaStmt->fetchAll();

$staffMedia = array_filter($mediaFiles, fn($m) => $m['uploaded_by_role'] === 'staff');
$technicianMedia = array_filter($mediaFiles, fn($m) => $m['uploaded_by_role'] === 'technician');

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

// Dapatkan status terkini
$statusStmt = $pdo->prepare("
    SELECT status, timestamp 
    FROM statuslog 
    WHERE report_id = ? 
    ORDER BY timestamp DESC 
    LIMIT 1
");
$statusStmt->execute([$report['report_id']]);
$latestStatusRow = $statusStmt->fetch();

$lastUpdated = $latestStatusRow['timestamp'] ?? $report['created_at'];

// Dapatkan nama technician (assigned_to)
$techStmt = $pdo->prepare("
    SELECT name
    FROM user 
    WHERE user_id = ?
");
$techStmt->execute([$report['technician_id'] ?? '']);
$technicianName = $techStmt->fetchColumn() ?? 'Not Assigned';

?>
