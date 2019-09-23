<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <?php if (!empty($image)) { ?>
        <img width=100% src="<?php echo $image; ?>" class="img-responsive" />
      <?php } ?>
      <h1><?php echo $heading_title; ?></h1>
      <?php echo $description; ?>
      <?php echo $gallery; ?>
      <div id="download"></div>
      <?php if ($tags) { ?>
      <p><?php echo $text_tags; ?>
        <?php for ($i = 0; $i < count($tags); $i++) { ?>
        <?php if ($i < (count($tags) - 1)) { ?>
        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
        <?php } else { ?>
        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
        <?php } ?>
        <?php } ?>
      </p>
      <?php } ?>
      <br>
      <!-- AddThis Button BEGIN -->
      <div class="addthis_toolbox addthis_default_style"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
      <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script> 
      <!-- AddThis Button END -->
      <?php if ($review_status) { ?>
      <br>
      <div class="rating">
        <p>
        <a style="cursor:pointer;" data-toggle="collapse" data-target="#tab-review"><span id="comment_number"><?php echo $comments; ?></span> <?php echo $text_comments; ?> / <?php echo $text_write; ?></a></p>
      </div>
        <div id="tab-review" class="collapse">
          <form class="form-horizontal">
            <div id="review"></div>
            <h2><?php echo $text_write; ?></h2>
            <?php if ($review_guest) { ?>
              <div class="form-group required">
                <div class="col-sm-12">
                  <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                  <input type="text" name="name" value="" id="input-name" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label" for="input-review"><?php echo $entry_review; ?></label>
                    <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                    <div class="help-block"><?php echo $text_note; ?></div>
                  </div>
                </div>
                <div class="form-group required">
                  <div class="col-sm-12">
                    <label class="control-label" for="input-captcha"><?php echo $entry_captcha; ?></label>
                    <input type="text" name="captcha" value="" id="input-captcha" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12"> <img src="index.php?route=tool/captcha" alt="" id="captcha" /> </div>
                </div>
                <div class="buttons">
                  <div class="pull-right">
                    <button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><?php echo $button_continue; ?></button>
                  </div>
                </div>
                <?php } else { ?>
                <?php echo $text_login; ?>
                <?php } ?>
              </form>
            </div>
            <?php } ?>
            <?php if ($informations) { ?>
              <h3><?php echo $text_related; ?></h3>
              <div class="row">
                <?php foreach ($informations as $information) { ?>
                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12'">
                  <div class="related-thumb">
                    <?php if ($information['thumb']) { ?>
                      <a href="<?php echo $information['href']; ?>"><img src="<?php echo $information['thumb']; ?>" alt="<?php echo $information['name']; ?>" title="<?php echo $information['name']; ?>" class="img-responsive" /></a>
                    <?php } ?>
                    <div class="caption">
                      <h4><a href="<?php echo $information['href']; ?>"><?php echo $information['name']; ?></a></h4>
                      <p><?php echo $information['description']; ?></p>
                    </div>
                  </div>
                 </div>
                <?php } ?>
              </div>
            <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
<script type="text/javascript"><!--

var comment_number = <?php echo $comments; ?>;

$('#review').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();

    $('#review').hide();

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
});

$('#review').load('index.php?route=information/information/review&information_id=<?php echo $information_id; ?>');

$('#button-review').on('click', function() {
	$.ajax({
		url: 'index.php?route=information/information/write&information_id=<?php echo $information_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('#button-review').button('loading');
		},
		complete: function() {
			$('#button-review').button('reset');
			$('#captcha').attr('src', 'index.php?route=tool/captcha#'+new Date().getTime());
			$('input[name=\'captcha\']').val('');
		},
		success: function(json) {
			$('.alert-success, .alert-danger').remove();
			
			if (json['error']) {
				$('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}
			
			if (json['success']) {
				$('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
        
				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').prop('checked', false);
				$('input[name=\'captcha\']').val('');
        
        <?php if ($comment_auto_approve) { ?>
          $('#review').load('index.php?route=information/information/review&information_id=<?php echo $information_id; ?>');
          comment_number++;
          $('#comment_number').text(comment_number.toString());          
        <?php } ?>
			}
		}
	});
});

$('#download').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();

    $('#download').hide();

    $('#download').load(this.href);

    $('#download').fadeIn('slow');
});

$('#download').load('index.php?route=information/information/downloads&information_id=<?php echo $information_id; ?>');

//--></script>
</div>
<?php echo $footer; ?> 