<?= $this->extend('layouts/main.php') ?>

<?= $this->section('main_content') ?>
    <h2>Place Order</h2>
    <form method = 'POST' action = '/customer/placeOrder'>
        <label>Pickup Location: </label>
        <input type = "text" name = "order_pickup">
        <label>Destination Location: </label>
        <input type = "text" name = "order_destination">

        <input type = "hidden" name = "order_user_id" value = <?=$_SESSION['user_id']?>>

        <input type = "submit" name = "order_submit" value = "PLACE ORDER">
    </form>

<?= $this->endSection() ?>