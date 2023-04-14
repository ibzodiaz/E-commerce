<?php if(isset($_SESSION['success'])): ?>
	<div class="alert-success">
		<span><i class="fa-solid fa-circle-check"></i>&nbsp;<?= $_SESSION['success'] ?></span>
	</div>
<?php unset($_SESSION['success']); ?>
<?php endif;?>

<?php if(isset($_SESSION['error'])): ?>
	<div class='alert-error'>
		<span><i class='fa-solid fa-xmark'></i>&nbsp;&nbsp;<?= $_SESSION['error'] ?></span>
	</div>
<?php unset($_SESSION['error']); ?>
<?php endif;?>
