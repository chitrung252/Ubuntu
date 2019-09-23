<?php echo $header; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $invoice; ?>" target="_blank" data-toggle="tooltip" title="<?php echo $button_invoice_print; ?>" class="btn btn-info"><i class="fa fa-print"></i></a> <a href="<?php echo $edit; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a> <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
  <div class="panel panel-info dashboardform">
   <div class="panel-heading info">
        <h3 class="panel-title dashboardform"><i class="fa fa-internet-explorer"></i> Thông tin đơn hàng</h3>
      </div>
	   <div class="panel-body">
   <div class="infor_customer">
    <?php foreach ($infor_customers as $infor_customer) { ?>
	<p>Mã đơn hàng: <span class="customer_id"><?php echo $infor_customer['order_id'] ;?></span></p>
	<p>Tên khách hàng: <span class="customer_name"><?php echo $infor_customer['customer_name'] ;?></p>
	<p>Địa chỉ: <span class="customer_address"><?php echo $infor_customer['address'] ;?></span></p>
	<p>Tên khách hàng: <span class="customer_telephone"><?php echo $infor_customer['telephone'] ;?></span></p>

	
      <?php } ?>
   </div>
   <table class="table table-bordered">
   <thead> 
   <tr>
   <th>Sản phẩm đặt mua</th> 
   <th>Số lượng mua</th> 
   <th>Mã Imei</th>
   <th>Website mua hàng</th>
   <th>Bảo hành</th>
   <th>Thành tiền</th> 
   </tr>
   </thead>
   <tbody>
   <?php foreach ($products as $product) { ?>
   <tr> 
   <td><?php echo $product['name_product'] ;?></td> 
   <td><?php echo $product['quantity_order'] ;?></td> 
   <td><?php echo $product['imei'] ;?></td> 
   <td><?php echo $product['website'] ;?></td>
   <td><?php echo $product['guarantee'] ;?></td> 
   <td><?php echo $product['total'] ;?></td> 
   </tr>
    <?php } ?>
   </tbody>
   </table>
   <p class="tongtien">Tổng tiền: <?php echo $tongtien ;?></p>
   <br/>
	<hr/>
 </div>
	 </div>
  </div>
  </div>
<?php echo $footer; ?> 
