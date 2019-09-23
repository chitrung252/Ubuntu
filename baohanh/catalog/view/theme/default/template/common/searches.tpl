<?php echo $header; ?>
<div class="container">
  <div class="row col-md-9">
      <div class="search_ketqua"><i class="fa fa-info-circle"></i>&nbsp;<?php echo $text_search; ?></div>
      <?php if ($items) { ?>
      <br />
      <div class="info-pintstyle"> 
        <?php foreach ($items as $item) { ?>  

          <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
	<div class="profile-info-name">Mã đơn hàng: </div>
		<div class="profile-info-value">
		<span class="editable editable-click" id="city">#<?php echo $item['order_id'] ;?></span>
     </div>
  </div>
 <div class="profile-info-row">
	<div class="profile-info-name">Khách hàng: </div>
		<div class="profile-info-value">
		<span class="editable editable-click" id="city"><?php echo $item['customer_name'] ;?></span>
     </div>
  </div>
 <div class="profile-info-row">
	<div class="profile-info-name">Địa chỉ:</div>
		<div class="profile-info-value">
		<span class="editable editable-click" id="city"><?php echo $item['address'] ;?></span>
     </div>
  </div>
 <div class="profile-info-row">
	<div class="profile-info-name">Số điện thoại:</div>
		<div class="profile-info-value">
		<span class="editable editable-click" id="city"><?php echo substr(($item['telephone']), 0, 3) ;?>*****<?php echo substr(($item['telephone']), 8, 2) ;?></span>
     </div>
  </div>
 <div class="profile-info-row">
	<div class="profile-info-name">Sản phẩm:</div>
		<div class="profile-info-value">
		<span class="editable editable-click" id="city"><?php echo $item['name_product'] ;?></span>
     </div>
  </div>
 <div class="profile-info-row">
	<div class="profile-info-name">Số lượng: </div>
		<div class="profile-info-value">
		<span class="editable editable-click" id="city"><?php echo $item['quantity_order'] ;?></span>
     </div>
  </div>
   <div class="profile-info-row">
	<div class="profile-info-name">Ngày đặt mua</div>
		<div class="profile-info-value">
		<span class="editable editable-click" id="city"><?php echo $item['date_added'] ;?></span>
     </div>
  </div>
  <div class="profile-info-row">
	<div class="profile-info-name">Thời gian bảo hành: </div>
		<div class="profile-info-value">
		<span class="editable editable-click" id="city"><?php echo $item['guarantee'] ;?></span>
     </div>
  </div> 
  <div class="profile-info-row">
	<div class="profile-info-name">Mã Imei: </div>
		<div class="profile-info-value">
		<span class="editable editable-click" id="city"><?php echo $item['imei'] ;?></span>
     </div>
  </div>
 
  <div class="profile-info-row">
	<div class="profile-info-name">Website mua hàng: </div>
		<div class="profile-info-value">
		<span class="editable editable-click" id="city"><?php echo $item['website'] ;?></span>
     </div>
  </div>
  	</div> <br/>         
        <?php } ?>
      </div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>

</div>
</div>
</div>
<script type="text/javascript"><!--
$('#button-search').bind('click', function() {
	url = 'index.php?route=common/searches';
	
	var search = $('#content input[name=\'search\']').prop('value');
	
	if (search) {
		url += '&search=' + encodeURIComponent(search);
	}

	location = url;
});

$('#content input[name=\'search\']').bind('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

--></script>
<br/>
<?php echo $footer; ?> 
