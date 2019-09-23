<?php echo $header; ?><?php //echo $column_left; ?>
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
   <!-- begin table -->
   <table id="table_order" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                 <th class="text-center" style="width:100px;"><?php echo $column_stt ;?></th>
				 <th><?php echo $column_name ;?></th>
				 <th><?php echo $column_adress ;?></th>
                <th><?php echo $column_telephone ;?></th>
				

            </tr>
        </thead>
        <tbody>
        <?php foreach ($customers as $customer) { ?>
            <tr>
                <td class="text-center"><?php echo $customer['order_id'] ;?></td>
				<td><?php echo $customer['customer_name'] ;?></td>
				 <td><?php echo $customer['address'] ;?></td>
                <td><?php echo $customer['telephone'] ;?></td>
            </tr>
		 <?php } ?>
        </tbody>
    </table>
	<div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        </div>
  </div>
</div>
<?php echo $footer; ?>