<div>
  <?php if (!empty($title)) { ?>
    <h2><?php echo $title; ?></h2>
  <?php } ?>
  <?php if (!empty($description)) echo $description; ?>
  <?php if (!empty($downloads)) { ?>
    <?php foreach ($downloads as $download) { ?>
      <p>
        <a href="<?php echo $download['href']; ?>" data-toggle="tooltip" title="<?php echo $button_download; ?>" class="btn btn-primary"><i class="fa fa-cloud-download"></i></a>
        <a href="<?php echo $download['href']; ?>"><?php echo $download['name']; ?></a><br>
      </p> 
    <?php } ?>
  <?php } ?>
</div>
