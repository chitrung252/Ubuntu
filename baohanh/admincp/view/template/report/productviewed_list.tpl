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
                 
				 <th>Tên sản phẩm</th>
				 <th>Thương hiệu</th>
                <th>Số lượng mua</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($productviewed as $row_productviewed) { ?>
            <tr>
				<td><?php echo $row_productviewed['name_product'] ;?></td>
				 <td><?php echo $row_productviewed['manufacturer'] ;?></td>
                <td><?php echo $row_productviewed['quantity_order'] ;?></td>
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