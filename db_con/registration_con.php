<?php
session_start();
require_once 'conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $grave_name = $_POST['grave_name'];
    $grave_location = $_POST['grave_location'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Form validation
    if (empty($full_name) || empty($grave_name) || empty($grave_location) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: ../php/device_registration.php');
        exit();
    }

    if (strlen($password) < 6) {
        $_SESSION['error'] = 'Password must be at least 6 characters long.';
        header('Location: ../php/device_registration.php');
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: ../php/device_registration.php');
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an SQL statement
    $sql = "INSERT INTO guesttbl (full_name, grave_name, grave_location, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("sssss", $full_name, $grave_name, $grave_location, $email, $hashed_password);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Registration successful!';
            header('Location: ../php/device_registration.php');
        } else {
            $_SESSION['error'] = 'Error: ' . $stmt->error;
            header('Location: ../php/device_registration.php');
        }
        
        $stmt->close();
    } else {
        $_SESSION['error'] = 'Error: ' . $conn->error;
        header('Location: ../php/device_registration.php');
    }

    $conn->close();
} else {
    $_SESSION['error'] = 'Invalid request method.';
    header('Location: ../php/device_registration.php');
}
?>
