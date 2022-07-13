<?= $this->extend('layouts/main.php') ?>

<?= $this->section('css') ?>
    <link rel="stylesheet" href="/CSS/place_order.css">
<?= $this->endSection() ?>

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

    <div id="map"></div>
<?= $this->endSection() ?>

<?= $this->section('JS') ?>
    <script>
        var map;
        function initMap()
        {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
            });
        }
    </script>

    <?php $api_src = 'https://maps.googleapis.com/maps/api/js?key='.env('MapsAPIKey').'&callback=initMap';?>
    
    <script src=<?=$api_src?>
        async defer>
    </script>
<?= $this->endSection() ?>
