<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'user') {
    header('Location: ../php/Portal/Admin/login.php');
    exit();
}

require_once 'conn.php'; // Adjust the path if necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $guest_email = $_POST['guest_email'];
    $device_name = $_POST['device_name'];
    $concern = $_POST['concern'];

    // Directories for storing files
    $upload_dir_images = '../uploads/department_pictures/image_capture/';
    $upload_dir_videos = '../uploads/department_pictures/video_capture/';

    // Allowed file types
    $allowed_image_types = array('jpg', 'jpeg', 'png', 'gif');
    $allowed_video_types = array('mp4', 'avi', 'mov', 'wmv');


    // Handle image capture upload
    if (isset($_FILES['image_capture']) && $_FILES['image_capture']['error'] == 0) {
        $image_capture_name = basename($_FILES['image_capture']['name']);
        $image_capture_ext = strtolower(pathinfo($image_capture_name, PATHINFO_EXTENSION));
        $image_capture_path = $upload_dir_images . $user_id . '_image.' . $image_capture_ext;

        // Check if file type is allowed
        if (!in_array($image_capture_ext, $allowed_image_types)) {
            $_SESSION['error'] = 'Only JPG, JPEG, PNG, and GIF files are allowed for image capture.';
            header('Location: ../php/dashboard/department_dashboard/collections.php');
            exit();
        }

        // Move the uploaded file
        if (!move_uploaded_file($_FILES['image_capture']['tmp_name'], $image_capture_path)) {
            $_SESSION['error'] = 'Failed to upload image capture.';
            header('Location: ../php/dashboard/department_dashboard/collections.php');
            exit();
        }
    }

    // Handle video capture upload
    if (isset($_FILES['video_capture']) && $_FILES['video_capture']['error'] == 0) {
        $video_capture_name = basename($_FILES['video_capture']['name']);
        $video_capture_ext = strtolower(pathinfo($video_capture_name, PATHINFO_EXTENSION));
        $video_capture_path = $upload_dir_videos . $user_id . '_video.' . $video_capture_ext;

        // Check if file type is allowed
        if (!in_array($video_capture_ext, $allowed_video_types)) {
            $_SESSION['error'] = 'Only MP4, AVI, MOV, and WMV files are allowed for video capture.';
            header('Location: ../php/dashboard/department_dashboard/collections.php');
            exit();
        }

        // Move the uploaded file
        if (!move_uploaded_file($_FILES['video_capture']['tmp_name'], $video_capture_path)) {
            $_SESSION['error'] = 'Failed to upload video capture.';
            header('Location: ../php/dashboard/department_dashboard/collections.php');
            exit();
        }
    }

    // Verify guest email exists in guesttbl
    $guest_query = "SELECT email FROM guesttbl WHERE email = ?";
    $stmt = $conn->prepare($guest_query);
    $stmt->bind_param('s', $guest_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $_SESSION['error'] = 'Guest email does not exist.';
        header('Location: ../php/dashboard/department_dashboard/collections.php');
        exit();
    }

    // Get department email for the current user from userdepartmenttbl
    $department_query = "SELECT email FROM userdepartmenttbl WHERE id = ?";
    $stmt = $conn->prepare($department_query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $department_result = $stmt->get_result();
    $department_row = $department_result->fetch_assoc();
    $department_email = $department_row['email'];

    // Insert data into collection_tbl
    $insert_query = "INSERT INTO collection_tbl (guest_email, department_email, device_name, concern, image_capture, video_capture) 
                     VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param('ssssss', $guest_email, $department_email, $device_name, $concern, $image_capture_path, $video_capture_path);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Collection added successfully.';
        header('Location: ../php/dashboard/department_dashboard/collections.php');
        exit();
    } else {
        $_SESSION['error'] = 'Failed to add collection.';
        header('Location: ../php/dashboard/department_dashboard/collections.php');
        exit();
    }
}
?>
