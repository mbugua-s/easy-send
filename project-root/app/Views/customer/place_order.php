<?= $this->extend('layouts/main.php') ?>

<?= $this->section('main_content') ?>
    <h2>Place Order</h2>

    <form method = 'POST' action = '/customer/placeOrder'>
        
        <fieldset>
            <legend>Pick Up Details</legend>

            <label>Area: </label>
            <input type = "text" name = "order_pickup_area">
            <label>Street Name: </label>
            <input type = "text" name = "order_pickup_street_name">
            <label>Estate / Apartment Complex: </label>
            <input type = "text" name = "order_pickup_estate">
            <label>House No: </label>
            <input type = "text" name = "order_pickup_house">
            <label>Additional Comment: </label>
            <input type = "textarea" name = "order_pickup_comment" value = "None">
        </fieldset>

        <fieldset>
            <legend>Destination Details</legend>

            <label>Area: </label>
            <input type = "text" name = "order_destination_area">
            <label>Street Name: </label>
            <input type = "text" name = "order_destination_street_name">
            <label>Estate / Apartment Complex: </label>
            <input type = "text" name = "order_destination_estate">
            <label>House No: </label>
            <input type = "text" name = "order_destination_house">
            <label>Additional Comment: </label>
            <input type = "textarea" name = "order_destination_comment" value = "None">
            <label>Receiver Phone Number: </label>
            <input type = "number" name = "order_destination_phone" value = "null">
        </fieldset>

        <h4>Payment</h4>
        <p>Payment is made while placing the order. A flat fee of Ksh. 250 is charged per delivery.</p>
        <p>Send Ksh. 250 to MPESA till number "123456", then type the payment code below: </p>
        <label>M-PESA Code: </label>
        <input type = "text" name = "order_mpesa_code">

        <input type = "hidden" name = "order_user_id" value = <?=$_SESSION['user_id']?>>

        <input type = "submit" name = "order_submit" value = "PLACE ORDER">
    </form>

<?= $this->endSection() ?>