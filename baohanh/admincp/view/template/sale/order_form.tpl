<?php echo $header; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
	    <a href="<?php echo $addcustomer; ?>" class="btn btn-warning"><i class="lib-fa fa fa-address-card-o"></i>Thêm khách hàng</a>
        <button type="submit" form="form-order" class="btn btn-primary"><i class="lib-fa fa fa-save"></i>Lưu lại</button>
        <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="lib-fa fa fa-reply"></i>Hủy bỏ</a>
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
    <div class="panel panel-default dashboardform">
      <div class="panel-heading dashboardform">
        <h3 class="panel-title dashboardform"><i class="fa fa-shopping-cart"></i> <?php echo $text_form; ?></h3>
      </div>
     <div class="panel-body">
       <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-order" class="form-horizontal">
	   <div class="tab-content">
	   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-customer"><i class="lib-fa fa fa-address-book-o" aria-hidden="true"></i><?php echo $entry_customer; ?></label>
                <div class="col-sm-10 order_auto">
                  <input type="text" name="customer_name" value="<?php echo $customer_name ;?>" placeholder="" id="customer_name" class="form-control" />
				  <input type="hidden" name="customer_id" value="" />
				   <?php if ($error_customer_name) { ?>
					  <div class="text-danger"><?php echo $error_customer_name; ?></div>
					  <?php } ?>
                </div>
              </div>
	 <div class="form-group hidden">
                <label class="col-sm-2 control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="telephone" value="<?php echo $telephone ;?>" id="input-telephone" class="form-control" />
                </div>
              </div>
	  <div class="form-group hidden">
                <label class="col-sm-2 control-label" for="input-customer"><?php echo $entry_customer; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="customer" value="<?php echo $customer_name ;?>" id="input-customer" class="form-control" />
                </div>
              </div> 
	   <div class="form-group hidden">
                <label class="col-sm-2 control-label" for="input-address"><?php echo $entry_address; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="address" value="<?php echo $address ;?>" id="input-address" class="form-control" />
                </div>
              </div>
		     <div class="form-group hidden">
                    <label class="col-sm-2 control-label" for="input-date-added"><?php echo $entry_date_added; ?></label>
                     <div class="col-sm-10">
                      <input type="text" name="date_added" value="<?php echo $date_added ; ?>" placeholder="<?php echo $date_added ; ?>" id="input-date_added" class="form-control" />
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
			 
	 <label class="col-sm-2 control-label" for="input-add-product"><i class="lib-fa fa fa-cart-plus" aria-hidden="true"></i><?php echo $entry_add_product; ?></label>
	 <br/>
	 <hr>

    <div class='row'>
      		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
      			<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
							<th width="5%">ID</th>
							<th width="30%">Tên sản phẩm</th>
							<th width="20%">Mã IMEI</th>
							<th width="10%">Đơn giá</th>
							<th width="10%">Số lượng</th>
							<th width="15%">Thành tiền</th>
							<th width="1%">#</th>
						</tr>
					</thead>
					 <?php $product_row = 0; ?>
					<tbody>
					<?php if ($product_orders) { ?>
					 <?php foreach ($product_orders as $product_order) { ?>
						<tr id="product-row<?php echo $product_row; ?>">
							<td><input class="case" type="checkbox"/></td>
							<td><input type="text" data-type="productCode" name="product_order[<?php echo $product_row; ?>][product_id]" value="<?php echo $product_order['product_id'] ;?>" id="itemNo_1" class="form-control autocomplete_txt" autocomplete="off"></td>
							<td><input type="text" data-type="productName" name="product_order[<?php echo $product_row; ?>][name_product]" value="<?php echo $product_order['name_product'] ;?>" id="itemName_1" class="form-control autocomplete_txt" autocomplete="off"></td>
							<td><input type="text" name="product_order[<?php echo $product_row; ?>][imei]" value="<?php echo $product_order['imei'] ;?>" id="imei_1" class="form-control autocomplete_txt" autocomplete="off">
							<input type="number" name="product_order[<?php echo $product_row; ?>][codecolor]" value="<?php echo $product_order['codecolor'] ;?>" id="codecolor_1" class="form-control autocomplete_txt" autocomplete="off">
						
							</td>
							<td><input type="text" name="product_order[<?php echo $product_row; ?>][price]" value="<?php echo $product_order['price'] ;?>" id="price_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
							<td><input type="text" name="product_order[<?php echo $product_row; ?>][quantity_order]" value="<?php echo $product_order['quantity_order'] ;?>" id="quantity_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
							<td><input type="text" name="product_order[<?php echo $product_row; ?>][total]" value="<?php echo $product_order['total'] ;?>" id="total_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
							<td>
							<input type="hidden" name="product_order[<?php echo $product_row; ?>][manufacturer]" value="<?php echo $product_order['manufacturer'] ;?>" id="manufacturer_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
							
							<input type="hidden" name="product_order[<?php echo $product_row; ?>][guarantee]" value="<?php echo $product_order['guarantee'] ;?>" id="guarantee_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
							
							<input type="hidden" name="product_order[<?php echo $product_row; ?>][website]" value="<?php echo $product_order['website'] ;?>" id="website_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
							
							<input type="hidden" name="product_order[<?php echo $product_row; ?>][image]" value="<?php echo $product_order['image'] ;?>" id="image_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
	
							</td>
						    
						</tr>
						<?php $product_row++; ?>
                  <?php } ?>
				  <?php } else { ?>
					  <tr>
						<td class="center" colspan="12"></td>
					  </tr>
					  <?php } ?>
					</tbody>
				</table>
      		</div>
      	</div>
		<div class='row'>
      		<div class='col-sm-8'>
      			<button class="btn btn-danger delete" type="button">- Xóa</button>
      			<button class="btn btn-success addmore" type="button">+ Thêm</button>
      		</div>	
   </div>
     <!-- end tab-content -->
	  </div>
	   </form>
	<!-- end panel-body -->
	</div>
  </div>
  </div>
