<?= $this->extend('layouts/main.php') ?>

<?= $this->section('css') ?>
  <link rel = "stylesheet" href = "/CSS/track_order.css">
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>
<body>
    <div class="container w-50 p-1">
        <div class = "row no-pad">
        <h2 class="justify-content-center text-center">Fulfill your delivery</h2>
        
        <div class="accept justify-content-center text-center">
        <h4>Make your way to the customer's pick up location, receive the package, then deliver it to their destination. Here are the order details:</h4>

        <h5>Pick Up Location Details</h5>
        <p>Area: <?= $order['pickup_area']?></p>
        <p>Street Name: <?= $order['pickup_street_name']?></p>
        <p>Estate / Apartment Complex: <?= $order['pickup_estate']?></p>
        <p>House Number: <?= $order['pickup_house_no']?></p>
        <p>Additional Comment: <?= $order['pickup_comment']?></p>

        <h5>Destination Location Details</h5>
        <p>Area: <?= $order['destination_area']?></p>
        <p>Street Name: <?= $order['destination_street_name']?></p>
        <p>Estate / Apartment Complex: <?= $order['destination_estate']?></p>
        <p>House Number: <?= $order['destination_house_no']?></p>
        <p>Additional Comment: <?= $order['destination_comment']?></p>
        <p>Receiver Phone Number: <?= $order['destination_phone_no']?></p>
        </div>
        </div>

        <form method = 'POST' action = "/Deliveryperson/fulfillOrder" enctype="multipart/form-data">
            <h2>Upload confirmation photo</h2>
            <label>Confirmation photo : </label>
            <input type = "file" name = "confirmation_photo">

            <input type = "submit" name = "confirmation_submit" value = "SUBMIT">
        </form>
    </div>
</body>

<?= $this->endSection() ?>

