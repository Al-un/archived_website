<?php

$posts = array();

$posts[ 'presentation' ] = array(
    'singularTitle' => __( 'Presentation' , 'myThemes' ),
    'pluralTitle' => __( 'Presentations' , 'myThemes' ),
    'fields' => array(
        'title'
    ),
    'menu_icon' => MYTHEMES_PLG_URL . '/media/admin/images/mythemes-plg-presentation.png'
);

mythemes_plg_cfg::set_posts( $posts );
?>