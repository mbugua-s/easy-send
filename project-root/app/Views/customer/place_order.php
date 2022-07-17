<?= $this->extend('layouts/main.php') ?>

<?= $this->section('main_content') ?>
    <h2>Place Order</h2>

    <form method = 'POST' action = '/customer/placeOrder'>
        <label>Pickup Location: </label>
        <input type = "text" name = "order_pickup">
        <label>Destination Location: </label>
        <input type = "text" name = "order_destination">

        <h4>Payment</h4>
        <p>Payment is made while placing the order. A flat fee of Ksh. 250 is charged per delivery.</p>
        <p>Send Ksh. 250 to MPESA till number "123456", then type the payment code below: </p>
        <label>M-PESA Code: </label>
        <input type = "text" name = "order_mpesa_code">

        <input type = "hidden" name = "order_user_id" value = <?=$_SESSION['user_id']?>>

        <input type = "submit" name = "order_submit" value = "PLACE ORDER">
    </form>

<?= $this->endSection() ?>