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
      <h2><?php echo $heading_title; ?></h2>
      <?php if ($thumb || $description) { ?>
      <div class="row">
        <?php if ($thumb) { ?>
        <div class="col-sm-2"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-thumbnail" /></div>
        <?php } ?>
        <?php if ($description) { ?>
        <div class="col-sm-10"><?php echo $description; ?></div>
        <?php } ?>
      </div>
      <hr>
      <?php } ?>
      <?php if ($categories) { ?>
      <h3><?php echo $text_refine; ?></h3>
      <?php if (count($categories) <= 5) { ?>
      <div class="row">
        <div class="col-sm-3">
          <ul>
            <?php foreach ($categories as $category) { ?>
            <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <?php } else { ?>
      <div class="row">
        <?php foreach (array_chunk($categories, ceil(count($categories) / 4)) as $categories) { ?>
        <div class="col-sm-3">
          <ul>
            <?php foreach ($categories as $category) { ?>
            <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
            <?php } ?>
          </ul>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
      <?php } ?>
      <?php if ($informations) { ?>
      <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-2 text-right">
          <label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
        </div>
        <div class="col-md-3 text-right">
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
        <div class="col-md-1 text-right">
          <label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
        </div>
        <div class="col-md-2 text-right">
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
      <?php if ($simple_items) { ?>
        <div class="row">
          <?php foreach ($informations as $information) { ?>
            <font size="+1"><a href="<?php echo $information['href']; ?>"><?php echo $information['name']; ?></a></font><br>
          <?php } ?>
        </div>
      <?php } else { ?>
        <div class="info-pintstyle">
          <?php foreach ($informations as $information) { ?>
            <div class="product-thumb">
              <?php if (($information['thumb'] && empty($information['downloads'])) || ($information['thumb'] && !empty($information['downloads']) && ($show_downloads != 1))) { ?>
                <div class="image"><a href="<?php echo $information['href']; ?>"><img src="<?php echo $information['thumb']; ?>" alt="<?php echo $information['name']; ?>" title="<?php echo $information['name']; ?>" class="img-responsive" /></a></div>
              <?php } ?>
                <div class="caption">
                  <?php if ($show_item_date) { ?>
                    <div class="date"><?php echo $information['date_added']; ?></div>
                  <?php } ?>
                  <h4><a href="<?php echo $information['href']; ?>"><?php echo $information['name']; ?></a></h4>
                  <?php if (empty($information['downloads']) || (!empty($information['downloads']) && ($show_downloads != 1))) { ?>
                    <p><?php echo $information['description']; ?></p>
                  <?php } ?>
                  <?php if (!empty($information['downloads'])) { ?>
                  <?php foreach ($information['downloads'] as $download) { ?>
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
      <?php } ?>
      <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
      </div>
      <?php } ?>
      <?php if (!$categories && !$informations) { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php if (!$simple_items) { ?>
<script>
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

</script>
<?php } ?>
<?php echo $footer; ?>