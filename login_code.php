<?php

require_once('db_connection.php');



$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT * FROM login_costumer WHERE username = '$username' AND password='$password'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    header("Location: login.php?login=invalid");
    exit();
} else if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $id = $row['id_costumer_login'];
        $username = $row['username'];
        session_start();    
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
    }
    header("Location: index.php?welcone");
} else {

    echo "Invalid email or password";
}
