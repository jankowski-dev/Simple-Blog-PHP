<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/project/webroot/css/style.css">
	<link rel="stylesheet" href="/project/webroot/libraries/bootstrap_4.5.3/css/bootstrap.min.css">
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
	<!-- <script type="text/javascript" src="/project/webroot/libraries/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			mode: "textareas",
			theme: "simple",
			elements: "tinyEditor" // тут прописывается название элемента, который мы будем добавлять к текстовому полю.
		});
	</script> -->
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