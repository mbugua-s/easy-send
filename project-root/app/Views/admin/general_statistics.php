<?= $this->extend('layouts/admmain.php') ?>

<?= $this->section('css') ?>
  <link rel = "stylesheet" href = "/CSS/general_statistics.css">
<?= $this->endSection() ?>

<?= $this->section('main_content') ?>

<div class = 'all_cards'>
	<?php foreach($statistics as $stat_key => $stat_val) :?>
		<div class="card gx-5">
			<div class="card-body">
				<div class = 'card_content'>
					<h5 class="card-title"><?= $stat_key?></h5>
					<p class="card-text"><?= $stat_val?></p>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<?= $this->endSection() ?>
