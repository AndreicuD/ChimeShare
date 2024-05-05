<?php

/**
 * This is the master page layout
 */
?><!doctype html>
<html lang="en">
	<?= partial('partials/head.php', array('page_name'=>$page_name, 'meta_title' => $meta_title, 'meta_description' => $meta_description)); ?>
	<body id="<?= $page_name ?? ''; ?>">

  		<?= partial('partials/header.php'); ?>

		<?= $content ?>

		<?= partial('partials/footer.php'); ?>
	</body>
</html>