<div class="col-md-12">
   <h2 class="title"><span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;<?php echo $heading_title; ?></span></h2>
    <div class="widget-content">
    <div class="row">
  <?php foreach ($book as $row) { ?>
   <div class="col-md-2">
    <a href="<?php echo $row['href'] ;?>">
   <img src="<?php echo $base ;?>/<?php echo $row['image'] ;?>" alt="<?php echo $row['title'];?>" class="thumbnail book">
    </a>
	<?php if(mb_strlen($row['title'], 'UTF-8')>32){;?>
	 <a href="<?php echo $row['href'] ;?>"><?php echo mb_substr($row['title'], 0, 30, 'UTF-8'). "..." ;?></a>
	<?php } else {;?>
	 <a href="<?php echo $row['href'] ;?>"><?php echo $row['title'];?></a>
    <?php } ;?>
      </div>
     <?php } ?>
      </div>
	   <br/>
       <a href="<?php echo $link ;?>"><button type="button" class="btn btn-white btn-danger btn-sm">Xem thêm<i class="ace-icon fa fa-arrow-right icon-on-right"></i></button>
        </a>
		</div>
       </div>