<?php if ( has_nav_menu( 'top_left' ) || has_nav_menu('top_right') ) { ?>

<!-- ========== Header ========== -->

<div class="header">

    <div class="container">
        <div class="row">
            <div class="col-sm-6 header-left">
                <?php if ( has_nav_menu( 'top_left' ) ) { ?>
                <?php wp_nav_menu( array( 'theme_location' => 'top_left', 'depth' => 1, 'container' => '', 'menu_class' => 'top-menu' ) ); ?>
                <?php } ?>
            </div>
                               
            <div class="col-sm-6 header-right">
                <?php if ( has_nav_menu( 'top_right' ) ) { ?>
                <?php wp_nav_menu( array( 'theme_location' => 'top_right', 'depth' => 1, 'container' => '', 'menu_class' => 'social-menu top-menu' ) ); ?>
                <?php } ?>
            </div>
            
        </div>
    </div>
  
</div>
<div class="header-toggle"><i class="fa fa-angle-down"></i></div>
<!-- ========== /Header ========= -->

<?php } ?>
