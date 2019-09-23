<?php echo $header; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-product" class="btn btn-primary"><i class="lib-fa fa fa-save"></i>Lưu lại</button>
        <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="lib-fa fa fa-reply"></i>Hủy bỏ</a></div>
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
    <div class="panel panel-default dashboardform">
      <div class="panel-heading dashboardform">
        <h3 class="panel-title dashboardform"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <div class="tab-content">
                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
                    <div class="col-sm-10">
                       <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
					  <?php if ($error_name) { ?>
					  <div class="text-danger"><?php echo $error_name; ?></div>
					  <?php } ?>
                    </div>
                  </div>
				  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-model"><?php echo $entry_model; ?></label>
                    <div class="col-sm-10">
                       <input type="text" name="model" value="<?php echo $model; ?>" placeholder="<?php echo $entry_model; ?>" id="input-model" class="form-control" />
					  <?php if ($error_model) { ?>
					  <div class="text-danger"><?php echo $error_model; ?></div>
					  <?php } ?>
                    </div>
                  </div>
				 <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-quantity"><?php echo $entry_quantity; ?></label>
                     <div class="col-sm-10">
                      <input type="number" name="quantity" value="<?php echo $quantity ; ?>" placeholder="<?php echo $entry_quantity; ?>" id="input-quantity" class="form-control" />
                    </div>
                  </div>
				  
				  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-price"><?php echo $entry_price; ?></label>
                     <div class="col-sm-10">
                      <input type="number" name="price" value="<?php echo $price ;?>" placeholder="<?php echo $entry_price; ?>" id="input-price" class="form-control" />
                      <p style="color:red;">Viết liền không chấm: 150000</p>
					</div>
                  </div>
			    <div class="form-group">
                <label class="col-sm-2 control-label" for="input-manufacturer"><?php echo $entry_manufacturer; ?></label>
                <div class="col-sm-10">
                   <select name="manufacturer" id="input-manufacturer" class="form-control">
                     <?php foreach ($manufacturers as $row_manufacturer) { ?>
                          <?php if (isset($manufacturer) && $manufacturer == $row_manufacturer['manufacturer_id']) { ?>
                          <option value="<?php echo $row_manufacturer['manufacturer_id']; ?>" selected="selected"><?php echo $row_manufacturer['manufacturer_name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $row_manufacturer['manufacturer_id']; ?>"><?php echo $row_manufacturer['manufacturer_name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                  </select>
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-guarantee"><?php echo $entry_guarantee; ?></label>
                <div class="col-sm-10">
                   <select name="guarantee" id="input-guarantee" class="form-control">
                     <?php foreach ($guarantees as $row_guarantee) { ?>
                          <?php if (isset($guarantee) && $guarantee == $row_guarantee['guarantee_id']) { ?>
                          <option value="<?php echo $row_guarantee['guarantee_id']; ?>" selected="selected"><?php echo $row_guarantee['guarantee_name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $row_guarantee['guarantee_id']; ?>"><?php echo $row_guarantee['guarantee_name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                  </select>
                </div>
               </div>
				<div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
			  <div class="form-group hidden">
                <label class="col-sm-2 control-label"><?php echo $entry_store; ?></label>
                <div class="col-sm-4">
                  <div class="well well-sm" style="height: 50px; overflow: auto;">
                    <div class="checkbox">
                      <label>
                        <?php if (in_array(0, $product_store)) { ?>
                        <input type="checkbox" name="product_store[]" value="0" checked="checked" />
                        <?php echo $text_default; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="product_store[]" value="0" />
                        <?php echo $text_default; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php foreach ($stores as $store) { ?>
                    <div class="checkbox">
                      <label>
                        <?php if (in_array($store['store_id'], $product_store)) { ?>
                        <input type="checkbox" name="product_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                        <?php echo $store['name']; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="product_store[]" value="<?php echo $store['store_id']; ?>" />
                        <?php echo $store['name']; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
			  <div class="table-responsive hidden">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $entry_store; ?></td>
                      <td class="text-left"><?php echo $entry_layout; ?></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-left"><?php echo $text_default; ?></td>
                      <td class="text-left"><select name="product_layout[0]" class="form-control">
                          <option value=""></option>
                          <?php foreach ($layouts as $layout) { ?>
                          <?php if (isset($product_layout[0]) && $product_layout[0] == $layout['layout_id']) { ?>
                          <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <?php foreach ($stores as $store) { ?>
                    <tr>
                      <td class="text-left"><?php echo $store['name']; ?></td>
                      <td class="text-left"><select name="product_layout[<?php echo $store['store_id']; ?>]" class="form-control">
                          <option value=""></option>
                          <?php foreach ($layouts as $layout) { ?>
                          <?php if (isset($product_layout[$store['store_id']]) && $product_layout[$store['store_id']] == $layout['layout_id']) { ?>
                          <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
 
 <script type="text/javascript"><!--


// Category
$('input[name=\'category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'category\']').val('');
		
		$('#product-category' + item['value']).remove();
		
		$('#product-category').append('<div id="product-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_category[]" value="' + item['value'] + '" /></div>');	
	}
});

$('#product-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

//--></script></div>
<?php echo $footer; ?>