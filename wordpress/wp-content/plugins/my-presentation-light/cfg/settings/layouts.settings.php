<?php
$sett = array();

$sett[ 'message' ] = array(
    'type' => array(
        'field' => 'none'
    ),
    'content' => '<div class="mythemes-plg-message"><p><strong>Layout Builder</strong> is available only in <a href="http://codecanyon.net/item/my-presentation/6051397?ref=mythem_es">Premium Version</a></p></div>'
);

$pages = mythemes_plg_cfg::get_pages();
$pages[ 'mythemes-plg-layouts' ][ 'content' ] = $sett;
mythemes_plg_cfg::set_pages( $pages );
?>