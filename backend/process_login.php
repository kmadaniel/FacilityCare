<?php
session_start();
require_once '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "Please fill in both email and password.";
        header("Location: ../login.php");
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT user_id, name, email, password FROM User WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            $_SESSION['login_error'] = "No user found with that email address.";
            header("Location: ../login.php");
            exit();
        }

        if (!password_verify($password, $user['password'])) {
            $_SESSION['login_error'] = "Incorrect password. Please try again.";
            header("Location: ../login.php");
            exit();
        }

        // Successful login
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];

        $firstChar = strtoupper(substr($user['user_id'], 0, 1));
        if ($firstChar === 'A') {
            header("Location: ../Admin/dashboard.php");
        } elseif ($firstChar === 'S') {
            header("Location: ../index.php");
        } elseif ($firstChar === 'T') {
            $_SESSION['technician_id'] = $user['user_id'];
            header("Location: ../technician/dashboardTech.php"); // <-- tukar ikut file technician punya dashboard
        } else {
            $_SESSION['login_error'] = "Unrecognized user role.";
            header("Location: ../login.php");
        }
    } catch (PDOException $e) {
        $_SESSION['login_error'] = "Database error: " . $e->getMessage();
        header("Location: ../login.php");
    }
}
