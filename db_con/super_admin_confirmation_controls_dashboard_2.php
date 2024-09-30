<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'conn.php'; // Adjust the path if necessary

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: ../php/Portal/Admin/login.php');
    exit();
}

// Fetch user data from the database
$sql = "SELECT user_id, email, status, request_date FROM department_password_reset_requests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".htmlspecialchars($row['user_id'])."</td>
                <td>".htmlspecialchars($row['email'])."</td>
                <td>".htmlspecialchars($row['status'])."</td>
                <td>".htmlspecialchars($row['request_date'])."</td>
                <td>
                    <a href='../../../db_con/admin_controls_approved_2.php?user_id=".urlencode($row['user_id'])."' class='btn bg-gradient-primary btn-primary text-secondary3' onclick='return confirm(\"Are you sure you want to Approve this Department user request?\");'>
                        Approve
                    </a>
                </td>
                <td>
                    <a href='../../../db_con/admin_controls_decline_2.php?user_id=".urlencode($row['user_id']). "' class='btn bg-gradient-primary btn-primary text-secondary4' onclick='return confirm(\"Are you sure you want Decline this Department user request?\");'>
                        Decline
                    </a>
                </td>
                <td>
                    <a href='../../../db_con/admin_delete_2.php?user_id=". urlencode($row['user_id']) . "' class='btn bg-gradient-primary btn-primary text-secondary2' onclick='return confirm(\"Are you sure you want Delete this Department user request?\");'>
                        Delete
                    </a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td>No Request Found</td></tr>";
}
$conn->close();
?>
