<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'user') {
    header('Location: ../php/Portal/Admin/login.php');
    exit();
}
require_once 'conn.php'; // Adjust the path if necessary

// Handle form submission to update profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $guest_name = $_POST['guest_name'];
    $guest_email = $_POST['guest_email'];
    $grave_name = $_POST['grave_name'];
    $grave_location = $_POST['grave_location'];
    $device_name = $_POST['device_name'];
    $device_ip_address = $_POST['device_ip_address'];
    $device_status = $_POST['device_status'];

    if (empty($guest_name) || empty($guest_email) || empty($grave_name) || empty($grave_location) || empty($device_name) || empty($device_ip_address) || empty($device_status)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: ../php/dashboard/department_dashboard/edit_devices.php');
        exit();
    }

    // Update user data in the database
    $sql_update = "UPDATE devices_tbl SET guest_name = ?, guest_email = ?, grave_name = ?, grave_location = ?, device_name = ?, device_ip_address = ?, device_status = ? WHERE udp_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssssssi", $guest_name, $guest_email, $grave_name, $grave_location , $device_name, $device_ip_address, $device_status, $user_id);
    if ($stmt_update->execute()) {
        $_SESSION['success'] = "Device Info updated successfully.";
        header('Location: ../php/dashboard/department_dashboard/edit_devices.php');
    } else {
        $_SESSION['error'] = "Error updating device info.";
        header('Location: ../php/dashboard/department_dashboard/edit_devices.php');
    }
    $stmt_update->close();
}

$conn->close();

header('Location: ../php/dashboard/department_dashboard/edit_devices.php');
exit();
?>
