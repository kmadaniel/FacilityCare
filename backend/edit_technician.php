<?php
session_start();
require_once '../connection.php';

// Semak ID technician wajib
if (!isset($_POST['technician_id'])) {
    die("Invalid request.");
}

$technicianId = $_POST['technician_id'];
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$status = trim($_POST['technician_status']);

try {
    // 1. Handle image upload (optional)
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../image/tech_profile/';
        $fileName = basename($_FILES['profile_photo']['name']);
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = $technicianId . '.' . $ext;
        $uploadPath = $uploadDir . $newFileName;

        // Move uploaded file
        move_uploaded_file($_FILES['profile_photo']['tmp_name'], $uploadPath);

        // Store relative path
        $profilePhotoPath = 'profile/' . $newFileName;

        $stmt = $pdo->prepare("
            UPDATE user 
            SET name = ?, email = ?, phone = ?, profile_pic = ?, position = ? 
            WHERE user_id = ?
        ");
        $stmt->execute([$name, $email, $phone, $profilePhotoPath, $status, $technicianId]);
    } else {
        // Update without changing photo
        $stmt = $pdo->prepare("UPDATE technician SET name = ?, email = ?, phone_number = ?, technician_status = ? WHERE user_id = ?");
        $stmt->execute([$name, $email, $phone, $status, $technicianId]);
    }

    $_SESSION['success'] = "Technician updated successfully.";
    header("Location: ../Admin/allTechnician.php"); // ubah ikut file kau
    exit();
} catch (PDOException $e) {
    die("Error updating technician: " . $e->getMessage());
}