<script type="text/javascript"><!--
$('input[name=\'customer_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_customer_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				json.unshift({
					customer_id: '0',					
					customer_name: '<?php echo $text_none; ?>',
					telephone: '',
					address: '',
					customer: ''
				});					
				
				response($.map(json, function(item) {
					return {
						label: item['customer_name']  + ' - ' + item['telephone'],
						value: item['customer_id'],	
						telephone: item['telephone'],
						address: item['address'],
						customer: item['customer_name']

					}
				}));
			}
		});
	},
	'select': function(item) {
		// Reset all custom fields
		$('input[name=\'customer_name\']').val(item['label']);
		$('input[name=\'customer_id\']').val(item['value']);
		$('input[name=\'telephone\']').val(item['telephone']);	
		$('input[name=\'address\']').val(item['address']);
		$('input[name=\'customer\']').val(item['customer']);
				
	}
});
//--></script>
<script type="text/javascript"><!--      
//adds extra table rows
var i=$('table tr').length;
$(".addmore").on('click',function(){
	html = '<tr>';
	html += '<td><input class="case" type="checkbox"/></td>';
	html += '<td><input type="text" data-type="productCode" name="product_order['+i+'][product_id]" id="itemNo_'+i+'" class="form-control autocomplete_txt" autocomplete="off" readonly></td>';
	html += '<td><input type="text" data-type="productName" name="product_order['+i+'][name_product]" id="itemName_'+i+'" class="form-control autocomplete_txt" autocomplete="off"></td>';
	html += '<td><input type="text" name="product_order['+i+'][imei]" id="imei_'+i+'" class="form-control" autocomplete="off"><input type="number" name="product_order['+i+'][codecolor]" id="codecolor_'+i+'" class="form-control" autocomplete="off"></td>';
	html += '<td><input type="text" name="product_order['+i+'][price]" id="price_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly></td>';
	html += '<td><input type="number" name="product_order['+i+'][quantity_order]" id="quantity_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
	html += '<td><input type="text" name="product_order['+i+'][total]" id="total_'+i+'" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly></td>';
	html += '<td><input type="hidden" name="product_order['+i+'][manufacturer]" id="manufacturer_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly>';
	html += '<input type="hidden" name="product_order['+i+'][guarantee]" id="guarantee_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly>';
	html += '<input type="hidden" name="product_order['+i+'][website]" id="website_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly>';
	html += '<input type="hidden" name="product_order['+i+'][image]" id="image_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly></td>';
	html += '</tr>';
	$('table').append(html);
	i++;
});

