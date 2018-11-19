<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        
        <header>

            <div class="mythemes-topper">
                <div class="container">

                    <div class="row">
                        <div class="mythemes-header-antet" >

                            <?php global $wp_customize; ?>

                            <!-- COLLAPSE BUTTON -->
                            <button type="button" class="btn-collapse"><i class="icon-plus-2"></i></button>

                            <!-- LOGO / TITLE / DESCRIPTION -->
                            <?php
                                $blog_title                     = esc_attr( get_bloginfo( 'name' ) );
                                $blog_description               = esc_attr( get_bloginfo( 'description' ) );

                                $mythemes_text                  = true;
                                $mythemes_text_class            = '';

                                /* HEADER CUSTOMIZER */
                                if( isset( $wp_customize ) ) {

                                    /* HEADER LOGO */
                                    $mythemes_logo              = true;
                                    $mythemes_logo_src          = esc_url( get_theme_mod( 'mythemes-logo' , get_template_directory_uri() . '/media/_frontend/img/logo.png' ) );
                                    $mythemes_logo_class        = empty( $mythemes_logo_src ) ? 'hidden' : '';

                                    /* HEADER TEXT */
                                    $mythemes_text_class        = !empty( $mythemes_logo_src ) ? 'hidden' : '';
                                }

                                /* HEADER FRONTEND */
                                else{

                                    /* HEADER LOGO */
                                    $mythemes_logo_src          = esc_url( get_theme_mod( 'mythemes-logo' , get_template_directory_uri() . '/media/_frontend/img/logo.png' ) );
                                    $mythemes_logo              = !empty( $mythemes_logo_src );
                                    $mythemes_logo_class        = '';

                                    if( $mythemes_logo_src ){
                                        $mythemes_text          = false;
                                    }
                                }

                                echo '<div class="overflow-wrapper">';
                                echo '<div class="valign-cell-wrapper left">';
                                echo '<div class="valign-cell">';

                                /* BRANDING  */
                                if( $mythemes_logo ){
                                    echo '<a class="mythemes-logo ' . esc_attr( $mythemes_logo_class ) . '" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( $blog_title . ' - ' . $blog_description ) . '">';
                                    echo '<img src="' . esc_url( $mythemes_logo_src ) . '" title="' . esc_attr( $blog_title . ' - ' . $blog_description ) . '"/>';
                                    echo '</a>';
                                }

                                /* BLOG TITLE */
                                if( $mythemes_text ){
                                    echo '<a class="mythemes-blog-title ' . esc_attr( $mythemes_text_class ) . '" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( $blog_title . ' - ' . $blog_description ) . '">';
                                    bloginfo( 'name' );
                                    echo '</a>';
                                }

                                /* BLOG DESCRIPTION */
                                if( $mythemes_text ){
                                    echo '<a class="mythemes-blog-description ' . esc_attr( $mythemes_text_class ) . '" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( $blog_title . ' - ' . $blog_description ) . '">';
                                    bloginfo( 'description' );
                                    echo '</a>';
                                }

                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            ?>
                        </div>

                        <div class="mythemes-header-menu">
                            <!-- TOPPER MENU -->
                            <nav class="mythemes-nav-inline base-nav header-nav nav-collapse">

                                <div class="nav-pre-wrapper">
                                    <button type="button" class="btn-collapse"><i class="icon-cancel-2"></i></button>

                                    <?php
                                        $args = array(
                                            'theme_location'    => 'header',
                                            'container_class'   => 'nav-wrapper',
                                            'menu_class'        => 'mythemes-menu'
                                        );
                                        
                                        $location = get_nav_menu_locations();

                                        if( isset( $location[ 'header' ] ) && $location[ 'header' ] > 0 ){
                                            wp_nav_menu( $args );
                                        }else{
                                            $pages = get_posts( array(
                                                'numberposts' => 7,
                                                'post_type' => 'page',
                                                'order' => 'ASC'
                                            ));
                                            
                                            if( !empty( $pages ) ){
                                                echo '<div class="nav-wrapper">';
                                                echo '<ul class="mythemes-menu">';

                                                foreach( $pages as $p => $item ){
                                                    $classes = '';
                                                    if( is_page( $item -> ID ) )
                                                        $classes = 'current-menu-item';
                                                        
                                                    echo '<li class="menu-item ' . $classes . '">';
                                                    echo '<a href="' . esc_url( get_permalink( $item -> ID ) ) . '" title="' . esc_attr( mythemes_post::title( $item -> ID, true ) ) . '">' . mythemes_post::title( $item -> ID ) . '</a></li>';
                                                }
                                                echo '</ul>';
                                                echo '</div>';
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="visible-nav"></div>
                            </nav>
                            <div class="dark-mask"></div>
                        </div>

                    </div>

                </div>
            </div>

            <?php

                global $wp_customize, $mythemes_header_class;
                $show_header    = false;

                /* FRONT PAGE */
                $on_front_page          = get_theme_mod( 'mythemes-header-front-page', true );
                $is_enb_front_page      = get_option( 'show_on_front' ) == 'page';
                $is_front_page          = $is_enb_front_page && is_front_page();

                /* BLOG PAGE */
                $on_blog_page           = get_theme_mod( 'mythemes-header-blog-page', true );

                if( $is_enb_front_page ){
                    $is_blog_page = is_home();
                }
                else{
                    $is_blog_page = is_front_page();
                }

                if( $is_front_page && $on_front_page ){
                    $show_header = true;
                    $mythemes_header_class = 'on-front-page';
                }
                else if( $is_front_page && !$on_front_page ){
                    $show_header = false;
                    $mythemes_header_class = 'on-front-page';   
                }
                else if( $is_blog_page && $on_blog_page ){
                    $show_header = true;
                    $mythemes_header_class = 'on-blog-page';
                }
                else if( $is_blog_page && !$on_blog_page ){
                    $show_header = false;
                    $mythemes_header_class = 'on-blog-page';
                }
                else if( is_singular( 'post' ) ){
                    $show_header = get_theme_mod( 'mythemes-header-single-posts', true );
                    $mythemes_header_class = 'on-single-posts';
                }
                else if( is_singular( 'page' ) && ! $is_front_page ){
                    $show_header = get_theme_mod( 'mythemes-header-single-pages', true );
                    $mythemes_header_class = 'on-single-pages';
                }
                else{
                    $show_header = get_theme_mod( 'mythemes-header-templates', true );
                    $mythemes_header_class = 'on-templates';
                }

                /* CUSTOMIZER */
                if( isset( $wp_customize ) ) {
                    if( !$show_header ){
                        $mythemes_header_class .= ' hidden';
                        $show_header = true;
                    }
                }

                if( $show_header ){
                    get_template_part( 'templates/header' );
                }
            ?>

        </header>