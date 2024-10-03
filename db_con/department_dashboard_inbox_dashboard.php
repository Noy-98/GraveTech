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

// Fetch user data from the database
$sql = "SELECT 	id, name, email, subject, message FROM messages";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><p class='text-xs font-weight-bold mb-0'>".htmlspecialchars($row['name'])."</p></td>
                <td><p class='text-xs font-weight-bold mb-0'>".htmlspecialchars($row['email'])."</p></td>
                <td><p class='text-xs font-weight-bold mb-0'>".htmlspecialchars($row['subject'])."</p></td>
                <td><p class='text-xs font-weight-bold mb-0'>".htmlspecialchars($row['message'])."</p></td>
                <td class='align-middle'>
                    <a href='../../../db_con/department_dashboard_inbox_dashboard_delete.php?id=".urlencode($row['id'])."' class='btn bg-gradient-primary btn-primary text-secondary2' onclick='return confirm(\"Are you sure you want to delete this List?\");'>
                        Delete
                    </a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td>No List found</td></tr>";
}
?>
