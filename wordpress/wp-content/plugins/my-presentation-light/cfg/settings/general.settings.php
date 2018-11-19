<?php

$sett = array();

$layouts = mythemes_plg_core::getLayouts();

if( !empty( $layouts ) ){
    foreach( $layouts as $key => &$d )
        $l[ $d[ 'id' ]  ] = $d[ 'title' ];
}
if( empty( $l ) ){
    
    $sett[ 'layout' ] = array(
        'type' => array(
            'field' => 'none',
            'validator' => 'noneValidator'
        ),
        'content' => '<p><span style="color: #990000">' . __( 'There are no layouts. To create a new layout see section "Layout Builder"' , 'myThemes' ) . '</span></p><br>'
    );
}
else{
    $sett[ 'layout' ] = array(
        'type' => array(
            'field' => 'inline',
            'input' => 'select'
        ),
        'values' => $l,
        'label' => __( 'Default Layout for Tooltips' , 'myThemes' )
    );
}

$sett[ 'width' ] = array(
    'type' => array(
        'field' => 'inline',
        'input' => 'text'
    ),
    'label' => __( 'Default Tooltip Width ( px )' , 'myThemes' )
);
$sett[ 'use-storage' ] = array(
    'type' => array(
        'field' => 'inline',
        'input' => 'logic'
    ),
    'label' => __( 'Use Storage' , 'myThemes' )
);

$sett[ 'title' ] = array(
    'type' => array( 
        'field' => 'none',
    ),
    'content' => '<br/><h3>' . __( 'Keyboard Navigation' , 'myThemes' ) . '</h3><hr>'
);

$sett[ 'message' ] = array(
    'type' => array(
        'field' => 'none'
    ),
    'content' => '<br><div class="mythemes-plg-message"><p><strong>Keyboard Navigation</strong> is available only in <a href="http://codecanyon.net/item/my-presentation/6051397?ref=mythem_es">Premium Version</a></p></div>'
);

$pages = mythemes_plg_cfg::get_pages();
$pages[ 'mythemes-plg-general' ][ 'content' ] = $sett;
mythemes_plg_cfg::set_pages( $pages );
?>