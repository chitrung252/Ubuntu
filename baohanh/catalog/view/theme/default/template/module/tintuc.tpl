<div class="col-md-12">
                 <h2 class="title"><span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;<?php echo $heading_title; ?></span></h2>
                 <div class="widget-content">
				 <?php foreach ($items as $item) { ?>
                 
                  <div class="row description">
				   
                   <div class="col-md-3">
                   <a href="<?php echo $item['href']; ?>"><img src="<?php echo $item['thumb']; ?>" alt="LIB-HITC" class="thumbnail module-tintuc"></a>
                   </div>
                   <div class="col-md-9 short-description">
				   <p class="title-tintuc"><a href="<?php echo $item['href']; ?>"><?php echo $item['name']; ?></a></p>
                   <p class="short-description-detail"><?php echo $item['description']; ?></p>
                   </div>
                  </div>
				  <?php } ?>
				  <br/>
                 <a href="<?php echo $link; ?>"><button type="button" class="btn btn-white btn-danger btn-sm">Xem thêm <i class="ace-icon fa fa-arrow-right icon-on-right"></i></button></a>
                 </div>
            </div>