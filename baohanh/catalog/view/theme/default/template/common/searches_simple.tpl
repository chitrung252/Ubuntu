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
      <h1><?php echo $heading_title; ?></h1>
      <h2><?php echo $text_search; ?></h2>
      <?php if ($items) { ?>
      <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-1 col-sm-offset-2 text-right">
          <label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
        </div>
        <div class="col-sm-3 text-right">
          <select id="input-sort" class="form-control col-sm-3" onchange="location = this.value;">
            <?php foreach ($sorts as $sorts) { ?>
            <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
            <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
        <div class="col-sm-1 text-right">
          <label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
        </div>
        <div class="col-sm-2 text-right">
          <select id="input-limit" class="form-control" onchange="location = this.value;">
            <?php foreach ($limits as $limits) { ?>
            <?php if ($limits['value'] == $limit) { ?>
            <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
      <br />
      <div class="info-pintstyle"> 
        <?php foreach ($items as $item) { ?>  
          <div class="product-thumb">
            <?php if (isset($item['thumb'])) { ?>
              <div class="image"><a href="<?php echo $item['href']; ?>"><img src="<?php echo $item['thumb']; ?>" alt="<?php echo $item['name']; ?>" title="<?php echo $item['name']; ?>" class="img-responsive" /></a></div>
            <?php } ?>
            <div class="caption">
              <h4><a href="<?php echo $item['href']; ?>"><?php echo $item['name']; ?></a></h4>
              <p><?php echo $item['description']; ?></p>
            </div>
          </div>
        <?php } ?>
      </div>
      <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
      </div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?> 
<script type="text/javascript"><!--
$('#button-search').bind('click', function() {
	url = 'index.php?route=common/searches';
	
	var search = $('#content input[name=\'search\']').prop('value');
	
	if (search) {
		url += '&search=' + encodeURIComponent(search);
	}
  
  var type = $('#content select[name=\'type\']').prop('value');
	
	if (type) {
		url += '&type=' + encodeURIComponent(type);
	}

	location = url;
});

$('#content input[name=\'search\']').bind('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('select[name=\'type\']').on('change', function() {
	$('#button-search').click();
});

$(function(){
   
       var $container = $('.info-pintstyle');
     
       $container.imagesLoaded( function(){
         $container.masonry({
         });
       });
     
     });
     
     $(window).load(function() {

       if ($('.info-pintstyle').innerWidth() < 450) {
        $('.info-pintstyle > .product-thumb').width('90%');     
       }
       
       if (($('.info-pintstyle').innerWidth() > 450) && ($('.info-pintstyle').innerWidth() < 900)) {
        $('.info-pintstyle > .product-thumb').width('43%');     
       }
       
       if ($('.info-pintstyle').innerWidth() > 900) {
        $('.info-pintstyle > .product-thumb').width('29%');     
       }
     
     $( '.info-pintstyle' ).masonry();
     
    });

     $( window ).resize( function() {

       if ($('.info-pintstyle').innerWidth() < 450) {
        $('.info-pintstyle > .product-thumb').width('90%');     
       }
       
       if (($('.info-pintstyle').innerWidth() > 450) && ($('.info-pintstyle').innerWidth() < 900)) {
        $('.info-pintstyle > .product-thumb').width('43%');     
       }
       
       if ($('.info-pintstyle').innerWidth() > 900) {
        $('.info-pintstyle > .product-thumb').width('29%');     
       }
     
     $( '.info-pintstyle' ).masonry();
     
});

--></script>