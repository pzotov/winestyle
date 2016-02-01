<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Тестовое задание</title>
	<style>
		*, *:before, *:after {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		body {
			padding: 0;
			margin: 0;
			font-size: 15px;
			font-family: "Trebuchet MS", sans-serif;
		}
		.gallery {
		}
		.gallery:after {
			content: '';
			display: block;
			clear: both;
		}
		.image {
			float: left;
			width: 123px;
			height: 140px;
			text-align: center;
			margin: 10px;
			padding: 10px;
			border: 1px solid #aaa;
		}
		.image__a {
			display: block;
			width: 101px;
			height: 101px;
			line-height: 101px;
		}
		.image__preview {
			vertical-align: middle;
		}
		.image__links {
			line-height: 17px;
		}
		.image__link {
		}
	</style>
	<link rel="stylesheet" href="fancybox/jquery.fancybox.css">
</head>

<body>
<?
if ($handle = opendir('images/')){
	echo '<div class="gallery">';
	$i = 0;
	while (false !== ($entry = readdir($handle))) {
		if($entry=='.' || $entry=='..') continue;
		echo '
		<div class="image">
			<a href="generator.php?image='.urlencode($entry).'&size=big" class="fancybox image__a" rel="pic'. $i .'" data-fancybox-title="'.htmlspecialchars($entry.': размер big').'">
				<img src="generator.php?image='. urlencode($entry) .'&size=mic" alt="" class="image__preview">
			</a>
			<div class="image__links">
				<a href="generator.php?image='.urlencode($entry).'&size=med" class="fancybox image__link" rel="pic'. $i .'" data-fancybox-title="'.htmlspecialchars($entry.': размер med').'">med</a>
				<a href="generator.php?image='.urlencode($entry).'&size=min" class="fancybox image__link" rel="pic'. $i .'" data-fancybox-title="'.htmlspecialchars($entry.': размер min').'">min</a>
				<a href="generator.php?image='.urlencode($entry).'&size=mic" class="fancybox image__link" rel="pic'. $i .'" data-fancybox-title="'.htmlspecialchars($entry.': размер mic').'">mic</a>
			</div>
		</div>
		';
		$i++;
	}
	echo '</div>';
}

?>
<script type="text/javascript" src="https://yastatic.net/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
	$(function(){
		$(".fancybox").fancybox({
			type: 'image'
		});
	});
</script>
</body>
</html>
