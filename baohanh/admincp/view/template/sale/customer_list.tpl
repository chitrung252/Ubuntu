<?php echo $header; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>"  class="btn btn-primary"><i class="lib-fa fa fa-plus"></i>Thêm mới</a> 
        <button type="button" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-customer').submit() : false;"><i class="lib-fa fa fa-trash-o"></i>Xóa</button>
      </div>
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
	 <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group product">
                <label class="control-label" for="input-customer-name"><?php echo $entry_customer_name; ?></label>
                <input type="text" name="filter_customer_name" value="<?php echo $filter_customer_name; ?>" placeholder="<?php echo $entry_customer_name; ?>" id="input-customer-name" class="form-control" />
              </div>
            </div>
			<div class="col-sm-4">
			  <div class="form-group">
                <label class="control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
                <input type="text" name="filter_telephone" value="<?php echo $filter_telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" />
              </div>
			</div>
            <div class="col-sm-1">
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
   <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-customer">
   <table id="table_customer" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
			    <th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
                <th><?php echo $column_name ;?></th>
				<th><?php echo $column_address ;?></th>
				<th><?php echo $column_telephone ;?></th>
				<th class="no-sort"><?php echo $column_action ;?></th>

            </tr>
        </thead>
        <tbody>
		<?php if ($customers) { ?>
             <?php foreach ($customers as $customer) { ?>
            <tr>
			   <td class="text-center"><?php if (in_array($customer['customer_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $customer['customer_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $customer['customer_id']; ?>" />
                    <?php } ?></td>
                <td><?php echo $customer['customer_name']; ?></td> 
				 <td><?php echo $customer['address']; ?></td> 
				  <td><?php echo $customer['telephone']; ?></td> 
				 <td class="text-right"><a href="<?php echo $customer['edit']; ?>"  class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
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
	var url = 'index.php?route=sale/customer&token=<?php echo $token; ?>';

	var filter_customer_name = $('input[name=\'filter_customer_name\']').val();

	if (filter_customer_name) {
		url += '&filter_customer_name=' + encodeURIComponent(filter_customer_name);
	}

	var filter_telephone = $('input[name=\'filter_telephone\']').val();

	if (filter_telephone) {
		url += '&filter_telephone=' + encodeURIComponent(filter_telephone);
	}

	location = url;
});
//--></script>
 <script type="text/javascript"><!--
$('input[name=\'filter_customer_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_customer_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['customer_name'],
						value: item['customer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_customer_name\']').val(item['label']);
	}
});

//--></script>
</div>

<?php echo $footer; ?>