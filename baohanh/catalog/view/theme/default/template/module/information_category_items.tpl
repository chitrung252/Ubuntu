<h3><?php echo $heading_title; ?></h3>
<a href="<?php echo $link; ?>"><?php echo $text_all_items; ?></a>
<?php if ($simple_items) { ?>
  <div class="row">
    <?php foreach ($items as $item) { ?>
      <font size="+1"><a href="<?php echo $item['href']; ?>"><?php echo $item['name']; ?></a></font><br>
    <?php } ?>
  </div>
<?php } else { ?>
  <div id="cont<?php echo $module; ?>">
    <?php foreach ($items as $item) { ?>
      <div class="product-thumb">
        <?php if (($item['thumb'] && empty($item['downloads'])) || ($item['thumb'] && !empty($item['downloads']) && ($show_downloads != 1))) { ?>
          <div class="image"><a href="<?php echo $item['href']; ?>"><img src="<?php echo $item['thumb']; ?>" alt="<?php echo $item['name']; ?>" title="<?php echo $item['name']; ?>" class="img-responsive" /></a></div>
        <?php } ?>
        <div class="caption">
          <?php if ($show_item_date) { ?>
            <div class="date"><?php echo $item['date_added']; ?></div>
          <?php } ?>
          <h4><a href="<?php echo $item['href']; ?>"><?php echo $item['name']; ?></a></h4>
          <?php if (empty($item['downloads']) || (!empty($item['downloads']) && ($show_downloads != 1))) { ?>
            <p><?php echo $item['description']; ?></p>
          <?php } ?>
          <?php if (!empty($item['downloads'])) { ?>
            <?php foreach ($item['downloads'] as $download) { ?>
              <p>
                <a href="<?php echo $download['href']; ?>" data-toggle="tooltip" title="<?php echo $button_download; ?>" class="btn btn-primary"><i class="fa fa-cloud-download"></i></a>
                <a href="<?php echo $download['href']; ?>"><?php echo $download['name']; ?></a><br>
              </p>
            <?php } ?>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>

<script>

$(function(){
  var $container = $('#cont<?php echo $module; ?>');
      
  $container.imagesLoaded( function(){
    $container.masonry({
    });
  });
});

$(window).load(function() {

  if ($('#cont<?php echo $module; ?>').innerWidth() < 450) {
    $('#cont<?php echo $module; ?> > .product-thumb').width('90%');     
  }
       
  if (($('#cont<?php echo $module; ?>').innerWidth() > 450) && ($('#cont<?php echo $module; ?>').innerWidth() < 900)) {
    $('#cont<?php echo $module; ?> > .product-thumb').width('43%');     
  }
       
  if ($('#cont<?php echo $module; ?>').innerWidth() > 900) {
    $('#cont<?php echo $module; ?> > .product-thumb').width('29%');     
  }
     
  $( '#cont<?php echo $module; ?>' ).masonry();

});

$( window ).resize( function() {

  if ($('#cont<?php echo $module; ?>').innerWidth() < 450) {
    $('#cont<?php echo $module; ?> > .product-thumb').width('90%');     
  }
       
  if (($('#cont<?php echo $module; ?>').innerWidth() > 450) && ($('#cont<?php echo $module; ?>').innerWidth() < 900)) {
    $('#cont<?php echo $module; ?> > .product-thumb').width('43%');     
  }
       
  if ($('#cont<?php echo $module; ?>').innerWidth() > 900) {
    $('#cont<?php echo $module; ?> > .product-thumb').width('29%');     
  }
     
  $( '#cont<?php echo $module; ?>' ).masonry();
     
});

</script>
<?php } ?>