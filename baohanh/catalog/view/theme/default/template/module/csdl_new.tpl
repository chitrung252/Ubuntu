<div class="widget-right">
      <div class="widget-title-heading"><?php echo $text_csdl_new; ?></div>
      <div class="widget-right-content">
	  <?php 
	  $i = 0;
	  foreach ($items as $item) { $i++; ?>
          <div class="row csdl">
			  <div class="col-md-2">
			  <span class="badge csdl"><?php echo $i;?></span>
			 </div>
             <div class="col-md-8">
             <a href="<?php echo $item['href']; ?>"><?php echo $item['name']; ?></a>
             </div>
             </div>	
		<?php } ?>
      </div>
      </div>