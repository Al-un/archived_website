<?php

if( !class_exists( 'mythemes_plg_box' ) ){

class mythemes_plg_box
{
    static function run( )
    {
        $posts_boxes = mythemes_plg_cfg::get_boxes();

        if( empty( $posts_boxes ) || !is_array( $posts_boxes ) )
        {
            return null;
        }
        
        foreach( $posts_boxes as $postSlug => & $post_boxes ) {
            foreach( $post_boxes as $boxSlug => $box ) {
                add_meta_box( $boxSlug
                    , $box[ 'title' ] 
                    , $box[ 'callback' ] 
                    , $postSlug 
                    , $box[ 'context' ] 
                    , $box[ 'priority' ] 
                    , $box[ 'args' ] 
                );
                
                if( isset( $box[ 'onSave' ] ) ) {
                    add_action( 'save_post', $box[ 'onSave' ], 10, 1 );
                }
            }
        }
    }
}

add_action( 'admin_init', array( 'mythemes_plg_box' , "run" ) );

} /* END IF CLASS EXISTS */
?>