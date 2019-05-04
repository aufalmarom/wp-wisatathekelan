<?php
/**
 * The template for displaying the search form
 *
 * @package vega
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'vega' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'placeholder', 'vega' ) ?>"  />
    <button class="btn btn-primary-custom" name="submit" type="submit"><i class="glyphicon glyphicon-arrow-right"></i></button>
</form>