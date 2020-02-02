<?php
require "header.php";
?>

<section class="container" style="margin-top:100px">


    <div class="register">
        <form method="POST" id="register" action="signUp_code.php">
            <h1>Registration form</h1><br>

            <label>First Name:</label><br>
            <input type="text" name="first_name" id="name" placeholder="Enter your first name" required><br>
            <label>Last Name:</label><br>
            <input type="text" name="last_name" id="name" placeholder="Enter your last name" required><br>
            <label>Username:</label><br>
            <input type="text" name="username" id="name" placeholder="Enter your username" required pattern=".{3,}" title="Username must contain 3 or more characters"><br>
            <label>Date of birth:</label><br>
            <input type="date" name="DOB" id="DOB" placeholder="Enter your date of birth" required><br>
            <label>Phone number :</label><br>
            <select name="phone_code" id="ph" required>
                <option value=""> </option>
                <option value="083">083</option>
                <option value="087">087</option>
                <option value="094">094</option>
                <option value="097">097</option>
            </select>
            <input type="text" name="number" id="mobileNumber" placeholder="Enter your mobile number" required pattern="\d{7}" title="Mobile number must contain 7 numbers"><br>
            <label>Email:</label><br>
            <input type="text" name="email" id="email" placeholder="Enter your email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="email must be in the following order: characters@characters.domain "><br>
            <label>Password:</label><br>
            <input type="password" name="password" id="name" placeholder="Enter your password" required pattern=".{6,}" title="Six or more characters"><br>
            <label>Confirm your Password:</label><br>
            <input type="password" name="password2" id="name" placeholder="Confirm your password" required pattern=".{6,}" title="Six or more characters"><br>
            <label>Address:</label><br>
            <input type="text" name="address" id="address" placeholder="Enter your address" required pattern=".{10,}" title="Your address has to have at least 10 characters"><br>

            <input type="submit" class="submitbutton">
            
            <?php

            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if (strpos($fullUrl, "password_must_to_be_equal") == true) {
                echo "<p class='error'>password must to be equal</p>";
            } else if (strpos($fullUrl, "this_email_is_already_registred") == true) {
                echo "<p class='error'>this email is already registred</p>";
            } else if (strpos($fullUrl, "this_username_is_already_registred") == true) {
                echo "<p class='error'>this username is already registred</p>";
            }

            ?>

        </form>


</section>


</body>

</html>