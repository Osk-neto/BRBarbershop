<?php
    session_start();
    $id = $_SESSION['id'];   
?>
<?php

require_once('db_connection.php');

$date = $_POST['date'];
$time_table =$_POST['time_table'];
$barber_name = $_POST['barber'];
$numberOfService = $_POST['numberOfService'];
$price = '';
if($numberOfService == 1){
    $price = 25.00;
}else if($numberOfService == 2){
    $price = 50.00;
}
$today = date("Y-m-d");

if($today > $date){

    //echo $date;
    header("Location: booking.php?booking=change_the_date");
    exit();
}

$sql = "INSERT INTO servicesbooked (costumer_id,barber_id,date,hour,price)
        VALUES ('$id',(SELECT id_barber FROM barbers WHERE first_name = '$barber_name'),
                '$date','$time_table','$price')";

$sql2 = "SELECT * FROM servicesbooked WHERE date = '$date' and hour ='$time_table'";
$sql3 = "SELECT id_barber FROM barbers WHERE first_name = '$barber_name'";

$result2 = mysqli_query($conn,$sql2);
$result3 = mysqli_query($conn,$sql3);

if(mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0){
    
    
    
    header("Location: booking.php?booking=that_date_and_hour_is_not_available");
    exit();
    

}else{

$result = mysqli_query($conn,$sql); 
if($result){
    
    
    session_start();    
    $_SESSION['date_invoice'] = $date;
    $_SESSION['hour_invoice'] = $time_table;
    $_SESSION['barber_name_invoice'] =$barber_name;
    $_SESSION['numberOfService_invoice'] = $numberOfService;
    echo "<script>alert('Your service has been successfully booked, we are waiting for you.')
    window.open('invoice_booking.php', '_blank');
    window.location='index.php'
    </script>";  
    
   
}else{
    echo "Error : ".mysqli_error($conn).$barber_name;
}
}

?>