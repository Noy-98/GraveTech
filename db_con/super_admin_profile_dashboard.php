<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: ../php/Portal/Admin/login.php');
    exit();
}
require_once 'conn.php'; // Adjust the path if necessary

// Handle form submission to update profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $department_name = $_POST['department_name'];
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($first_name) || empty($last_name) || empty($department_name) || empty($email) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: ../php/dashboard/super_admin_dashboard/profile.php');
        exit();
    }

    if (strlen($new_password) < 6) {
        $_SESSION['error'] = 'Password must be at least 6 characters long.';
        header('Location: ../php/dashboard/super_admin_dashboard/profile.php');
        exit();
    }

    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header('Location: ../php/dashboard/super_admin_dashboard/profile.php');
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update user data in the database
    $sql_update = "UPDATE userdepartmenttbl SET first_name = ?, last_name = ?, department_name = ?, email = ?, password = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssssi", $first_name, $last_name, $department_name, $email , $hashed_password, $user_id);
    if ($stmt_update->execute()) {
        $_SESSION['success'] = "Profile updated successfully.";
        header('Location: ../php/dashboard/super_admin_dashboard/profile.php');
    } else {
        $_SESSION['error'] = "Error updating profile.";
        header('Location: ../php/dashboard/super_admin_dashboard/profile.php');
    }
    $stmt_update->close();
}

$conn->close();

header('Location: ../php/dashboard/super_admin_dashboard/profile.php');
exit();
?>
