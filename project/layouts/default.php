<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/project/webroot/css/style.css">
	<link rel="stylesheet" href="/project/webroot/css/main.css">
    <link rel="stylesheet" href="/project/webroot/css/media.css">
	<link rel="stylesheet" href="/project/webroot/libraries/bootstrap_4.5.3/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<script>
		tinymce.init({
			selector: '#textarea'
		});
	</script>
	<title><?= $title ?></title>
</head>

<body>
	<?= $content ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="/project/webroot/libraries/bootstrap_4.5.3/js/bootstrap.min.js"></script>
</body>

</html>