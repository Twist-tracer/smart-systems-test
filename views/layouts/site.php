<?php
    $content = $content ?? '';
    $title = $title ?? '';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">

	<link href="/assets/css/main.css" rel="stylesheet">

	<title><?=$title?></title>
</head>
<body>
    <main><?= $content ?></main>

	<script src="/assets/js/main.js"></script>
</html>
