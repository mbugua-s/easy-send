<?= $this->extend('layouts/main.php') ?>

<?= $this->section('main_content') ?>

<?php foreach($statistics as $stat_key => $stat_val) :?>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?= $stat_key?></h5>
            <p class="card-text"><?= $stat_val?></p>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection() ?>
