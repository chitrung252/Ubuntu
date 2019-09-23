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
  <div class="well">
 <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              </div>
            </div>
			<div class="col-sm-4">
			  <div class="form-group">
                <label class="control-label" for="input-model"><?php echo $entry_model; ?></label>
                <input type="text" name="filter_model" value="<?php echo $filter_model; ?>" placeholder="<?php echo $entry_model; ?>" id="input-model" class="form-control" />
              </div>
			</div>
            <div class="col-sm-1">
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
 
  </div>

  <p> Sản phẩm gần hết: <span class="label label-warning">Warning</span> 
  <form action="" method="post" enctype="multipart/form-data" id="form-warehouse">
<table id="table_product" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
			   
                <th><?php echo $column_name ;?></th>
				 <th><?php echo $column_model ;?></th>
                <th><?php echo $column_quantity ;?></th>

            </tr>
        </thead>
        <tbody>
		<?php if ($products) { ?>
             <?php foreach ($products as $product) { ?>
            <tr>
			  
                <td><?php echo $product['name']; ?></td> 
				<td><?php echo $product['model'] ;?></td>
                <td>
				<?php if(($product['quantity'] - $product['quantity_order']) <=2 ){?>
				<span class="label label-warning"> <?php echo ($product['quantity'] - $product['quantity_order']) ;?></span>
				</td>
               <?php } else { ?>
			   <?php echo ($product['quantity'] - $product['quantity_order']) ;?>
			   <?php } ?> 
				
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
	var url = 'index.php?route=report/warehouse&token=<?php echo $token; ?>';

	var filter_name = $('input[name=\'filter_name\']').val();

	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	var filter_model = $('input[name=\'filter_model\']').val();

	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}

	location = url;
});
//--></script>
 <script type="text/javascript"><!--
$('input[name=\'filter_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=report/warehouse/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_name\']').val(item['label']);
	}
});

//--></script>
</div>
<?php echo $footer; ?>