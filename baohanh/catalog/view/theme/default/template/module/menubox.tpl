<div class="col-md-3">
<div id="menubox<?php echo $module; ?>">
  <?php foreach ($menuboxs as $menubox) { ?>
  <div class="menubox_item">
    <?php if ($menubox['link']) { ?>
    <a href="<?php echo $menubox['link']; ?>"><img src="<?php echo $menubox['image']; ?>" alt="<?php echo $menubox['title']; ?>" class="img-responsive" /></a>
    <?php } else { ?>
    <img src="<?php echo $menubox['image']; ?>" alt="<?php echo $menubox['title']; ?>" class="img-responsive" />
    <?php } ?>
  </div>
  <?php } ?>
</div>
</div>
