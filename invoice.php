<?php
session_start();
$id = $_SESSION['id'];
require('fpdf17\fpdf.php');
require_once('db_connection.php');

$date = date('d-m-Y');


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P', 'mm', 'A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial', 'B', 14);

//Cell(width , height , text , border , end line , [align] )
$pdf->Image('img\br.png', 5, 5, 50, 50, 'PNG');
$pdf->Cell(45, 5, '', 0, 0);
$pdf->Cell(85, 5, 'BR Barber Shop', 0, 0);
$pdf->Cell(59, 5, 'INVOICE', 0, 1); //end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(45, 5, '', 0, 0);
$pdf->Cell(85, 5, 'Rua antonio Barreto', 0, 0);
$pdf->Cell(25, 5, 'Date', 0, 0);
$pdf->Cell(34, 5, $date, 0, 1); //end of line

$pdf->Cell(45, 5, '', 0, 0);
$pdf->Cell(85, 5, 'Belem, Brazil,66060-020', 0, 0);
$pdf->Cell(25, 5, 'Customer ID', 0, 0);
$pdf->Cell(34, 5, $id, 0, 1); //end of line

$pdf->Cell(45, 5, '', 0, 0);
$pdf->Cell(85, 5, 'Phone +55(91)98082-1227', 0, 0);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(25, 5, 'Bank Details', 0, 0);
$pdf->Cell(34, 5, '', 0, 1); //end of line

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(59, 5, 'IBAN - IEXXAIBKXXXXXXXXXX', 0, 1); //end of line
$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(59, 5, 'BIC - AIBKIEXX', 0, 1); //end of line



//make a dummy empty cell as a vertical spacer
$pdf->Cell(189, 10, '', 0, 1); //end of line
$pdf->Cell(189, 10, '', 0, 1); //end of line
$pdf->Cell(189, 10, '', 0, 1); //end of line


$sql = "SELECT first_name,last_name,address,phone_number FROM costumer WHERE id_costumer = $id;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        
        
        //billing address
        $pdf->Cell(100, 5, 'Delivery to', 0, 1); //end of line

        //add dummy cell at beginning of each line for indentation
        $pdf->Cell(10, 5, '', 0, 0);
        $pdf->Cell(90, 5, $row['first_name']." ".$row['last_name'], 0, 1);



        $pdf->Cell(10, 5, '', 0, 0);
        $pdf->Cell(90, 5, $row['address'], 0, 1);

        $pdf->Cell(10, 5, '', 0, 0);
        $pdf->Cell(90, 5, $row['phone_number'], 0, 1);

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189, 10, '', 0, 1); //end of line
    }
}

$sql_idOrder  = "SELECT id_order FROM `order`order by date desc limit 1 ; ";
$result_idOrder = mysqli_query($conn, $sql_idOrder);
$idOrder_fetch = mysqli_fetch_assoc($result_idOrder);
$idOrder = $idOrder_fetch["id_order"];

$sql_price = "SELECT price FROM `order` Where id_order = $idOrder";
$result_price = mysqli_query($conn,$sql_price);
$price_fetch = mysqli_fetch_assoc($result_price);

$sql_order = "SELECT product_id,quantity FROM product_sold Where order_id = $idOrder";
$result_order = mysqli_query($conn,$sql_order);


//invoice contents
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(155, 5, 'Description', 1, 0);

$pdf->Cell(34, 5, 'Amount', 1, 1); //end of line

$pdf->SetFont('Arial', '', 12);

//Numbers are right-aligned so we give 'R' after new line parameter

while($order_fetch = mysqli_fetch_assoc($result_order)){

    $sql_product_name = "SELECT name FROM product WHERE id_product = $order_fetch[product_id]";
    $result_product_name = mysqli_query($conn,$sql_product_name);
    $product_name_fetch = mysqli_fetch_assoc($result_product_name);
    $product_name = $product_name_fetch["name"];

    $sql_product_price = "SELECT price FROM product WHERE id_product = $order_fetch[product_id]";
    $result_product_price = mysqli_query($conn,$sql_product_price);
    $product_price_fetch = mysqli_fetch_assoc($result_product_price);
    $product_price = $product_price_fetch["price"];

    $pdf->Cell(148, 5, $product_name, 1, 0);
    $pdf->Cell(7, 5, $order_fetch['quantity'], 1, 0,'C');
    $pdf->Cell(34, 5, $order_fetch['quantity']*$product_price , 1, 1, 'R'); //end of line
}


//summary
$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Subtotal', 0, 0);
$pdf->Cell(4, 5, '$', 1, 0);
$pdf->Cell(30, 5, $price_fetch['price'], 1, 1, 'R'); //end of line



$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Frete', 0, 0);
$pdf->Cell(4, 5, '$', 1, 0);
$pdf->Cell(30, 5, '7.5', 1, 1, 'R'); //end of line

$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Total Due', 0, 0);
$pdf->Cell(4, 5, '$', 1, 0);
$pdf->Cell(30, 5, $price_fetch['price']+7.5, 1, 1, 'R'); //end of line


$pdf->Output();
