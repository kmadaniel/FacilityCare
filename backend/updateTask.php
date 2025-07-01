<?php
echo '<pre>';
print_r($_POST);
echo '</pre>';
session_start();
require_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reportId = $_POST['report_id'];
    $status = $_POST['status'];
    $notes = trim($_POST['notes']) ?? null;
    $changedBy = $_SESSION['technician_id'];
    $action = $_POST['action'];

    if ($action === 'complete') {
        $status = 'resolved';
    } elseif ($action === 'cancel') {
        $status = 'resolved'; // atau boleh abaikan kalau taknak log cancel
    }

    if (empty($status)) {
        $status = 'in_progress'; // fallback
    }

    // Insert into statuslog
    $stmt = $pdo->prepare("
        INSERT INTO statuslog (report_id, status, notes, changed_by, timestamp)
        VALUES (?, ?, ?, ?, NOW())
    ");
    $stmt->execute([$reportId, $status, $notes, $changedBy]);

    // Upload photos (if any)
    if (!empty($_FILES['photo']['name'][0])) {
        $uploadDir = '../uploads/';
        foreach ($_FILES['photo']['tmp_name'] as $index => $tmpName) {
            $fileName = uniqid('photo_') . '_' . basename($_FILES['photo']['name'][$index]);
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($tmpName, $filePath)) {
                $stmt = $pdo->prepare("INSERT INTO media (report_id, file_path) VALUES (?, ?)");
                $stmt->execute([$reportId, $fileName]);
            }
        }
    }

    // Redirect back to task detail
    header("Location: ../technician/taskDetail.php?report_id=" . $reportId);
    exit();
}
