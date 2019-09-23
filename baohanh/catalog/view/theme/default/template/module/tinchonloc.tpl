<div class="col-md-12">
<div class="widget">
 <h2 class="title"><span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;<?php echo $heading_title; ?></span></h2>
             <div class="widget-content">
			 <div class="row content-tinchonloc">
			 <?php foreach ($items as $item) { ?>
             <div class="row col-md-6 list_tinchonloc">
             <div class="col-md-4">
             <a href="<?php echo $item['href']; ?>"><img src="<?php echo $item['thumb']; ?>" alt="lib-HITC" class="thumbnail tinchonloc"></a>
             </div>
             <div class="col-md-8 tinchonloc">
             <a href="<?php echo $item['href']; ?>"><?php echo $item['name']; ?></a>
             <p class="hits"> Lượt xem : <?php echo $item['viewed'] ;?> </p>
             </div>
             </div>
			 <?php } ?>
			 </div>
             <a href="<?php echo $link; ?>"><button type="button" class="btn btn-white btn-danger btn-sm"><?php echo $text_all_items; ?><i class="ace-icon fa fa-arrow-right icon-on-right"></i></button></a>
            </div>
  </div>
 </div>    