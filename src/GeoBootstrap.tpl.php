<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?= htmlspecialchars($self->description());/*"*/?>">
	<meta name="author" content="">

	<title><?= htmlspecialchars($self->browser_title()); ?></title>

<?php
	if(!empty($css_list))
		foreach($css_list as $css)
			echo "\t<link rel=\"stylesheet\" href=\"{$css}\" />\n";
?>

<link rel="stylesheet" href="<?=$pub?>/css/geo-bootstrap.min.css" />

<?php

	if(!empty($style))
		echo bors_pages_helper::style($style);

	if(!empty($javascript))
	{
		echo "<script><!--\n";
		foreach($javascript as $s)
			echo $s,"\n";
		echo "--></script>\n";
	}
?>

</head>

<body role="document">

	<!-- Fixed navbar -->
<?php
if(empty($navbar_classes))
	echo "<div class=\"navbar navbar-fixed-top\" role=\"navigation\">";
else
	echo "<div class=\"{$navbar_classes}\" role=\"navigation\">";
?>
		<div class="navbar-inner">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

<?php
if(empty($brand_logo))
	echo "<a class=\"brand\" href=\"{$self->project()->url()}\">".htmlspecialchars($self->project()->title())."</a>";
else
	echo "<a class=\"brand\" href=\"{$self->project()->url()}\">{$brand_logo}</a>";
?>
			</div>
<?php
	if($nav_menu = $self->get('navbar'))
	{
?>
			<div class="nav-collapse collapse">
				<ul class="nav">

<?php
		foreach($nav_menu as $title => $submenu)
		{
			if(is_array($submenu))
			{
?>
				<li class="dropdown">
<!--				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>-->
<?php
			bors_layouts_bootstrap3_dropdown::show(array('menu' => array($title => $submenu)));
?>
				</li>
<?php
			}
			else
			{
				if(preg_match('/^\w+$/', $submenu))
					$url = "/$submenu/";
				else
					$url = $submenu;
				echo "<li class=\"active2\"><a href=\"{$url}\">".htmlspecialchars($title)."</a></li>\n";
			}
		}
?>
				</ul>
			</div><!--/.nav-collapse -->
<?php
	}
?>
		</div>
		</div><!-- .navbar-inner -->
	</div>

	<div class="container" role="main">

		<table cellpadding="2" cellspacing="2">
			<tbody>
				<tr>
				  <td><img src="<?=$pub?>/img/test/ie_logo.gif"></td>
				  <td><img src="<?=$pub?>/img/test/ns_logo.gif"></td>
				  <td><img src="<?=$pub?>/img/test/noframes.gif"></td>
				  <td><img src="<?=$pub?>/img/test/notepad.gif"></td>
				</tr>
			</tbody>
		</table>

<?php if($self->page_title() || $self->description()) { ?>
		<div class="jumbotron">
	<?php if($self->page_title()) { ?>
			<h1><?= $self->page_title() ?></h1>
	<?php } ?>
			<?php if($self->description()) echo "<p>".htmlspecialchars($self->description())."</p>"; ?>
		</div>
<?php } ?>

		<?= $self->layout()->breadcrumb(); ?>

		<?= $self->body() ?>

		<center><img src="<?=$pub?>/img/test/counter2.gif"></center>

	</div> <!-- /container -->

<?php

	if(!empty($js_include))
		foreach($js_include as $s)
			echo "\t<script src=\"{$s}\"></script>\n";

	if(!empty($js_include_post))
		foreach($js_include_post as $s)
			echo Element::script()->type("text/javascript")->src($s);

	if(!empty($javascript_post) || !empty($jquery_document_ready))
	{
		echo "<script><!--\n";
		if(!empty($javascript_post))
		{
			foreach($javascript_post as $js)
				echo $js;
		}

		if(!empty($jquery_document_ready))
		{
//			echo "\$(document).ready(function() {\n";
			echo "\$(function() {\n";
			foreach($jquery_document_ready as $js)
				echo $js, "\n";
			echo "})\n";
		}

		echo "--></script>\n";
	}
?>

</body>
</html>
