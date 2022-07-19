<?= $this->extend('layouts/main.php') ?>

<?php $counter = 1; ?>

<?= $this->section('css') ?>
  <link rel = "stylesheet" href = "/CSS/track_order.css">
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>
<body>
    <h2>Order History</h2>
    <?php if(isset($order)): ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date of delivery</th>
                    <th scope="col">Pick Up Area</th>
                    <th scope="col">Pick Up Estate / Apartment</th>
                    <th scope="col">Destination Area</th>
                    <th scope="col">Destination Estate / Apartment</th>
                    <th scope="col">Cost (Ksh)</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($order as $order_key => $order_properties) :?>
                    <tr>
                        <form method = 'POST' action = '/Deliveryperson/acceptOrder'>
                            <td><?= $counter ?></td>
                            <?php foreach($order_properties as $order_properties_key => $order_properties_val) :?>
                                <td><?= $order_properties_val ?></td>
                                <?php $counter++ ?>
                            <?php endforeach; ?>
                            <td>250.00</td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <h3>You don't have any orders in your history</h3>
    <?php endif; ?>
</body>

<?= $this->endSection() ?>
