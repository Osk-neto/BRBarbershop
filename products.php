<?php
require "header.php";
require_once('db_connection.php');
?>

<section class="container ">
    <div class="row align-items-center">
        <section id="cart" class="cart-overlay">
            <form action="products_code.php" method="POST">
                <div class="col-lg-6 col-md-6  cart">
                    <div class="container content-section ">
                        <i class="far fa-window-close"></i>
                        <h2 class="section-header">CART</h2>

                        <div class="cart-row">
                            <span class="cart-item cart-header cart-column">ITEM</span>
                            <span class="cart-price cart-header cart-column">PRICE</span>
                            <span class="cart-quantity cart-header cart-column">QUANTITY</span>
                        </div>

                        <div class="items">

                        </div>
                        <div class="input">

                        </div>


                        <div class="cart-total">
                            <strong class="cart-total-title">Total</strong>
                            <span class="cart-total-price">$0</span>
                        </div>


                        <button class="btn btn-primary btn-purchase" type="submit">PURCHASE</button>

                    </div>
                </div>
            </form>
        </section>

        <?php

        $sql = "SELECT id_product,name,price,quantity,img,brand FROM product;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);


        if ($resultCheck > 0) {

            while ($products_data = mysqli_fetch_assoc($result)) {
                if($products_data['quantity'] == 0){
                     echo "<div class='col-md-6 col-lg-3  text-center'>
                     <img class='img-fluid' src='$products_data[img]'>
                     <h3 class='product-title'>$products_data[name]</h3>
                     <h4 class='product-price'>$$products_data[price]</h4>
                     <h4 class='product-quantity' style='color:red;'>OUT OF STOCK</h4>
                     <button class='product-button'>Add to cart</button>
                     </div>"; 
                    
                }else{
                    echo "<div class='col-md-6 col-lg-3  text-center'>
                    <img class='img-fluid' src='$products_data[img]'>
                    <h3 class='product-title'>$products_data[name]</h3>
                    <h4 class='product-price'>$$products_data[price]</h4>
                    <h4 class='product-quantity'>$products_data[quantity] items in Stock</h4>
                    <button class='product-button'>Add to cart</button>
                    </div>";
                }
                
                
            }
        }

        ?>


        </body>

        </html>