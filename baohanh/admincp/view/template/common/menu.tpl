<?php 	global $registry; $userac = $registry->get('user'); ?>
<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 0.533333px;">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo $home; ?>"><i class="fa fa-dashboard fa-fw"></i> <?php echo $text_dashboard; ?></a></li>
            <?php if($userac->hasPermission('access','catalog/product')) {  ?>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="lib-fa fa fa-cube"></i><?php echo $text_product; ?></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $product; ?>"><?php echo $text_product_list; ?></a></li>
                <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
				<li><a href="<?php echo $guarantee ;?>"><?php echo $text_guarantee; ?></a></li>
              </ul>
            </li>
			<?php } ?>
			 <?php if($userac->hasPermission('access','sale/order')) {  ?>
			 <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="lib-fa fa fa-balance-scale"></i><?php echo $text_sale; ?></a>
              <ul class="dropdown-menu">
			    <li><a href="<?php echo $customer ;?>"><?php echo $text_preport_customer; ?></a></li>
                <li><a href="<?php echo $order ;?>"><?php echo $text_order; ?></a></li>
              </ul>
            </li>
             <?php } ?>
			 <?php if($userac->hasPermission('access','report/sale_order')) {  ?>
			 <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="lib-fa fa fa-bar-chart-o fa-fw"></i><?php echo $text_reports; ?></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $report_customer ;?>"><?php echo $text_preport_customer; ?></a></li>
                <li><a href="<?php echo $report_sale ;?>"><?php echo $text_report_sale; ?></a></li>
		       <li><a href="<?php echo $report_warehouse ;?>"><?php echo $text_report_warehouse; ?></a></li>
			   <li><a href="<?php echo $report_productviewed ;?>"><?php echo $text_preport_productviewed; ?></a></li>
              </ul>
            </li>
			  <?php } ?>
			  <div class="hidden">
             <?php if($userac->hasPermission('access','catalog/menu')) {  ?>
             <li><a href="<?php echo $main_menu; ?>"><i class="lib-fa fa fa-tags fa-fw"></i><?php echo $text_menu; ?></a>
               </li>
	           <?php } ?></div>
			   
			  <?php if($userac->hasPermission('access','extension/module')) {  ?>
			   <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="lib-fa fa fa-puzzle-piece fa-fw"></i><?php echo $text_extension; ?></a>
              <ul class="dropdown-menu">
                 <li><a href="<?php echo $installer; ?>"><?php echo $text_installer; ?></a></li>
                  <li><a href="<?php echo $modification; ?>"><?php echo $text_modification; ?></a></li>
                  <li><a href="<?php echo $module; ?>"><?php echo $text_module; ?></a></li>
				  <?php if($userac->hasPermission('access','tool/file_manager')) {  ?>
				  <li><a href="<?php echo $file_manager; ?>"><?php echo $text_file_manager; ?></a></li>
                  <li><a href="<?php echo $backup; ?>"><?php echo $text_backup; ?></a></li>
                   <li><a href="<?php echo $scheduled_backup; ?>"><?php echo $text_scheduled_backup; ?></a></li>
                  <li><a href="<?php echo $error_log; ?>"><?php echo $text_error_log; ?></a></li>
				   <?php } ?>
              </ul>
               </li>
			   <?php } ?>
			   <?php if($userac->hasPermission('access','user/user')) {  ?>
			    <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="lib-fa fa fa-user fa-fw"></i><?php echo $text_users; ?></a>
              <ul class="dropdown-menu">
                 <li><a href="<?php echo $user; ?>"><?php echo $text_user; ?></a></li>
                 <li><a href="<?php echo $user_group; ?>"><?php echo $text_user_group; ?></a></li>
                  <li><a href="<?php echo $api; ?>"><?php echo $text_api; ?></a></li>
               </ul>
               </li>
			     <?php } ?>
			<?php if($userac->hasPermission('access','setting/setting')) {  ?> 
			   <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog fa-fw"></i> <?php echo $text_system; ?></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $setting; ?>"><?php echo $text_setting; ?></a></li>
                <li><a href="<?php echo $layout; ?>"><?php echo $text_layout; ?></a></li>
                 <li><a href="<?php echo $language; ?>"><?php echo $text_language; ?></a></li>
                 <li><a href="<?php echo $country; ?>"><?php echo $text_country; ?></a></li>
               </ul>
               </li>
			 <?php } ?>
		  </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active1"><a href="<?php echo $banhang;?>"><i class="lib-fa fa fa-shopping-cart" aria-hidden="true"></i>Bán hàng</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>