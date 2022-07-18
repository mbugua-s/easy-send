<?= $this->extend('Layouts/main.php'); ?>

<?php $counter = 1; ?>

<?= $this->section('css') ?>
    <link ref = "stylesheet" href = "/CSS/available_orders.php">
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>
<?php if(isset($available_orders)): ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pick Up Area</th>
                <th scope="col">Pick Up Street Name</th>
                <th scope="col">Destination Area</th>
                <th scope="col">Destination Street Name</th>
                <th scope="col">Time Requested</th>
                <th scope="col">Accept Order</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($available_orders as $order_key => $order_properties) :?>
                <tr>
                    <form method = 'POST' action = '/Deliveryperson/acceptOrder'>
                        <td><?= $counter ?></td>
                        <?php foreach($order_properties as $order_properties_key => $order_properties_val) :?>
                            <?php if($order_properties_key == 'order_id') :?>
                                <input type = "hidden" name = "acceptorder_order_id" value = <?= $order_properties_val ?>>
                            <?php elseif ($order_properties_key == 'user_id'): ?>
                                <input type = "hidden" name = "acceptorder_user_id" value = <?= $order_properties_val ?>>
                            <?php else: ?>
                                <td><?= $order_properties_val ?></td>
                            <?php endif; ?>

                            <?php $counter++ ?>
                        <?php endforeach; ?>
                        <td><input type="submit" class="btn btn-success accept_button" name = "acceptorder_submit" value = "ACCEPT"></td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <h3>There are no available orders right now</h3>
<?php endif; ?>
<?= $this->endSection() ?>



