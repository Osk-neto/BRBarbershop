<?php
session_start();
$id = $_SESSION['id'];
?>
<?php

require_once('db_connection.php');

$input_titles = $_POST['title'];
$input_quantities = $_POST['quantity'];
$total_price = $_POST['total_price'] + 7.5;






$sql = "INSERT INTO `order` (price,costumer_id_number)
        VALUES ($total_price,$id);";
$sql_idOrder  = "SELECT id_order FROM `order`order by date desc limit 1 ; ";



for ($i = 0; $i < count($input_titles); $i++) {
    $sql_select_quantity = "SELECT quantity FROM product WHERE name = '$input_titles[$i]';";
    $result_select_quantity = mysqli_query($conn, $sql_select_quantity);
    $select_quantity_fetch = mysqli_fetch_assoc($result_select_quantity);
    $select_quantity = $select_quantity_fetch["quantity"];
    $chekc = $select_quantity - $input_quantities[$i];
    if ( $chekc < 0) {

        echo "<script>alert('One of the products you are trying to buy is not available in the quantity that you wish, please check the quantity stock below the product')
                window.location='products.php'
                </script>";




        exit();
    }
}




$result = mysqli_query($conn, $sql);

if ($result) {

    for ($i = 0; $i < count($input_titles); $i++) {


        $sql_idProduct = "SELECT id_product FROM product WHERE name = '$input_titles[$i]';";
        $result_idOrder = mysqli_query($conn, $sql_idOrder);
        $result_idProduct = mysqli_query($conn, $sql_idProduct);
        $idOrder_fetch = mysqli_fetch_assoc($result_idOrder);
        $idProduct_fetch = mysqli_fetch_assoc($result_idProduct);
        $idOrder = $idOrder_fetch["id_order"];
        $idProduct = $idProduct_fetch["id_product"];



        $sql2 = "INSERT INTO product_sold (order_id,product_id,quantity)
                    VALUES ($idOrder,$idProduct,$input_quantities[$i]);";
        $sql3 = "UPDATE product SET quantity = quantity - $input_quantities[$i] where name = '$input_titles[$i]';";
        $result2 = mysqli_query($conn, $sql2);
        $result3 = mysqli_query($conn, $sql3);
    }

    
    echo "<script type='text/javascript'>
         window.open('invoice.php', '_blank');
         location.href = 'products.php';;
      </script>";
    
   
} else {
    echo "Error : " . mysqli_error($conn);
}








?>