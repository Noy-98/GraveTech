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
if (isset($_GET['device_id'])) {
    // Get the device_id from the query string
    $device_id = intval($_GET['device_id']);
    
    // Prepare the DELETE statement
    $sql = "DELETE FROM devices_tbl WHERE id = ?";
    
    // Prepare and execute the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $device_id); // 'i' is for integer
        if ($stmt->execute()) {
            // If deletion is successful, redirect back to the dashboard
            header('Location: ../php/dashboard/department_dashboard/home.php');
            exit();
        } else {
            // If there was an error executing the query
            echo "Error deleting record: " . $conn->error;
        }
        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the SQL statement: " . $conn->error;
    }
} else {
    // If no device_id is set, redirect back to the dashboard
    header('Location: ../php/dashboard/department_dashboard/home.php');
    exit();
}

// Close the database connection
$conn->close();
?>

