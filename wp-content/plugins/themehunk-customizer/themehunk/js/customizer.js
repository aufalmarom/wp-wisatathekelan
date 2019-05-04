jQuery(document).ready(function() {

	  /* === Checkbox Multiple Control === */
    if (jQuery('.customize-control-checkbox-multiple').length) {
    jQuery( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on(
        'change',
        function() {
   // alert('');
            checkbox_values = jQuery( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
                function() {
                    return this.value;
                }
            ).get().join( ',' );

            jQuery( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
        }
    );
}
        // our service  widget
    wp.customize.section( 'sidebar-widgets-multi-service-widget' ).panel('services_panel');
    wp.customize.section( 'sidebar-widgets-multi-service-widget' ).priority('5');

        // team widget
    wp.customize.section( 'sidebar-widgets-multi-team-widget' ).panel('team_panel');
    wp.customize.section( 'sidebar-widgets-multi-team-widget' ).priority('5');

    // testimonial widget
    wp.customize.section( 'sidebar-widgets-testimonial-widget' ).panel('testimonial_panel');
    wp.customize.section( 'sidebar-widgets-testimonial-widget' ).priority('5');
});