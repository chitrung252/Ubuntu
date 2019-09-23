<?php echo $header; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $add; ?>" class="btn btn-primary"><i class="lib-fa fa fa-plus"></i>Thêm mới</a>
		<button type="button" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-order').submit() : false;"><i class="lib-fa fa fa-trash-o"></i>Xóa</button></div>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
   <!-- begin table -->
   <div class="well">
          <div class="row">
		  <div class="col-sm-4">
		  <div class="form-group">
                <label class="control-label" for="input-customer"><?php echo $entry_customer; ?></label>
                <input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
              </div>
		  </div>
		  <div class="col-sm-4">
		 <div class="form-group">
                <label class="control-label" for="input-order-id"><?php echo $entry_order_id; ?></label>
                <input type="text" name="filter_order_id" value="<?php echo $filter_order_id; ?>" placeholder="<?php echo $entry_order_id; ?>" id="input-order-id" class="form-control" />
              </div>
		  </div>
		  <div class="col-sm-1">
		  <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
		  </div>
		  </div>
	</div>
   <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-order">
   <table id="table_order" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
			    <th style="width: 1px;" class="text-center no-sort"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
                <th><?php echo $column_order_id; ?></th>
				 <th><?php echo $column_customer; ?></th>
				 <th><?php echo $column_date_added; ?></th>
                <th><?php echo $column_total; ?></th>
				<th class="no-sort text-center"><?php echo $column_action; ?></th>
            </tr>
        </thead>
		
        <tbody>
		     <?php if ($orders) { ?>
              <?php foreach ($orders as $order) { ?>
            <tr>
			   <td class="text-center"><?php if (in_array($order['order_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" />
                    <?php } ?></td>
                <td><?php echo $order['order_id'] ;?></td>
				<td><?php echo $order['customer_name'] ;?></td>
				 <td><?php echo $order['date_added'] ;?></td>
                 <td><?php echo $order['subtotal'] ;?></td>
				 <td class="text-center"><a href="<?php echo $order['view']; ?>" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i></a> <a href="<?php echo $order['edit']; ?>"  class="btn btn-primary"><i class="fa fa-pencil"></i></a>
				 <a href="<?php echo $order['print']; ?>" class="btn btn-success" target="_blank"><i class="fa fa-print"></i></a>
				 <a href="<?php echo $order['print_mini']; ?>" class="btn btn-warning" target="_blank"><i class="fa fa-print"></i></a>
				 </td>
            </tr>

			 <?php } ?>
			 <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
	</form>
	<div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        </div>
  </div>
 <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	url = 'index.php?route=sale/order&token=<?php echo $token; ?>';
	
	var filter_order_id = $('input[name=\'filter_order_id\']').val();
	
	if (filter_order_id) {
		url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
	}
	
	var filter_customer = $('input[name=\'filter_customer\']').val();
	
	if (filter_customer) {
		url += '&filter_customer=' + encodeURIComponent(filter_customer);
	}
			
	location = url;
});
//--></script>
</div>

<?php echo $footer; ?>