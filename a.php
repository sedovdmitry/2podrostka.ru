<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) $a = true; else $a = false; ?>

<?php 

	echo $a

?>

<?php if ($a == true): ?>
  <script src="js/jquery-1.10.2.js.gz"></script>
<?php else: ?>
  <script src="js/jquery-1.10.2.js"></script>
<?php endif; ?>
