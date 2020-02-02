<?php
require_once('db_connection.php');


$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$address = $_POST['address'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$phone_code = $_POST['phone_code'];
$number = $_POST['number'];
$phone_number = "$phone_code($number)";
$DOB = $_POST['DOB'];


$sql = "INSERT INTO costumer (first_name,last_name,date_of_birth,email,phone_number,address) 
                VALUES ('$first_name','$last_name','$DOB','$email','$phone_number','$address');";
$sql2 = "INSERT INTO login_costumer (id_costumer_login,username,password)
            VALUES ((SELECT id_costumer FROM costumer WHERE email = '$email'),'$username','$password');";
$sql3  = "SELECT * FROM costumer WHERE email = '$email'";
$sql4 =  "SELECT * FROM login_costumer WHERE username = '$username'";

$result3 = mysqli_query($conn,$sql3);
$result4 = mysqli_query($conn,$sql4);
if($password != $password2){
    header("Location: signUp.php?booking=password_must_to_be_equal");
    exit();
    
}else if(mysqli_num_rows($result3)>0){
    header("Location: signUp.php?booking=this_email_is_already_registred");
    exit();

}
else if(mysqli_num_rows($result4)>0){
    header("Location: signUp.php?booking=this_username_is_already_registred");
    exit();

}
$result = mysqli_query($conn,$sql);
$result2 = mysqli_query($conn,$sql2);
if($result && $result2){
    header("Location: index.php?success");
}
else{
    echo "Error : ".mysqli_error($conn);
}

?>