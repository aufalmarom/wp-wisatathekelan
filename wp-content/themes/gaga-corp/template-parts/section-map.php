<?php
/**
 * map Parallax Section
 */
$enable_map_section = get_theme_mod('gaga-corp-map_enable_disable');
if($enable_map_section){
$map_page_id = get_theme_mod('gaga-corp-map_page_select');
$map_page = get_page($map_page_id);
if ($map_page_id) {?>

    <div class="combine">
        <div class="combine_content wow fadeInUp">
            <div class="map-contents">
           <div class='embed-container maps'><?php
                echo $map_page->post_content; ?>
           </div>                
            </div>
            <style>
            .maps iframe{
                pointer-events: none;
            }
            
            </style>                       
        </div>
    </div>
<?php }} ?>