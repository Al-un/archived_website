<?php
    $bg_color       = esc_attr( '#' . get_background_color() );
    $hd_bkg_color   = esc_attr( get_theme_mod( 'header-background-color', '#343b43' ) );
    $bkg            = esc_url( get_theme_mod( 'background_image' ) );
?>

<style type="text/css">

    /* HEADER */
    body{
        background-color: <?php echo esc_attr( $hd_bkg_color ); ?>;
    }

    /* BACKGROUND IMAGE */
    body > div.content{

    <?php
        if( !empty( $bkg ) ){
    ?>
            background-image: url(<?php echo $bkg; ?>);
            background-repeat: <?php echo esc_attr( get_theme_mod( 'background_repeat' , 'repeat' ) ); ?>;
            background-position: <?php echo esc_attr( get_theme_mod( 'background_position_x' , 'center' ) ); ?>;
            background-attachment: <?php echo esc_attr( get_theme_mod( 'background_attachment' , 'scroll' ) ); ?>;
    <?php
        }
    ?>
    }

    /* BREADCRUMBS */
    div.mythemes-page-header{
        padding-top: <?php echo absint( get_theme_mod( 'mythemes-breadcrumbs-space', 60 ) ); ?>px;
        padding-bottom: <?php echo absint( get_theme_mod( 'mythemes-breadcrumbs-space', 60 ) ); ?>px;
    }

</style>

<style type="text/css" id="mythemes-custom-style-background">

    /* BACKGROUND COLOR */
    body > div.content{
        background-color: <?php echo $bg_color; ?>;
    }

</style>

<style type="text/css" id="mythemes-custom-css">

    <?php
        echo mythemes_validate_css( get_theme_mod( 'mythemes-custom-css' ) );
    ?>

</style>