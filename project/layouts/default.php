<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/project/webroot/css/style.css">
	<link rel="stylesheet" href="/project/webroot/libraries/bootstrap_4.5.3/css/bootstrap.min.css">
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector: '#textarea'
		});
	</script>
	<title><?= $title ?></title>
</head>

<body>
	<?= $content ?>
	<script src="/project/webroot/libraries/bootstrap_4.5.3/js/bootstrap.min.js"></script>
</body>

</html>