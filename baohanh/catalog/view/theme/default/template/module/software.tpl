<br/>
<div class="widget-right hidden-xs hidden-sm">
      <div class="widget-title-heading"><?php echo $heading_title; ?></div>
      <div class="widget-right-content">
	  <?php foreach ($items as $item) { ?>
     <div class="row csdl">
			  <div class="col-md-1">
	<a href="<?php echo $item['href']; ?>"><img src="<?php echo $item['thumb'] ;?>" alt="<?php echo $item['name']; ?>" width="75" height="60" class="thumbnail"></a>
			 </div>
             <div class="col-md-10 title_software">
             <a href="<?php echo $item['href']; ?>"><?php echo $item['name']; ?></a>
             </div>
         </div>	
		<?php } ?>
		<div style="float:right;"> <a href="<?php echo $link; ?>"><button type="button" class="btn btn-white btn-danger btn-sm"><?php echo $text_all_items; ?> <i class="ace-icon fa fa-arrow-right icon-on-right"></i></button></a>
      </div>
	  </div>
      </div>