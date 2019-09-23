<?php echo $header; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-customer" class="btn btn-primary"><i class="lib-fa fa fa-save"></i>Lưu lại</button>
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
        <h3 class="panel-title dashboardform"><i class="fa fa-user-circle-o"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-customer" class="form-horizontal">
          <div class="tab-content">
            <div class="tab-pane active in" id="tab-general">
              <div class="tab-content">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-customer-name"><?php echo $entry_customer_name; ?></label>
                    <div class="col-sm-10">
                       <input type="text" name="customer_name" value="<?php echo $customer_name; ?>" placeholder="<?php echo $entry_customer_name; ?>" id="input-customer-name" class="form-control" />
					  <?php if ($error_customer_name) { ?>
					  <div class="text-danger"><?php echo $error_customer_name; ?></div>
					  <?php } ?>
                    </div>
                  </div>
				  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-address"><?php echo $entry_address; ?></label>
                     <div class="col-sm-10">
                      <input type="text" name="address" value="<?php echo $address ; ?>" placeholder="<?php echo $entry_address; ?>" id="input-address" class="form-control" />
                    </div>
               </div>
			   <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
                     <div class="col-sm-10">
                      <input type="text" name="telephone" value="<?php echo $telephone ; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" />
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