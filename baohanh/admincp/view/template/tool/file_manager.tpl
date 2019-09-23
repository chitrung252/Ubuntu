<?php echo $header; ?><?php //echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <h1><i class="fa fa-exclamation-circle"></i> <?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
        <iframe src="<?php echo $frame; ?>" width="800" height="500" frameborder="0"></iframe>
  </div>
</div>

<?php echo $footer; ?>