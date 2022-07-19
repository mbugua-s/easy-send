<?= $this->extend('layouts/main.php') ?>

<?= $this->section('css') ?>
  <link rel = "stylesheet" href = "/CSS/place_order.css">
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>

<body>
<div class="container w-75">
    <h2 class="heading justify-content-center text-center">Place Order</h2>

    <form method = 'POST' action = '/customer/placeOrder'>
    <div class = "row gx-3">

        <div class="col-6">
        <fieldset>
            <div></div>
            <legend class="justify-content-center text-center"><i class="bi bi-arrow-up-right-circle-fill"></i>Pick Up Details</legend>
            <div></div>
            <div></div>

            <input type = "text" placeholder="Area" required class="form-control my-3 p-2" name = "order_pickup_area">
            
            <input type = "text" placeholder="Street Name" required class="form-control my-3 p-2" name = "order_pickup_street_name">

            <input type = "text" placeholder="Estate / Apartment Complex" required class="form-control my-3 p-2" name = "order_pickup_estate">
            
            <input type = "text" placeholder="House No " required class="form-control my-3 p-2" name = "order_pickup_house">
            
            <input type = "textarea" placeholder="Additional Comment" required class="form-control my-3 p-2" name = "order_pickup_comment" value = "None">
        </fieldset>
        </div>
    

        
        <div class="col-6">
        <fieldset>
            <div></div>
            <legend class="justify-content-center text-center"><i class="bi bi-arrow-down-right-circle-fill"></i>Destination Details</legend>
            <div></div>
            <div></div>

            <input type = "text" placeholder="Area" required class="form-control my-3 p-2" name = "order_destination_area">
            
            <input type = "text" placeholder="Street Name" required class="form-control my-3 p-2" name = "order_destination_street_name">
            
            <input type = "text" placeholder="Estate / Apartment Complex" required class="form-control my-3 p-2" name = "order_destination_estate">
            
            <input type = "text" placeholder="House No" required class="form-control my-3 p-2" name = "order_destination_house">
            
            <input type = "textarea" placeholder="Additional Comment" required class="form-control my-3 p-2" name = "order_destination_comment" value = "None">
            
            <input type = "number" placeholder="Receiver Phone Number" required class="form-control my-3 p-2" name = "order_destination_phone" value = "null">
        </fieldset>
        </div>


    <div class="w-100 justify-content-center text-center">
        <div class="payment justify-content-center text-center">
            <h4 class="offset-5">Payment</h4>
            <p>Payment is made while placing the order. A flat fee of Ksh. 250 is charged per delivery.</p>
            <p>Send Ksh. 250 to MPESA till number "123456", then type the payment code below: </p>
                <label>M-PESA Code: </label>
                <input type = "text" required class="my-3 p-2" name = "order_mpesa_code">

                <input type = "hidden" name = "order_user_id" value = <?=$_SESSION['user_id']?>>

                    <div class="offset-5 col-3">
                        <button type = "submit" name = "order_submit" class="btn1 mt-2 mb-3" value = "PLACE ORDER">Place Order</button>
                    </div>

        </div>
    </div>

    </div>
    </form>

    </div>

        

</body>

<?= $this->endSection() ?>