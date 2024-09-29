<?php
session_start();
require_once 'conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Form validation
    if (empty($email)) {
        $_SESSION['error_message'] = 'Fields are required.';
        header('Location: ../php/Portal/Guest/login.php#footer');
        exit();
    }

    // Check if the email already exists
    $check_sql = "SELECT * FROM newsletter WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    
    if ($check_stmt) {
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();
        
        if ($check_stmt->num_rows > 0) {
            // Email already exists
            $_SESSION['error_message'] = 'This email is already subscribed.';
            header('Location: ../php/Portal/Guest/login.php#footer');
        } else {
            // Prepare an SQL statement to insert the new email
            $insert_sql = "INSERT INTO newsletter (email) VALUES (?)";
            $insert_stmt = $conn->prepare($insert_sql);
            
            if ($insert_stmt) {
                $insert_stmt->bind_param("s", $email);
                
                if ($insert_stmt->execute()) {
                    $_SESSION['success_message'] = 'Your email has been sent. Thank you!';
                    header('Location: ../php/Portal/Guest/login.php#footer');
                } else {
                    $_SESSION['error_message'] = 'Error: ' . $insert_stmt->error;
                    header('Location: ../php/Portal/Guest/login.php#footer');
                }
                
                $insert_stmt->close();
            } else {
                $_SESSION['error_message'] = 'Error: ' . $conn->error;
                header('Location: ../php/Portal/Guest/login.php#footer');
            }
        }
        
        $check_stmt->close();
    } else {
        $_SESSION['error_message'] = 'Error: ' . $conn->error;
        header('Location: ../php/Portal/Guest/login.php#footer');
    }

    $conn->close();
} else {
    $_SESSION['error_message'] = 'Invalid request method.';
    header('Location: ../php/Portal/Guest/login.php#footer');
}
?>
