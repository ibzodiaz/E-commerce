<?php
if (!isset($_SESSION['seller'])) {
	header('Location:index.php?url=form');
}

?>