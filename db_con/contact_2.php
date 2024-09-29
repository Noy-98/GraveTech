<?php
session_start();
require_once 'conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Form validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $_SESSION['error-message'] = 'All fields are required.';
        header('Location: ../admin_landing_page.php#contact');
        exit();
    }

    // Check if email has already submitted a message
    $check_sql = "SELECT * FROM messages WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    
    if ($check_stmt) {
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();
        
        if ($check_stmt->num_rows > 0) {
            // Email has already submitted a message
            $_SESSION['error-message'] = 'You have already submitted your message.';
            header('Location: ../admin_landing_page.php#contact');
            $check_stmt->close();
            exit();
        }

        $check_stmt->close();
    } else {
        $_SESSION['error-message'] = 'Error: ' . $conn->error;
        header('Location: ../admin_landing_page.php#contact');
        exit();
    }

    // Prepare an SQL statement to insert the new message
    $sql = "INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        
        if ($stmt->execute()) {
            $_SESSION['sent-message'] = 'Your message has been sent. Thank you!';
            header('Location: ../admin_landing_page.php#contact');
        } else {
            $_SESSION['error-message'] = 'Error: ' . $stmt->error;
            header('Location: ../admin_landing_page.php#contact');
        }
        
        $stmt->close();
    } else {
        $_SESSION['error-message'] = 'Error: ' . $conn->error;
        header('Location: ../admin_landing_page.php#contact');
    }

    $conn->close();
} else {
    $_SESSION['error-message'] = 'Invalid request method.';
    header('Location: ../admin_landing_page.php#contact');
}
?>
