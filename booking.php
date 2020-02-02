<?php
require "header.php";


?>

<section class="container " style="margin-top:100px">
    <div class="register">
        <form action="booking_code.php " method="POST">

            <legend class="bookingLegend">Booking</legend>


            <label>Date: </label><input type="date" name="date" id="bookingDate" min="2020-01-01" required><br>
            <label>Time: </label>
            <select name="time_table" required>
                <option value=""> </option>
                <option value="09:00">09:00</option>
                <option value="09:30">09:30</option>
                <option value="10:00">10:00</option>
                <option value="10:30">10:30</option>
                <option value="11:00">11:00</option>
                <option value="11:30">11:30</option>
                <option value="12:00">12:00</option>
                <option value="12:30">12:30</option>
                <option value="13:00">13:00</option>
                <option value="13:30">13:30</option>
                <option value="14:00">14:00</option>
                <option value="14:30">14:30</option>
                <option value="15:00">15:00</option>
                <option value="15:30">15:30</option>
                <option value="16:00">16:00</option>
                <option value="16:30">16:30</option>
                <option value="17:00">17:00</option>
                <option value="17:30">17:30</option>
                <option value="18:00">18:00</option>
                <option value="18:30">18:30</option>
                <option value="19:00">19:00</option>
                <option value="19:30">19:30</option>
                <option value="20:00">20:00</option>

            </select><br>
            <label>Barber: </label>
            <select name="barber" required>
                <option value=""> </option>
                <option value="Nazareno">Nazareno</option>
                <option value="Levi">Levi</option>
                <option value="Edmilson">Edmilson</option>
                <option value="Leandro">Leandro</option>
            </select><br>
            <label>Number of service</label>
            <select name="numberOfService" required>
                <option value=""> </option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select><br>
            <input type="submit" value="Sign Up" class="submitbutton">

        </form>

        <?php

        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (strpos($fullUrl, "change_the_date") == true) {
            echo "<p class='error' style='padding-left: 150px;'>Please select a valid date!</p>"
            ;
        }
        if (strpos($fullUrl, "that_date_and_hour_is_not_available") == true) {
            echo "<p class='error' style='padding-left: 80px;'>That barber is busy this hour, please try again!</p>"
            ;
        }


        ?>
    </div>
</section>
</body>

</html>