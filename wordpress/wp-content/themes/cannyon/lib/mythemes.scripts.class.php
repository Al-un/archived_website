<?php
if( !class_exists( 'mythemes_scripts' ) ){

class mythemes_scripts
{
    static function frontend()
    {
        

        $oleo       = 'Oleo+Script+Swash+Caps:400,700&subset=latin,latin-ext';
        $montserrat = 'Montserrat:400,700';
        $open_sans  = 'Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,700,800,300&subset=latin,cyrillic-ext,latin-ext,cyrillic,greek-ext,greek,vietnamese';
        $patua_one  = 'Patua+One';
        $lato       = 'Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic&subset=latin,latin-ext';

        wp_register_style( 'mythemes-google-fonts',             'https://fonts.googleapis.com/css?family=' . esc_attr( $oleo ) . '|' . esc_attr( $patua_one ) . '|' . esc_attr( $lato ) . '|' . esc_attr( $montserrat ) . '|' . esc_attr( $open_sans ) );

        /* COMMON */
        wp_register_style( 'mythemes-icons',                    get_template_directory_uri() . '/media/css/icons.css' );

        /* FRONTEND */
        wp_register_style( 'mythemes-effects',                  get_template_directory_uri() . '/media/_frontend/css/effects.css' );
        wp_register_style( 'mythemes-header',                   get_template_directory_uri() . '/media/_frontend/css/header.css' );
        wp_register_style( 'mythemes-bootstrap',                get_template_directory_uri() . '/media/_frontend/css/bootstrap.min.css' );
        wp_register_style( 'mythemes-typography',               get_template_directory_uri() . '/media/_frontend/css/typography.css');
        wp_register_style( 'mythemes-navigation',               get_template_directory_uri() . '/media/_frontend/css/navigation.css' );
        wp_register_style( 'mythemes-nav',                      get_template_directory_uri() . '/media/_frontend/css/nav.css' );
        wp_register_style( 'mythemes-jscrollpane',              get_template_directory_uri() . '/media/_frontend/css/jquery.jscrollpane.css' );
        wp_register_style( 'mythemes-blog',                     get_template_directory_uri() . '/media/_frontend/css/blog.css' );
        wp_register_style( 'mythemes-forms',                    get_template_directory_uri() . '/media/_frontend/css/forms.css' );
        wp_register_style( 'mythemes-elements',                 get_template_directory_uri() . '/media/_frontend/css/elements.css' );
        wp_register_style( 'mythemes-widgets',                  get_template_directory_uri() . '/media/_frontend/css/widgets.css' );
        wp_register_style( 'mythemes-comments',                 get_template_directory_uri() . '/media/_frontend/css/comments.css' );
        wp_register_style( 'mythemes-comments-typography',      get_template_directory_uri() . '/media/_frontend/css/comments-typography.css' );
        wp_register_style( 'mythemes-footer',                   get_template_directory_uri() . '/media/_frontend/css/footer.css' );
        wp_register_style( 'mythemes-pretty-photo',             get_template_directory_uri() . '/media/_frontend/css/prettyPhoto.css' );
        wp_register_style( 'mythemes-plugins',                  get_template_directory_uri() . '/media/_frontend/css/plugins.css' );

        $dependency = array( 
            'mythemes-google-fonts', 
            'mythemes-icons', 
            'mythemes-effects', 
            'mythemes-header',
            'mythemes-bootstrap',
            'mythemes-typography',
            'mythemes-navigation',
            'mythemes-nav',
            'mythemes-blog',
            'mythemes-forms',
            'mythemes-elements',
            'mythemes-widgets',
            'mythemes-comments',
            'mythemes-comments-typography',
            'mythemes-footer',
            'mythemes-pretty-photo',
            'mythemes-plugins',
        );

        /* MAIN STYLE */
        wp_enqueue_style( 'mythemes-style', get_stylesheet_directory_uri() . '/style.css', $dependency );

        /* REGISTER SCRIPTS */
        wp_register_script( 'mythemes-bootstrap',                get_template_directory_uri() . '/media/_frontend/js/bootstrap.min.js', array( 'jquery' ), null, true );
        wp_register_script( 'mythemes-mousewheel',              get_template_directory_uri() . '/media/_frontend/js/jquery.mousewheel.js' , null, null, true );
        wp_register_script( 'mythemes-jscrollpane',             get_template_directory_uri() . '/media/_frontend/js/jquery.jscrollpane.min.js' , array( 'mythemes-mousewheel' ) , null , true );

        wp_register_script( 'mythemes-functions',                get_template_directory_uri() . '/media/_frontend/js/functions.js', array( 'masonry' ) , null, true );
        
        wp_register_script( 'mythemes-pretty-photo',             get_template_directory_uri() . '/media/_frontend/js/jquery.prettyPhoto.js', null, null, true );
        wp_register_script( 'mythemes-pretty-photo-settings',    get_template_directory_uri() . '/media/_frontend/js/jquery.prettyPhoto.settings.js', null, null, true );

        wp_enqueue_script( 'mythemes-bootstrap' );
        wp_enqueue_script( 'mythemes-jscrollpane' );
        wp_enqueue_script( 'mythemes-functions' );
        wp_enqueue_script( 'mythemes-pretty-photo' );
        wp_enqueue_script( 'mythemes-pretty-photo-settings' );

        /* INCLUDE FOR REPLY COMMENTS */
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
                wp_enqueue_script( 'comment-reply' );
    }

    static function backend()
    {
        if( isset( $_GET[ 'page' ] ) )
            wp_enqueue_media();

        wp_enqueue_style( 'wp-color-picker' );

        wp_enqueue_style( 'farbtastic' );
        wp_enqueue_style( 'ui-lightness' );
        wp_enqueue_style( 'thickbox' );

        wp_register_script( 'mythemes-_backend-ahtml',                   get_template_directory_uri() . '/media/_backend/js/ahtml.js' , array( 'jquery' , 'wp-color-picker' ) );
        wp_enqueue_script( 'mythemes-_backend-ahtml' );

        wp_register_style( 'mythemes-_backend-customizer',               get_template_directory_uri() . '/media/_backend/css/customizer.css' );
        wp_register_style( 'mythemes-_backend-options',                  get_template_directory_uri() . '/media/_backend/css/options.css' );
        wp_register_style( 'mythemes-_backend-boxes',                    get_template_directory_uri() . '/media/_backend/css/boxes.css' );
        wp_register_style( 'mythemes-_backend-ahtml',                    get_template_directory_uri() . '/media/_backend/css/ahtml.css' );
        wp_register_style( 'mythemes-_backend-adds',                     get_template_directory_uri() . '/media/_backend/css/adds.css' );

        wp_enqueue_style( 'mythemes-_backend-customizer' );
        wp_enqueue_style( 'mythemes-_backend-options' );
        wp_enqueue_style( 'mythemes-_backend-boxes' );
        wp_enqueue_style( 'mythemes-_backend-ahtml' );
        wp_enqueue_style( 'mythemes-_backend-adds' );
        wp_enqueue_style( 'mythemes-icons' );
    }
}

}   /* END IF CLASS EXISTS */
?>