//to check all checkboxes
$(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('#check_all').prop("checked", false); 
	calculateTotal();
});


var product = [
<?php foreach ($products as $product) { ?>
"<?php echo $product['product_id'] ;?>|<?php echo $product['name'] ;?>|<?php echo $product['price'] ;?>|<?php echo $product['manufacturer_name'] ;?>|<?php echo $product['guarantee_name'] ;?>|<?php echo $product['website'] ;?>|<?php echo $product['image'] ;?>",
<?php } ?>
];
//autocomplete script
$(document).on('focus','.autocomplete_txt',function(){
	type = $(this).data('type');
	
	if(type =='productCode' )autoTypeNo=0;
	if(type =='productName' )autoTypeNo=1; 	
	
	$(this).autocomplete({
		source: function( request, response ) {	 
			 var array = $.map(product, function (item) {
                 var code = item.split("|");
                 return {
                     label: code[autoTypeNo],
                     value: code[autoTypeNo],
                     data : item
                 }
             });
             //call the filter here
             response($.ui.autocomplete.filter(array, request.term));
		},
		autoFocus: true,	      	
		minLength: 2,
		select: function( event, ui ) {
			var names = ui.item.data.split("|");						
			id_arr = $(this).attr('id');
	  		id = id_arr.split("_");
			$('#itemNo_'+id[1]).val(names[0]);
			$('#itemName_'+id[1]).val(names[1]);
			$('#quantity_'+id[1]).val(1);
			$('#price_'+id[1]).val(names[2]);
			$('#manufacturer_'+id[1]).val(names[3]);
			$('#guarantee_'+id[1]).val(names[4]);
			$('#website_'+id[1]).val(names[5]);
			$('#image_'+id[1]).val(names[6]);
			$('#total_'+id[1]).val( 1*names[2] );
			calculateTotal();
		}		      	
	});
});

//price change
$(document).on('change keyup blur','.changesNo',function(){
	id_arr = $(this).attr('id');
	id = id_arr.split("_");
	quantity = $('#quantity_'+id[1]).val();
	price = $('#price_'+id[1]).val();
	if( quantity!='' && price !='' ) $('#total_'+id[1]).val( (parseFloat(price)*parseFloat(quantity)).toFixed(2) );	
	calculateTotal();
});

$(document).on('change keyup blur','#tax',function(){
	calculateTotal();
});

//total price calculation 
function calculateTotal(){
	subTotal = 0 ; total = 0; 
	$('.totalLinePrice').each(function(){
		if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
	});
	$('#subTotal').val( subTotal.toFixed(2) );
	tax = $('#tax').val();
	if(tax != '' && typeof(tax) != "undefined" ){
		taxAmount = subTotal * ( parseFloat(tax) /100 );
		$('#taxAmount').val(taxAmount.toFixed(2));
		total = subTotal + taxAmount;
	}else{
		$('#taxAmount').val(0);
		total = subTotal;
	}
	$('#totalAftertax').val( total.toFixed(2) );
	calculateAmountDue();
}

$(document).on('change keyup blur','#amountPaid',function(){
	calculateAmountDue();
});

//due amount calculation
function calculateAmountDue(){
	amountPaid = $('#amountPaid').val();
	total = $('#totalAftertax').val();
	if(amountPaid != '' && typeof(amountPaid) != "undefined" ){
		amountDue = parseFloat(total) - parseFloat( amountPaid );
		$('.amountDue').val( amountDue.toFixed(2) );
	}else{
		total = parseFloat(total).toFixed(2);
		$('.amountDue').val( total );
	}
}


//It restrict the non-numbers
var specialKeys = new Array();
specialKeys.push(8,46); //Backspace
function IsNumeric(e) {
    var keyCode = e.which ? e.which : e.keyCode;
    console.log( keyCode );
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;
}

//datepicker
$(function () {
    $('#invoiceDate').datepicker({});
});
//--></script>

<script src="<?php echo $base;?>view/javascript/jquery/jquery-ui.min.js"></script> 
</div>
<?php echo $footer; ?>