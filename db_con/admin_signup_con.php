<?php
session_start();
require_once 'conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $department_name = $_POST['department_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Form validation
    if (empty($first_name) || empty($last_name) || empty($department_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: ../php/Portal/Admin/signup.php');
        exit();
    }

    if (strlen($password) < 6) {
        $_SESSION['error'] = 'Password must be at least 6 characters long.';
        header('Location: ../php/Portal/Admin/signup.php');
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: ../php/Portal/Admin/signup.php');
        exit();
    }

    // Check if email already exists
    $check_sql = "SELECT * FROM userdepartmenttbl WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);

    if ($check_stmt) {
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            // Email already exists
            $_SESSION['error'] = 'This email is already registered.';
            header('Location: ../php/Portal/Admin/signup.php');
            $check_stmt->close();
            exit();
        }

        $check_stmt->close();
    } else {
        $_SESSION['error'] = 'Error: ' . $conn->error;
        header('Location: ../php/Portal/Admin/signup.php');
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an SQL statement to insert the new admin
    $sql = "INSERT INTO userdepartmenttbl (first_name, last_name, department_name, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssss", $first_name, $last_name, $department_name, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Signup successful!';
            header('Location: ../php/Portal/Admin/signup.php');
        } else {
            $_SESSION['error'] = 'Error: ' . $stmt->error;
            header('Location: ../php/Portal/Admin/signup.php');
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = 'Error: ' . $conn->error;
        header('Location: ../php/Portal/Admin/signup.php');
    }

    $conn->close();
} else {
    $_SESSION['error'] = 'Invalid request method.';
    header('Location: ../php/Portal/Admin/signup.php');
}
?>
