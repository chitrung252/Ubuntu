<?php echo $header; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_install) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_install; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
	<div class="row" id="sum_widgets">
   <div class="col-lg-3 col-md-3 col-sm-6"><div class="panel income db mbm">
    <div class="panel-body">
        <p class="icon"><i class="icon fa fa-money"></i></p>
        <h4 class="value"><span><?php echo number_format($tongdoanhthu) ;?></span></h4>
        <p class="description">Tổng doanh thu</p>
    </div>
	</div>
	</div>
     <div class="col-lg-3 col-md-3 col-sm-6"><div class="panel profit db mbm">
    <div class="panel-body">
        <p class="icon"><i class="icon fa fa-shopping-basket"></i></p>
        <h4 class="value"><span><?php echo $tongdonhang ;?></span></h4>
        <p class="description">Tổng đơn hàng</p>
    </div>
	</div>
	</div>
    <div class="col-lg-3 col-md-3 col-sm-6"><div class="panel visit db mbm">
    <div class="panel-body">
        <p class="icon"><i class="icon fa fa-product-hunt"></i></p>
        <h4 class="value"><span><?php echo $tongsanphammua ;?></span></h4>
        <p class="description">Tổng sản phẩm đã mua</p>
    </div>
	</div>
	</div>
  <div class="col-lg-3 col-md-3 col-sm-6"><div class="panel db mbm">
    <div class="panel-body">
        <p class="icon"><i class="icon fa fa-user"></i></p>
        <h4 class="value"><span><?php echo $tongkhachhang ;?></span></h4>
        <p class="description">Tổng khách hàng</p>
    </div>
	</div>
	</div>
   
     </div>
	<!-- related order -->
	
	<div class="row">
	 <div class="col-lg-12 col-md-12 col-sx-12 col-sm-12">
	  <div class="panel panel-default dashboard">
	  <div class="panel-heading dashboard">
		<h3 class="panel-title dashboard"><i class="fa fa-shopping-basket"></i>Đơn hàng mới nhất</h3>
	  </div>
	  <div class="panel-body">
		<table class="table table-bordered">
        <thead>
		<th style="width:100px;">Mã đơn hàng</th>
		<th class="text-center">Tên khách hàng</th>
		<th class="text-center">Ngày mua</th>
		<th class="text-center">Tổng tiền</th>
		<th class="text-center" style="width:200px;">Tùy chọn</th>
		</thead>
		<tbody>
		 <?php foreach ($orders as $order) { ?>
		<tr>
		<td><?php echo $order['order_id'] ;?></td>
		<td><?php echo $order['customer_name'] ;?></td>
		<td><?php echo $order['date_added'] ;?></td>
		<td><?php echo $order['subtotal'] ;?></td>
		<td class="text-center">
		<a href="<?php echo $order['view']; ?>" data-toggle="tooltip" title="" class="btn btn-info" target="_blank" data-original-title="view"><i class="fa fa-eye"></i></a>
		<a href="<?php echo $order['print']; ?>" data-toggle="tooltip" title="" class="btn btn-success" target="_blank" data-original-title="print"><i class="fa fa-print"></i></a>
		 <a href="<?php echo $order['print_mini']; ?>" class="btn btn-warning" target="_blank"><i class="fa fa-print"></i></a>
		</td>
		</tr>
		 <?php } ?>
		</tbody>
         </table>
		 <span class="readmore"><a href="<?php echo $readmore_order ;?>"><i class="fa fa-hand-o-right" aria-hidden="true"></i>Xem thêm</a></span>
	  </div>
	  </div>
	 </div>
	
	
	</div>
	
	<!-- infor -->
    <div class="row">
	 <div class="col-lg-6 col-md-12 col-sx-12 col-sm-12">
	  <div class="panel panel-default dashboard">
	  <div class="panel-heading dashboard">
		<h3 class="panel-title dashboard"><i class="fa fa-rss"></i>Sản phẩm mới cập nhật</h3>
	  </div>
	  <div class="panel-body">
	  <?php foreach ($products as $product) { ?>
		<p class="dashboard"><a href="<?php echo $product['edit'] ;?>"><i class="lib fa fa-angle-double-right"></i><?php echo $product['name'] ;?></a></p>
	  <?php } ?>
	  <span class="readmore"><a href="<?php echo $readmore_product ;?>"><i class="fa fa-hand-o-right" aria-hidden="true"></i>Xem thêm</a></span>
	  </div>
	  </div>
	 </div>
	<div class="col-lg-6 col-md-12 col-sx-12 col-sm-12">
	  <div class="panel panel-default dashboard">
	  <div class="panel-heading dashboard">
		<h3 class="panel-title dashboard"><i class="fa fa-rss"></i>Sản phẩm được mua nhiều</h3>
	  </div>
	  <div class="panel-body">
	  <?php foreach ($spmuanhieu as $row_spmuanhieu) { ?>
		<p class="dashboard"><i class="lib fa fa-angle-double-right"></i><?php echo $row_spmuanhieu['name_product'] ;?></p>
	  <?php } ?>
	  <span class="readmore"><a href="<?php echo $readmore_productviewed ;?>"><i class="fa fa-hand-o-right" aria-hidden="true"></i>Xem thêm</a></span>
	  </div>
	  </div>
	 </div>
	 
    </div>
    
  </div>
</div>
<?php echo $footer; ?>