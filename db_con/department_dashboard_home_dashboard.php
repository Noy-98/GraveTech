<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'conn.php'; // Adjust the path if necessary

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'user') {
    header('Location: ../php/Portal/Admin/login.php');
    exit();
}

// Get the current logged-in user id
$current_user_id = $_SESSION['user_id'];

$sql = "SELECT id, guest_name, guest_email, grave_name, grave_location, device_name, device_ip_address, device_status 
        FROM devices_tbl 
        WHERE udp_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $current_user_id); // 'i' indicates the parameter is an integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".htmlspecialchars($row['guest_name'])."</td>
                <td>".htmlspecialchars($row['guest_email'])."</td>
                <td>".htmlspecialchars($row['grave_name'])."</td>
                <td>".htmlspecialchars($row['grave_location'])."</td>
                <td>".htmlspecialchars($row['device_name'])."</td>
                <td>".htmlspecialchars($row['device_ip_address'])."</td>
                <td>".htmlspecialchars($row['device_status'])."</td>
                <td>
                    <a href='".htmlspecialchars($row['device_ip_address'])."' class='btn bg-gradient-primary btn-primary text-secondary3'>
                        View
                    </a>
                </td>
                <td>
                    <a href='../../../php/dashboard/department_dashboard/edit_devices.php?device_id=".urlencode($row['id'])."' class='btn bg-gradient-primary btn-primary text-secondary4' onclick='return confirm(\"Are you sure you want Edit this Device List?\");'>
                        Edit
                    </a>
                </td>
                <td>
                    <a href='../../../db_con/department_dashboard_home_dashboard_delete.php?device_id=".urlencode($row['id'])."' class='btn bg-gradient-primary btn-primary text-secondary2' onclick='return confirm(\"Are you sure you want Delete this Device List?\");'>
                        Delete
                    </a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td>No Device Found</td></tr>";
}

// Close the statement
$stmt->close();
?>
