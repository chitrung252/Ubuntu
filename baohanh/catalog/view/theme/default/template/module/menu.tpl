<nav class="navmenu navmenu-default" role="navigation">
  <ul class="nav navmenu-nav">
  
   <?php foreach ($menus as $menu) { ?>
     <?php if ($menu['children']) { ?>
        <li class="dropdown">
          <a href="<?php echo $menu['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $menu['name']; ?><b class="caret"></b></a>
          <ul class="dropdown-menu navmenu-nav" role="menu">
            <?php foreach ($menu['children'] as $child) { ?>
              <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>  
              
            <?php } ?>
          </ul>
        </li>
     <?php } else { ?>
        <li><a href="<?php echo $menu['href']; ?>"><?php echo $menu['name']; ?></a></li>
     <?php } ?>
   <?php } ?>

  </ul>
</nav>
