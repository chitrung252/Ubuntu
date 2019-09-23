<br/>
<div class="widget-right">
      <div class="widget-title-heading"><?php echo $heading_title ;?></div>
      <div class="widget-right-content">
	       <?php foreach ($elearning as $row) { ?>
	         <div class="row csdl">
			  <div class="col-md-4">
			  <a href="<?php echo $row['href']; ?>"><img src="<?php echo $base ;?>/<?php echo $row['image'] ;?>" alt="<?php echo $row['title'] ;?>" class="thumbnail mod_elearning"></a>
			 </div>
			 <div class="col-md-8">
			 <?php if(mb_strlen($row['title'], 'UTF-8')>70){;?>
			 <a href="<?php echo $row['href'] ;?>"><?php echo mb_substr($row['title'], 0, 68, 'UTF-8'). "..." ;?></a>
			<?php } else {;?>
			 <a href="<?php echo $row['href'] ;?>"><?php echo $row['title'];?></a>
			<?php } ;?>
			 <p style="color:#8F8F8F; font-size:12px; padding-top:5px;"><?php echo $text_author ;?><span style="color:#C1291A;"><?php echo $row['author'] ;?></span></p>
			 </div>
             </div>	
			 <?php } ?>
		     </div>
			 <div style="float:right;">
			 <a href="<?php echo $base ;?>tai-lieu-noi-bo"><button type="button" class="btn btn-white btn-danger btn-sm">Xem thêm <i class="ace-icon fa fa-arrow-right icon-on-right"></i></button></a>
			 </div>
      </div>