<?php
session_start();
require_once 'conn.php'; // Adjust the path if necessary

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate if email exists in the database
    $stmt = $conn->prepare("SELECT id, password FROM guesttbl WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        $_SESSION['error'] = 'Email not found.';
        header('Location: ../php/device_login.php');
        exit();
    }

    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    // Validate password
    if (!password_verify($password, $hashed_password)) {
        $_SESSION['error'] = 'Incorrect password.';
        header('Location: ../php/device_login.php');
        exit();
    }

    // If everything is valid, set session variables
    $_SESSION['user_id'] = $id;
    $_SESSION['email'] = $email;
    $_SESSION['logged_in'] = true;

    // Redirect to the dashboard or home page
    header('Location: ../php/dashboard/guest_dashboard/home.php');
    exit();

    $stmt->close();
    $conn->close();
}
?>
