<div class="col-md-12">
<div class="widget">
           <h2 class="title-style1"><span><i class="fa fa-bell-o"></i>&nbsp;<?php echo $heading_title; ?></span></h2>
		   <div class="widget-content-style1">
		   <ul class="list-unstyled">
		   <?php foreach ($items as $item) { ?>
            <li>
			<a href="<?php echo $item['href']; ?>"><i class="ace-icon fa fa-caret-right yellow"></i>&nbsp;&nbsp;<?php echo $item['name']; ?></a>
			</li>
			<?php } ?>
            </ul>
             <a href="<?php echo $link; ?>"><button type="button" class="btn btn-white btn-danger btn-sm"><?php echo $text_all_items; ?> <i class="ace-icon fa fa-arrow-right icon-on-right"></i></button></a>
            </div>
   </div>
   </div>