<?php echo $header; ?><?php //echo $column_left; ?>
<div id="content">
<div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $insert; ?>" data-toggle="tooltip" title="" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onClick="confirm('<?php echo $text_confirm; ?>') ? $('#form-magazine').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
         
    </div>
  </div>
  <div class="container-fluid">
   <?php if ($success_delete) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success_delete; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i><?php echo $text_list; ?></h3>
      </div>
  <div class="panel-body">
  <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-magazine">
   <div class="table-responsive">
     <table class="table table-bordered table-hover" id="dynamic-table">
              <thead>
                <tr>
                <td style="width: 1px;" class="text-center"><input type="checkbox" onClick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                <td class="text-left"><?php echo $text_title ;?></td>
                <td class="text-right"><?php echo $text_action ; ?></td>
                </tr>
              </thead>
              <tbody>
               <?php foreach ($magazine as $row) { ?>
               <tr>
                <td class="text-center"><?php if (in_array($row['magazine_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $row['magazine_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $row['magazine_id']; ?>" />
                    <?php } ?></td>  
                <td class="text-left"><?php echo $row['title'] ;?></td>  
                <td class="text-right"><a href="<?php echo $row['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                </td>
                 
               </tr>
               <?php } ;?>
              </tbody>
            </table>
          </div>
  
  
  </form>
  
  
  </div>
  </div>
  </div>


</div>

<?php echo $footer; ?>

<script>
	$(document).ready(function() {
		 $('#dynamic-table').dataTable();
		 
	});
</script>