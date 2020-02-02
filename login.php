<?php
require "header.php";


?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <div class="imgcontainer">

                <img src="img/avatar.png" alt="avatar" class="avatar">
                <h2 class="logintext">Login</h2>
            </div>

        </div>
        <div class="modal-body" style="background-color: black">
            <form action="login_code.php" method="POST" id="logIn">

                <input type="text" name="username" id="loginEmail" required placeholder="Your username" pattern=".{3,}" title="Username must contain 3 or more characters"><br>

                <input type="password" name="password" id="loginPassword" required placeholder="Your password" pattern=".{6,}" title="Six or more characters"><br>
                <button type="submit" id="loginButton"  name="login-submit">login</button>
            </form>
            <?php

            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if (strpos($fullUrl, "login=invalid") == true) {
                echo "<p class='error' style='padding-left: 130px;'>Username or Password invalid</p>";
            }
            ?>
        </div>
    </div>
</div>


</body>