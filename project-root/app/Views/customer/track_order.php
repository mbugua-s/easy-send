<?= $this->extend('layouts/main.php') ?>

<?= $this->section('css') ?>
  <link rel = "stylesheet" href = "/CSS/track_order.css">
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>
<body>
  <div class="container w-75 p-1">
    <div class = "row no-pad">
    <h3 class="heading justify-content-center text-center">TRACK YOUR ORDER</h3>
    
    <?php if($order['status'] == 'pending'): ?>

      <div class="accept justify-content-center text-center">
      <h3>Your order is pending</h3>

      <h4>We're waiting for one of our delivery persons to accept your order. Here are your order's details:</h4>

      <p>Time the order was placed : <?= $order['created_at']?></p>

      <h4 class="heading">Pick-Up location: </h4>
      <p>Area: <?= $order['pickup_area']?></p>
      <p>Street Name: <?= $order['pickup_street_name']?></p>
      <p>Estate / Apartment Complex: <?= $order['pickup_estate']?></p>
      <p>House Number: <?= $order['pickup_house_no']?></p>
      <p>Additional Comment: <?= $order['pickup_comment']?></p>
    

      <h4 class="heading">Destination location :</h4>
      <p>Area: <?= $order['destination_area']?></p>
      <p>Street Name: <?= $order['destination_street_name']?></p>
      <p>Estate / Apartment Complex: <?= $order['destination_estate']?></p>
      <p>House Number: <?= $order['destination_house_no']?></p>
      <p>Additional Comment: <?= $order['destination_comment']?></p>
      <p>Receiver Phone Number: <?= $order['destination_phone_no']?></p>

      </div>

    

    <?php else: ?>
      <div class="accept justify-content-center text-center">
      <h3>Your order has been accepted!</h3>

      <h4>One of our delivery persons has accepted your delivery! Here are their details:</h4>

      <img src = <?= "/profile_photos/".$dp['dp_profile_photo']?>>
      <p>Name: <?= $dp['user_firstname']. " ". $dp['user_lastname']?></p>
    

      <h4>Your order details are :</h4>
      <p>Time the order was placed : <?= $order['created_at']?></p>

      <h4 class="heading">Pick Up Location </h4>
      <p>Area: <?= $order['pickup_area']?></p>
      <p>Street Name: <?= $order['pickup_street_name']?></p>
      <p>Estate / Apartment Complex: <?= $order['pickup_estate']?></p>
      <p>House Number: <?= $order['pickup_house_no']?></p>
      <p>Additional Comment: <?= $order['pickup_comment']?></p>

      <h4 class="heading">Destination Location </h4>
      <p>Area: <?= $order['destination_area']?></p>
      <p>Street Name: <?= $order['destination_street_name']?></p>
      <p>Estate / Apartment Complex: <?= $order['destination_estate']?></p>
      <p>House Number: <?= $order['destination_house_no']?></p>
      <p>Additional Comment: <?= $order['destination_comment']?></p>
      <p>Receiver Phone Number: <?= $order['destination_phone_no']?></p>
     </div>
     <?php endif; ?>

    </div>
  </div>
</body>

<?= $this->endSection() ?>
