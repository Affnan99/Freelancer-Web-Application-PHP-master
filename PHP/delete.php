<?php
include 'conn.php'; // Or use correct relative path like 'PHP/conn.php'

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM registration WHERE id = $id";

    if (mysqli_query($con, $sql)) {
        header("Location: admin.php");
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    echo "Invalid request";
}
?>
