<?php echo $header; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-manufacturer" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>"  class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-manufacturer" class="form-horizontal">
          <div class="tab-content">
            <div class="tab-pane active in" id="tab-general">
              <div class="tab-content">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-manufacturer-name"><?php echo $entry_manufacturer_name; ?></label>
                    <div class="col-sm-10">
                       <input type="text" name="manufacturer_name" value="<?php echo $manufacturer_name; ?>" placeholder="<?php echo $entry_manufacturer_name; ?>" id="input-manufacturer-name" class="form-control" />
					  <?php if ($error_manufacturer_name) { ?>
					  <div class="text-danger"><?php echo $error_manufacturer_name; ?></div>
					  <?php } ?>
                    </div>
                  </div>
				   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>
                <div class="col-sm-10">
                  <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                </div>
                 </div>
				  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-website"><?php echo $entry_website; ?></label>
                    <div class="col-sm-10">
                       <input type="text" name="website" value="<?php echo $website; ?>" placeholder="<?php echo $entry_website; ?>" id="input-website" class="form-control" />
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
            
			
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
<?php echo $footer; ?>