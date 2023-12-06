<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<h1><?= $title ?></h1>
	<h4><?= $subtitle ?></h4>
	<ul>
		<li>
			<a href="<?= base_url('home/index') ?>">Home</a><br>
		</li>
		<li>
			<a href="<?= base_url('blog/index') ?>">Blog</a><br>
		</li>
		<li>
			<a href="<?= base_url('home/about') ?>">About</a><br>
		</li>
		<li>
			<a href="<?= base_url('blog/comment') ?>">Comment</a><br>
		</li>
	</ul>
</body>

</html>