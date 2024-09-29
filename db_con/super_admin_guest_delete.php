<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'conn.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: ../php/Portal/Admin/login.php');
    exit();
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Get the user ID based on the email
    $stmt = $conn->prepare("SELECT id FROM guesttbl WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    if ($user_id) {
        // Delete related rows in password_reset_requests
        $stmt = $conn->prepare("DELETE FROM password_reset_requests WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();

        // Now delete the guest
        $stmt = $conn->prepare("DELETE FROM guesttbl WHERE id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Guest deleted successfully.";
        } else {
            $_SESSION['error'] = "Error deleting guest.";
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Guest not found.";
    }
} else {
    $_SESSION['error'] = "Invalid request.";
}

$conn->close();

header('Location: ../php/dashboard/super_admin_dashboard/home.php');
exit();
?>
