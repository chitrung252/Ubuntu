<?php echo $header; ?><?php //echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
      <button type="submit" form="form-information" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
      <button type="button" form="form-backup" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-exchange"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-backup" class="form-horizontal">
         
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_backup; ?></label>
            <div class="col-sm-10">
              <div class="well well-sm" style="height: 150px; overflow: auto;">
                <?php foreach ($tables as $table) { ?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="backup_tables[]" value="<?php echo $table; ?>" <?php echo in_array($table, $backup_configuration['backup_tables'])==true ? 'checked="checked"': '';?> />
                    <?php echo $table; ?></label>
                </div>
                <?php } ?>
              </div>
              <a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-bo"><?php echo $entry_backup_options; ?></label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <?php if ($backup_configuration['backup_options'] == 'email') { ?>
                    <input type="radio" name="backup_options" value="email" checked="checked" />
                    <?php echo $text_email_backup_to; ?>
                    <input type="text" name="backup_destination" value="<?php echo $backup_configuration['backup_destination'];?>" class="form-control" />
                  <?php } else { ?>
                    <input type="radio" name="backup_options" value="email" />
                    <?php echo $text_email_backup_to; ?>
                    <input type="text" name="backup_destination" value="" class="form-control" />
                  <?php } ?>
                </label>
                <br>
                <label class="radio-inline">
                  <?php if ($backup_configuration['backup_options'] == 'backup_to') { ?>
                    <input type="radio" name="backup_options" value="backup_to" checked="checked" />
                    <?php echo $text_save_to.$dir_backup;?>
                  <?php } else { ?>
                    <input type="radio" name="backup_options" value="backup_to" />
                    <?php echo $text_save_to.$dir_backup; ?>
                  <?php } ?>
                </label>
              </div>
            </div>
            
            
            <div class="form-group">
            <label class="col-sm-2 control-label" for="input-bo"><?php echo $entry_scheduled_backup; ?></label>
              <div class="col-sm-10">
                <strong><?php echo $text_next_backup_schedule; ?><?php echo $backup_configuration['backup_next_schedule'];?></strong><br /><br />
                <input type="radio" name="backup_schedule" value="never" <?php echo $backup_configuration['backup_schedule'] == 'never' ? 'checked="checked"' : ''; ?> /> <?php echo $text_never; ?> <br />
        		<input type="radio" name="backup_schedule" value="once_hourly" <?php echo $backup_configuration['backup_schedule'] == 'once_hourly' ? 'checked="checked"' : ''; ?>/> <?php echo $text_once_hourly; ?> <br />
        		<input type="radio" name="backup_schedule" value="twice_daily" <?php echo $backup_configuration['backup_schedule'] == 'twice_daily' ? 'checked="checked"' : ''; ?>/> <?php echo $text_twice_daily; ?> <br />
        		<input type="radio" name="backup_schedule" value="once_daily" <?php echo $backup_configuration['backup_schedule'] == 'once_daily' ? 'checked="checked"' : ''; ?>/> <?php echo $text_once_daily; ?> <br />
        		<input type="radio" name="backup_schedule" value="once_weekly" <?php echo $backup_configuration['backup_schedule'] == 'once_weekly' ? 'checked="checked"' : ''; ?>/> <?php echo $text_once_weekly; ?> <br />
        		<input type="radio" name="backup_schedule" value="twice_a_month" <?php echo $backup_configuration['backup_schedule'] == 'twice_a_month' ? 'checked="checked"' : ''; ?>/> <?php echo $text_twice_a_month; ?> <br />
        		<input type="radio" name="backup_schedule" value="test_now" <?php echo $backup_configuration['backup_schedule'] == 'test_now' ? 'checked="checked"' : ''; ?>/> <?php echo $text_test; ?><br />
              </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-backup_enable"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="backup_enable" id="input-backup_enable" class="form-control">
                    <?php if ($backup_configuration['backup_enable']) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            
              
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>