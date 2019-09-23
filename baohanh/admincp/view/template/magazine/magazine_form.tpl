<?php echo $header; ?><?php //echo $column_left; ?>
<div id="content">
<!-- begin head -->
<div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-information" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary" id="validateBtn"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
       
    </div>
  </div>
<!-- begin contain -->
<div class="container-fluid">
<div class="panel panel-default">
        <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
        </div>
  <div class="panel-body">
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-magazine" class="form-horizontal">
   <div class="tab-content">
   
       <div class="form-group required">
        <label class="col-sm-2 control-label"><?php echo $entry_title; ?></label>
        <div class="col-sm-8">
         <input type="text" name="title" value="" placeholder="" id="input-title" class="form-control" />
         <?php if ($error_title) { ?>
              <div class="text-danger"><?php echo $error_title; ?></div>
              <?php } ?>
        </div>
        </div>
        <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo $entry_keyword; ?></label>
        <div class="col-sm-8">
         <input type="text" name="keyword" value="" placeholder="" id="keyword" class="form-control"/>
        </div>
        </div>
        
         <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo $entry_publish; ?></label>
        <div class="col-sm-8">
         <input type="text" name="publish" value="" placeholder="" id="input-title" class="form-control" />
        </div>
        </div>
         <div class="form-group">
    <label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
    <div class="col-sm-10">
    <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
    <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
    </div>
    </div>
    
<div class="form-group">
     <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
      <div class="col-sm-10">
      <input type="text" name="sort_order" value="" placeholder="" id="input-sort-order" class="form-control" />
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

   </div>
  </form>
  </div>      
</div>
</div>
</div>
<?php echo $footer; ?>
