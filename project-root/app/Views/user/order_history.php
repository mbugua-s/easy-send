<?= $this->extend('layouts/main.php') ?>

<?php $counter = 1; ?>

<?= $this->section('css') ?>
  <link rel = "stylesheet" href = "/CSS/order_history.css">
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
                    <th scope="col">Confirmation Photo</th>
                    <th scope="col">Cost (Ksh)</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($order as $order_key => $order_properties) :?>
                    <tr>
                        <form method = 'POST' action = '/Deliveryperson/acceptOrder'>
                            <td><?= $counter ?></td>
                            <?php foreach($order_properties as $order_properties_key => $order_properties_val) :?>
                                <?php if($order_properties_key == 'confirmation_photo') :?>
                                    <td><button type="button" class="btn btn-primary open_photo bg-dark" onclick='getImageLink("<?=$order_properties_val?>")' data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            View
                                        </button>
                                    </td>                                   
                                <?php else: ?>
                                    <td><?= $order_properties_val ?></td>
                                <?php endif; ?>    

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
    
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmation Photo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img class = "confirmation_photo">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</body>


<?= $this->endSection() ?>

<?= $this->section('JS') ?>
    <script>
        function getImageLink(imgLink)
        {
            $('.confirmation_photo').attr('src', '/confirmation_photos/'+imgLink);
        }
    </script>
<?= $this->endSection() ?>
