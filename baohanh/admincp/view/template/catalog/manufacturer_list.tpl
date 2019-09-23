<?php echo $header; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" class="btn btn-primary"><i class="lib-fa fa fa-plus"></i>Thêm mới</a> 
        <button type="button" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-manufacturer').submit() : false;"><i class="lib-fa fa fa-trash-o"></i>Xóa</button>
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
   <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-manufacturer">
     <table id="table_manufacturer" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
			    <th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
                <th><?php echo $column_name ;?></th>
				 <th><?php echo $column_website ;?></th>
				<th class="no-sort"><?php echo $column_action ;?></th>

            </tr>
        </thead>
        <tbody>
		<?php if ($manufacturers) { ?>
             <?php foreach ($manufacturers as $manufacturer) { ?>
            <tr>
			   <td class="text-center"><?php if (in_array($manufacturer['manufacturer_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $manufacturer['manufacturer_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $manufacturer['manufacturer_id']; ?>" />
                    <?php } ?></td>
                <td><?php echo $manufacturer['manufacturer_name']; ?></td> 
				 <td><?php echo $manufacturer['website']; ?></td> 
				 <td class="text-right"><a href="<?php echo $manufacturer['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
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

  </div>
</div>

<?php echo $footer; ?>