<?php
session_start();
require_once 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($email) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: ../php/Portal/Admin/change_password.php');
        exit();
    }

    if (strlen($new_password) < 6) {
        $_SESSION['error'] = 'Password must be between 6';
        header('Location: ../php/Portal/Admin/change_password.php');
        exit();
    }

    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: ../php/Portal/Admin/change_password.php');
        exit();
    }

    // Select query to check if the user exists
    $stmt = $conn->prepare("SELECT id FROM userdepartmenttbl WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $_SESSION['error'] = 'User not found.';
        header('Location: ../php/Portal/Admin/change_password.php');
        exit();
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    // Update the password in the user table
    $sql = "UPDATE userdepartmenttbl SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashed_password, $email);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Password updated successfully.';
        header('Location: ../php/Portal/Admin/login.php');
        exit();
    } else {
        $_SESSION['error'] = 'Failed to update the password. Please try again.';
        header('Location: ../php/Portal/Admin/change_password.php');
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
