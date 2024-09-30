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
$sql = "SELECT 	id, first_name, last_name, department_name, profile_pictures, email, user_type FROM userdepartmenttbl";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>
                    <div class='d-flex px-2 py-1'>
                        <div>
                            <img src='".htmlspecialchars($row['profile_pictures'])."' class='avatar avatar-sm me-3 border-radius-lg' alt='user1'>
                        </div>
                        <div class='d-flex flex-column justify-content-center'>
                            <h6 class='mb-0 text-sm'>".htmlspecialchars($row['first_name'])." ".htmlspecialchars($row['last_name'])."</h6>
                            <p class='text-xs text-secondary mb-0'>".htmlspecialchars($row['email'])."</p>
                        </div>
                    </div>
                </td>
                <td><p class='text-xs font-weight-bold mb-0'>".htmlspecialchars($row['department_name'])."</p></td>
                <td><p class='text-xs font-weight-bold mb-0'>".htmlspecialchars($row['user_type'])."</p></td>
                <td><p class='text-xs font-weight-bold mb-0'>".htmlspecialchars($row['id'])."</p></td>
                <td class='align-middle'>
                    <a href='../../../db_con/super_admin_department_delete.php?email=".urlencode($row['email'])."' class='btn bg-gradient-primary btn-primary text-secondary2' onclick='return confirm(\"Are you sure you want to delete this guest?\");'>
                        Delete
                    </a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td>No User Department found</td></tr>";
}
$conn->close();
?>
