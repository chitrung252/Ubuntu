<!DOCTYPE html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all" />
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">
<link href="catalog/view/theme/default/stylesheet/blog.css" rel="stylesheet">
<link href="catalog/view/theme/default/stylesheet/font-roboto.css" rel="stylesheet">

<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
</head>
<body>
<header>
  <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
		<a class="navbar-brand" href="#">KIỂM TRA BẢO HÀNH</a>
          <a class="blog-nav-item active" href="#">Trang chủ </a>
		   <a class="blog-nav-item" href="#">Mua hàng</a>
        </nav>
      </div>
    </div>
	
<div class="container">
<div class="col-md-8 note_main">
<i class="fa fa-tags" aria-hidden="true"></i>
Ghi chú: Bạn có thể tìm kiếm thông tin theo <span class="note">" Mã imei, Số điện thoại ".</span><br/>
<span class="note_in">(Vui lòng nhập thông tin theo hóa đơn đặt hàng) </span>
</div>
 <div class="search">
 <div class="col-md-8">
	 <?php echo $search ;?>
 </div>
 </div>
 </div>
</header>
 
