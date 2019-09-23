<div id="information_slideshow<?php echo $module; ?>" class="owl-carousel" style="opacity: 1;">
  <?php foreach ($items as $item) { ?>
  <div class="item"><?php echo $item['description']; ?></div>
  <?php } ?>
</div>
<script type="text/javascript"><!--
$('#information_slideshow<?php echo $module; ?>').owlCarousel({
	items: 6,
	autoPlay: <?php echo $time; ?>,
	singleItem: true,
	navigation: true,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	pagination: false
});
--></script>