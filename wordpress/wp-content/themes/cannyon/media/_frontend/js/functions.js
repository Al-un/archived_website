function mythemes_jscrollpanel(){
    jQuery(function(){
        if( jQuery('div.visible-nav').css('display') !== 'none' ){
            jQuery( 'div.mythemes-topper nav.base-nav.header-nav.in div.nav-wrapper').jScrollPane();
        }
        else if( jQuery( 'nav.base-nav div.nav-wrapper' ).hasClass( 'jspScrollable' ) ) {
            jQuery( 'nav.base-nav ul#menu-header' ).parent().removeAttr( 'style' );
            jQuery( 'nav.base-nav ul#menu-header' ).parent().parent().removeAttr( 'style' );
            jQuery( 'nav.base-nav div.nav-wrapper' ).removeAttr( 'style' );
        }
    })
}

jQuery(document).ready(function(){    

    /* ADD MENU ARROWS */
    jQuery('nav.base-nav ul.mythemes-menu li.menu-item-has-children').prepend('<span class="menu-plus"></span>');

    jQuery( 'nav.base-nav ul li span.menu-plus' ).on( "click" , function(){
        if( jQuery( this ).hasClass( 'collapsed' ) ){
            jQuery( this ).parent().children('ul').hide( "slow" , function(){
                jQuery( this ).removeAttr( 'style' );
            });
            jQuery( this ).removeClass( 'collapsed' );
        }
        else{
            jQuery( this ).addClass( 'collapsed' );
            jQuery( this ).parent().children('ul').show( "slow" );
        }

        setTimeout(function(){
            mythemes_jscrollpanel();
        }, 1000 );
    });

    /* BUTTON COLLAPSE FROM ANTENT */
    jQuery( 'div.mythemes-header-antet button.btn-collapse' ).click(function(){
        if( jQuery( this ).hasClass( 'collapsed' ) ){
            jQuery( this ).removeClass( 'collapsed' );
            jQuery( '.nav-collapse.in' ).each(function(){
                jQuery( this ).hide( 'slow' , function(){
                    jQuery( this ).removeClass( 'in' );
                    jQuery( this ).removeAttr( 'style' );
                    var btn = jQuery( this ).find( 'button.btn-collapse' );

                    if( btn.hasClass( 'collapsed' ) ){
                        btn.removeClass( 'collapsed' );
                    }
                });
            });
        }
        else{
            jQuery( this ).addClass( 'collapsed' );

            jQuery( '.nav-collapse' ).show( 'slow' , function(){
                jQuery( this ).addClass( 'in' );
                jQuery( this ).removeAttr( 'style' );
                var btn = jQuery( this ).find( 'button.btn-collapse' );

                if( !btn.hasClass( 'collapsed' ) ){
                    btn.addClass( 'collapsed' );
                }
            });
        }

        setTimeout(function(){
            mythemes_jscrollpanel();
        }, 1000 );
    });

    /* BUTTON COLLAPSE FROM MENU */
    jQuery( 'nav.base-nav button.btn-collapse' ).click(function(){
        if( jQuery( this ).hasClass( 'collapsed' ) ){
            jQuery( this ).removeClass( 'collapsed' );
            jQuery( '.nav-collapse.in' ).each(function(){
                jQuery( this ).hide( 'slow' , function(){
                    jQuery( this ).removeClass( 'in' );
                    jQuery( this ).removeAttr( 'style' );
                });
            });

            if( jQuery( 'div.mythemes-header-antet button.btn-collapse' ).hasClass( 'collapsed' ) ){
                jQuery( 'div.mythemes-header-antet button.btn-collapse' ).removeClass( 'collapsed' );
            }
        }
        else{
            jQuery( this ).addClass( 'collapsed' );

            jQuery( '.nav-collapse' ).show( 'slow' , function(){
                jQuery( this ).addClass( 'in' );
                jQuery( this ).removeAttr( 'style' );
            });

            if( !jQuery( 'div.mythemes-header-antet button.btn-collapse' ).hasClass( 'collapsed' ) ){
                jQuery( 'div.mythemes-header-antet button.btn-collapse' ).addClass( 'collapsed' );
            }
        }
    });



    function header_image(){
        jQuery( '.mythemes-header-image img' ).removeAttr( 'style' );

        var div     = jQuery( '.mythemes-header-image' ).width();
        var img     = jQuery( '.mythemes-header-image img' ).width();

        var left    = 0;

        jQuery( '.mythemes-header-image img' ).load(function(){
            var img = jQuery( this ).width();

            if( img == 0 ){
                return;
            }
            
            if( img > div ){
                left = parseInt( ( div - img ) / 2 );
                jQuery( '.mythemes-header-image img' ).css( { 'margin-left' : left + 'px' } );
            }
            else{
                jQuery( '.mythemes-header-image img' ).css( { 'width' : '100%' , 'height' : 'auto' } );
            }
        });

        if( img == 0 ){
            return;
        }

        if( img > div ){
            left = parseInt( ( div - img ) / 2 );
            jQuery( '.mythemes-header-image img' ).css( { 'margin-left' : left + 'px' } );
        }
        else{
            jQuery( '.mythemes-header-image img' ).css( { 'width' : '100%' , 'height' : 'auto' } );
        }
    }

    header_image();

    function mythemes_load_images( count, self ){
        count--;
        if( count == 0 ){
            self.masonry();
        }

        return count;   
    }
    function mythemes_gallery(){
        jQuery( 'div.mythemes-gallery' ).each(function(){
            var self    = jQuery( this );
            var count   = jQuery( this ).find( 'figure.mythemes-item' ).length;

            jQuery( this ).find( 'figure.mythemes-item' ).each(function(){
                jQuery( this ).find( 'img' ).load(function(){
                    if( this.complete ){
                        count = mythemes_load_images( count, self );
                    }else{
                        jQuery( this ).one( 'load', function(){
                            count = mythemes_load_images( count, self );
                        });
                    }
                });
            });
        });
    }

    mythemes_gallery();

    /* CHANGE BORDER BOTTOM ON WINDOW RESIZE */
    jQuery( window ).resize(function() {

        jQuery( 'nav.base-nav ul span.menu-plus' ).removeClass( 'collapsed' );
        jQuery( 'nav.base-nav ul li ul' ).removeAttr( 'style' );
        header_image();

        if( jQuery( '.mythemes-gallery' ).length ){
            jQuery( '.mythemes-gallery' ).masonry();    
        }

        setTimeout(function(){
            mythemes_jscrollpanel();
        }, 1000 );
        
    });
});

jQuery(document).ready(function(){
    jQuery(window).scroll(function(){
        var scrollTop = jQuery( this ).scrollTop();
        
        if( scrollTop > 46 ){
            if( !jQuery( 'body' ).hasClass( 'scrolled-46' ) ){
                jQuery( 'body' ).addClass( 'scrolled-46' );

                setTimeout(function(){
                    mythemes_jscrollpanel();
                }, 1000 );
            }
        }

        else{
            if( jQuery( 'body' ).hasClass( 'scrolled-46' ) ){
                jQuery( 'body' ).removeClass( 'scrolled-46' );

                setTimeout(function(){
                    mythemes_jscrollpanel();
                }, 1000 );
            }
        }   
    });
});