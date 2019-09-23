<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

<script type="text/javascript" src="view/javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/jquery-ui.min.js"></script>
<link href="view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen" />
<link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />

<script src="view/javascript/jquery/datetimepicker/moment.min.js" type="text/javascript"></script>
<script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />

<link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="screen" />
<link type="text/css" href="view/stylesheet/font-roboto.css" rel="stylesheet" />
<link type="text/css" href="view/stylesheet/jquery-ui.min.css" rel="stylesheet" />
<link type="text/css" href="view/stylesheet/custom.css" rel="stylesheet" />


<?php foreach ($styles as $style) { ?>
<link type="text/css" href="<?php echo $style['href']; ?>" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<script src="view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
</head>
<body>
<div id="container">
<header>
 <?php if ($logged) { ?>
<div id="header"><a href="<?php echo $home; ?>">TPSHOP </a><br/><span>Quản lý sản phẩm</span>
<div class="logout btn-group">
  <button type="button" class="btn btn-success"><?php echo $profile ;?></button>
  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="<?php echo $logout; ?>"><i class="fa fa-sign-out fa-lg"></i><?php echo $text_logout; ?></a></li>
  </ul>
</div>
</div>
<?php } ?>

</header>
 <?php if ($logged) { ?>
 <?php echo $menu ;?>
<?php } ?>