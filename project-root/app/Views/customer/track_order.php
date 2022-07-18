<?= $this->extend('layouts/main.php') ?>

<?= $this->section('css') ?>
  <link rel = "stylesheet" href = "/CSS/track_order.css">
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>
<body>
  <div class="container w-50 p-1">
    <div class = "row no-pad">
    <h2 class="justify-content-center text-center">Track your order</h2>
    
    <?php if($order['status'] == 'pending'): ?>
      <h2>Your order is pending</h2>
      <h4>We're waiting for one of our delivery persons to accept your order. Here are your order's details:</h4>

    <?php else: ?>
      <div class="accept justify-content-center text-center">
      <h2>Your order has been accepted!</h2>
      <h4>One of our delivery persons has accepted your delivery! Here are their details:</h4>

      <img src = <?= "/profile_photos/".$dp['dp_profile_photo']?>>
      <p>Name: <?= $dp['user_firstname']. " ". $dp['user_lastname']?></p>
    <?php endif; ?>

      <h4>Your order details are :</h4>
      <p>Time the order was placed : <?= $order['created_at']?></p>

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
  </div>
</body>

<?= $this->endSection() ?>
