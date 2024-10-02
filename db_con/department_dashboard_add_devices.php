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
        header('Location: ../php/dashboard/department_dashboard/add_devices.php');
        exit();
    }

    $check_sql = "SELECT * FROM devices_tbl WHERE device_name = ?";
    $check_stmt = $conn->prepare($check_sql);

    if ($check_stmt) {
        $check_stmt->bind_param("s", $device_name);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
    
            $_SESSION['error'] = 'The Device is Already Existed!.';
            header('Location: ../php/dashboard/department_dashboard/add_devices.php');
            $check_stmt->close();
            exit();
        }

        $check_stmt->close();
    } else {
        $_SESSION['error'] = 'Error: ' . $conn->error;
        header('Location: ../php/dashboard/department_dashboard/add_devices.php');
        exit();
    }

    $sql = "INSERT INTO devices_tbl (udp_id, guest_name, guest_email, grave_name, grave_location, device_name, device_ip_address, device_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("isssssss", $user_id, $guest_name, $guest_email, $grave_name, $grave_location, $device_name, $device_ip_address, $device_status);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Device Added Succesfully!';
            header('Location: ../php/dashboard/department_dashboard/add_devices.php');
        } else {
            $_SESSION['error'] = 'Error: ' . $stmt->error;
            header('Location: ../php/dashboard/department_dashboard/add_devices.php');
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = 'Error: ' . $conn->error;
        header('Location: ../php/dashboard/department_dashboard/add_devices.php');
    }

}

$conn->close();

header('Location: ../php/dashboard/department_dashboard/add_devices.php');
exit();
?>
