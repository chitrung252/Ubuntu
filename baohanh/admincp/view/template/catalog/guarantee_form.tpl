<?php echo $header; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-guarantee" class="btn btn-primary"><i class="lib-fa fa fa-save"></i>Lưu lại</button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-guarantee" class="form-horizontal">
          <div class="tab-content">
            <div class="tab-pane active in" id="tab-general">
              <div class="tab-content">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-guarantee-name"><?php echo $entry_guarantee_name; ?></label>
                    <div class="col-sm-10">
                       <input type="text" name="guarantee_name" value="<?php echo $guarantee_name; ?>" placeholder="<?php echo $entry_guarantee_name; ?>" id="input-guarantee-name" class="form-control" />
					  <?php if ($error_guarantee_name) { ?>
					  <div class="text-danger"><?php echo $error_guarantee_name; ?></div>
					  <?php } ?>
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