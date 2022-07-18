<?= $this->extend('layouts/main.php') ?>

<?= $this->section('css') ?>
  <link rel = "stylesheet" href = "/CSS/place_order.css">
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>
<body>
<div class="container w-25 p-2">
    <div class = "row no-pad">
    <h2 class="justify-content-center text-center">Place Order</h2>
    <form method = 'POST' action = '/customer/placeOrder'>
        
        <input type = "text" placeholder="Pickup Location" required class="form-control my-3 p-2" name = "order_pickup">

        <input type = "text" placeholder="Destination Location" required class="form-control my-3 p-2" name = "order_destination">

        <input type = "hidden" name = "order_user_id" value = <?=$_SESSION['user_id']?>>

        <button type = "submit" name = "order_submit" class="btn1 mt-2 mb-3" value = "PLACE ORDER">Place Order</button>

    </form>
    </div>
</div>
</body>

<?= $this->endSection() ?>