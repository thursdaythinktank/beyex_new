<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package unikon
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php if (is_singular() && pings_open(get_queried_object())): ?>
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(' wpr-magic-cursor'); ?> id="body">

    <?php wp_body_open(); ?>


    <?php
    $unikon_preloader = get_theme_mod('unikon_preloader_switch', false);
    $unikon_preloader_loading_text = get_theme_mod('unikon_preloader_loading_text', __('Unikon', 'unikon'));

    $unikon_backtotop = get_theme_mod('unikon_backtotop_switch', false);

    ?>

    <?php if ($unikon_preloader): ?>

    <div class="preloader">
      <svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
        <path id="svg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
      </svg>
      <h5 class="preloader-text" style="--preloader-content:'<?php echo esc_html($unikon_preloader_loading_text); ?>'"><?php echo esc_html($unikon_preloader_loading_text); ?></h5>
    </div>


    <?php endif; ?>

    <?php if ($unikon_backtotop): ?>
    <!-- back to to button start-->
    <a href="#" id="scroll-top" class="back-to-top-btn">
      <i class="bi bi-arrow-up"></i>
    </a>
    <!-- back to to button end-->
    <?php endif; ?>



    <!-- header start -->
    <?php do_action('unikon_header_style'); ?>
    <!-- header end -->


    <?php do_action('unikon_before_main_content'); ?>