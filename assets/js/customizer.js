/**
 * Customizer helper file
 * 
 * @package Mathomo
 */

;(function($){
    // Update the site title
    wp.customize(
        'blogname', function ( value ) {
            value.bind(
                function ( newval ) {
                    $('.site-header .site-name a').html(newval);
                } 
            );
        } 
    );
    
    //Update the site description
    wp.customize(
        'blogdescription', function ( value ) {
            value.bind(
                function ( newval ) {
                    $('.site-header .site-description').html(newval);
                } 
            );
        } 
    );
    
    //Update copyright text
    wp.customize(
        'copyright_text', function ( value ) {
            value.bind(
                function ( newval ) {
                    $('.theme-credits-wrap .copyright-notice').html(newval);
                } 
            );
        } 
    );
})(jQuery);