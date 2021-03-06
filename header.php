<?php
/**
 * The header template
 * 
 * @package Mathomo
 */
 ?>
 <!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>  
</head>

<body <?php body_class(); ?>>

<?php

do_action('body_header_before');

?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'mathomo' ); ?></a>

<header>
    <div class="container">
        <div class="site-header-wrap ts-s-1 ts-ns-1-3 ts-s-align-center">
        <?php
            mathomo_print_site_header();
            
            mathomo_print_header_menu();
        ?>
        </div>
        <div class="mobile-drawer ts-ns-hidden">
        <?php
            mathomo_print_mobile_drawer();
        ?>
        </div>
    </div>
</header>
