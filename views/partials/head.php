<?php

/**
 * the head - included in all pages
 * 
 * @var string $meta_title - page meta title, defaults to Info-Educatie-2024
 * @var string $meta_description - page meta description, defaults to empty string
 */
?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/x-icon" href="./favicon.ico">

	<!-- stylesheets -->
	<link rel="stylesheet" href="./public/css/bootstrap.min.css">
	<link rel="stylesheet" href="./public/css/stylesheet.css">

	<!-- fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet"> 

	<!-- meta fields -->
	<title><?= $meta_title ?? 'Info-Educatie-2024'; ?></title>
	<meta name="description" content="<?= $meta_description ?? ''; ?>">
</head>
