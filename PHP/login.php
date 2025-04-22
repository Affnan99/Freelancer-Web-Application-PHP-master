<?php
/*
session_start();

include 'conn.php';

$name = $_POST['userName'];
$pass = $_POST['password'];

$Sql = "SELECT * FROM registration WHERE userName='$name' AND password='$pass'";

$result = mysqli_query($con, $Sql);

$count = mysqli_num_rows($result);

if ($count == 1) {
    $role = mysqli_fetch_array($result);

    if ($role['access']== '1') {
        if ($role['role'] == "1") {
            echo "admin";
            exit();
        } elseif ($role['role'] == "0") {
            echo "user";
            $_SESSION["name"] = $name;
            exit();
        }
    } else {
        echo "Admin disabled your account";
    }
} else {
    echo "Invalid Username or Password !";
}
*/

session_start();
include 'conn.php';

// Secure input from form
$name = mysqli_real_escape_string($con, $_POST['userName']);
$pass = mysqli_real_escape_string($con, $_POST['password']);

// Query to check user
$Sql = "SELECT * FROM registration WHERE userName='$name' AND password='$pass'";
$result = mysqli_query($con, $Sql);

// Check if a matching user exists
if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    // Check if account is enabled
    if (isset($user['access']) && $user['access'] == '1') {

        // Check user role
        if (isset($user['role']) && $user['role'] == '1') {
            echo "admin";
            exit();
        } elseif (isset($user['role']) && $user['role'] == '0') {
            $_SESSION['name'] = $name;
            echo "user";
            exit();
        } else {
            echo "Invalid user role!";
        }

    } else {
        echo "Admin disabled your account";
    }

} else {
    echo "Invalid Username or Password!";
}

?>
