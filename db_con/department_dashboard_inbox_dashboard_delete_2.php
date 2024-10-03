<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'conn.php'; // Adjust the path if necessary

// Check if the user is logged in and is of correct user type
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'user') {
    header('Location: ../php/Portal/Admin/login.php');
    exit();
}

// Check if 'device_id' is set in the query string
if (isset($_GET['id'])) {
    // Get the device_id from the query string
    $newsletter_id = intval($_GET['id']);
    
    // Prepare the DELETE statement
    $sql = "DELETE FROM newsletter WHERE id = ?";
    
    // Prepare and execute the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $newsletter_id);
        if ($stmt->execute()) {
            $_SESSION['success2'] = 'Deleted record Succesfully!';
            header('Location: ../php/dashboard/department_dashboard/inbox.php');
        } else {
            $_SESSION['error2'] = 'Error deleting record: ' . $conn->error;
            header('Location: ../php/dashboard/department_dashboard/inbox.php');
        }
        // Close the statement
        $stmt->close();
    } else {
        $_SESSION['error2'] = 'Error preparing the SQL statement: ' . $conn->error;
        header('Location: ../php/dashboard/department_dashboard/inbox.php');
    }
} else {
    // If no device_id is set, redirect back to the dashboard
    header('Location: ../php/dashboard/department_dashboard/inbox.php');
    exit();
}

// Close the database connection
$conn->close();
?>

