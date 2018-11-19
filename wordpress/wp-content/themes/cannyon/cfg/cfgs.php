<?php
$cfgs = array(

    /* AUTHOR */
    'author'        => array(
        'name'              => 'myThem.es',
        'description'       => __( 'myThem.es Marketplace provides WordPress themes with the best quality and the smallest prices.' , 'cannyon' ),
        'url'               => 'http://mythem.es/'
    ),

    /* THEMES */
    'theme'         => array(
        'type'              => 'free',
        'description'       => __( 'Cannyon - free Responsive and Multipupose WordPress Themes.' , 'cannyon' ),
        //'premium'           => 'http://mythem.es/item/cannyon-premium-multipurpose-wordpress-theme/'
    ),

    /* LINKS */
    'links'         => array(
        'referrals'         => 'http://mythem.es/referrals/',
        'affiliates'        => 'http://mythem.es/affiliates/',
        'plugins'           => 'javascript:void(null);',
        'items'             => 'http://mythem.es/our-items/'
    ),

    'faqs'          => array(
        array(
            'title'     => __( 'Welcome Message !' , 'cannyon' ),
            'content'   => 

                '<p>' . __( 'Thank you for choosing myThem.es and use one of our WordPress Themes your choice is greatly appreciated!' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'If you have any questions ask!' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'And please help us to increase the theme quality ( report bugs ).' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'Also please help us to increase the theme rank!' , 'cannyon' ) . '</p>'
        ),
        array(
            'title'     => __( 'Default content from Sidebars: Front Page, Footer, Blog, Single.' , 'cannyon' ),
            'content'   => 

                '<div id="mythemes-header-alert" class="mythemes-flat-alert success"><p>' .
                __( 'You can hide all default content if you go to Admin Dashboard &rsaquo; Appearance &rsaquo; Customize &rsaquo; Additional and disable option "Display default content".' , 'cannyon' ) .
                '</p></div>' .

                '<p><big><strong>' . __( 'FRONT PAGE' , 'cannyon' ) . '</strong></big></p>' .

                '<p>' . __( 'In the home page below the HEADER image there are 3 components that are entitle:' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '1. MANY COMPONENTS' , 'cannyon' ) . '</p>' .
                '<p>' . __( '2. BLOCK MODEL' , 'cannyon' ) . '</p>' .
                '<p>' . __( '3. RESPONSIVE LAYOUT' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'Here we have three sidebars with default content. These are "Header Front Page Sidebars". If you go to Admin Dashboard &rsaquo; Appearance &rsaquo; Widgets you can see sidebars:' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '1. Header - First Front Page sidebar' , 'cannyon' ) . '</p>' .
                '<p>' . __( '2. Header - Second Front Page sidebar' , 'cannyon' ) . '</p>' .
                '<p>' . __( '3. Header - Third Front Page sidebar' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'You can replace the default content with your custom content. Just is need to put a "Text" widget to each "Header Front Page Sidebar" and fill it with your content.' , 'cannyon' ) . '</p>' .

                '<br/>' . 

                '<p><big><strong>' . __( 'FOOTER' , 'cannyon' ) . '</strong></big></p>' .

                '<p>' . __( 'In the footer before the copyright section there are 3 components that are entitle:' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '1. Cannyon' , 'cannyon' ) . '</p>' .
                '<p>' . __( '2. ADDRESS' , 'cannyon' ) . '</p>' .
                '<p>' . __( '3. CONTACT' , 'cannyon' ) . '</p>' .
                '<p>' . __( '4. WORKING HOURS' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'Here we have three sidebars with default content. These are "Header Front Page Sidebars". If you go to Admin Dashboard &rsaquo; Appearance &rsaquo; Widgets you can see sidebars:' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '1. Footer - First Sidebar ( is used the sample Text widget )' , 'cannyon' ) . '</p>' .
                '<p>' . __( '2. Footer - Second Sidebar ( is used the sample Text widget )' , 'cannyon' ) . '</p>' .
                '<p>' . __( '3. Footer - Third Sidebar ( is used the sample Text widget )' , 'cannyon' ) . '</p>' .
                '<p>' . __( '4. Footer - Fourth Sidebar ( is used the sample Text widget )' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p><big><strong>' . __( 'BLOG ( MAIN SIDEBAR )' , 'cannyon' ) . '</strong></big></p>' .

                '<p>' . __( 'By default is used content from next widgets: "Search", "Tags Cloud" and "Categories".' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p><big><strong>' . __( 'SINGLE POST ( SINGLE SIDEBAR )' , 'cannyon' ) . '</strong></big></p>' .
                
                '<p>' . __( 'By default is used content from next widgets: "Post Meta [myThem.es]", "Post Categories [myThem.es]" and "Post Tags [myThem.es]".' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p><big><strong>' . __( 'REPLACE CONTENT VS DISABLE DEFAULT CONTENT' , 'cannyon' ) . '</strong></big></p>' .

                '<p>' . __( 'If you disable the default content then it will disable all default content from your web site ( sidebars with default content listed above ):' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '- Front Page Heade Sidebars' , 'cannyon' ) . '</p>' .
                '<p>' . __( '- Footer Sidebars' , 'cannyon' ) . '</p>' .
                '<p>' . __( '- Main Blog Sidebar' , 'cannyon' ) . '</p>' .
                '<p>' . __( '- Single Sidebar' , 'cannyon' ) . '</p>' .
                '<p>' . __( '- ...' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'Also you can replace the default content with your content. This will allow you to make one or more changes. You will not need to replace all default content.' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'To replace the default content you need to add a widget with your content in the sidebar with default content ( listed above). The default content will automatically change with your content (only for this sidebar).' , 'cannyon' ) . '</p>'

        ),
        array(
            'title'     => __( 'Custom CSS and Customizations' , 'cannyon' ),
            'content'   => 

                '<p>' . __( 'This theme comes with special option. This option allow add custom css to customize your web site to your needs.' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'To use it go to Admin Dashboard' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'Appearance &rsaquo; Customize &rsaquo; Others - option "Custom css".' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'You can use it for multiple case, just is need to add you css in this field.' , 'cannyon' ) . '</p>'
        ),
        array(
            'title'     => __( 'Customize the Theme' , 'cannyon' ),
            'content'   =>

                '<p>' . __( 'This theme comes with a set of options what allow you to customize content, header, layouts, social items and others.' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'You can see theme options if you go to Admin Dashboard' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'Appearance &rsaquo; Customize' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'Here you can see:' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '01. Site Title &amp; Tagline' , 'cannyon' ) . '</p>' .
                '<p>' . __( '02. Branding' , 'cannyon' ) . '</p>' .
                '<p>' . __( '03. Header' , 'cannyon' ) . '</p>' .
                '<p>' . __( '04. Breadcrumbs' , 'cannyon' ) . '</p>' .
                '<p>' . __( '05. Additional' , 'cannyon' ) . '</p>' .
                '<p>' . __( '06. Layout' , 'cannyon' ) . '</p>' .
                '<p>' . __( '07. Social' , 'cannyon' ) . '</p>' .
                '<p>' . __( '08. Others' , 'cannyon' ) . '</p>' .
                '<p>' . __( '09. Background Image' , 'cannyon' ) . '</p>' .
                '<p>' . __( '10. Navigation' , 'cannyon' ) . '</p>' .
                '<p>' . __( '11. Widgets' , 'cannyon' ) . '</p>' .
                '<p>' . __( '12. Static Front Page' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'All you have to do is play with them and view live changes.' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'Try and you will discover how easy it is to customize your own style.' , 'cannyon' ) . '</p>'
        )

    ),

    'adds'          => array(
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/treeson-premium.jpg',
            'name'          => __( 'Treeson Premium' , 'cannyon' ),
            'price'         => 43,
            'url'           => 'http://mythem.es/item/treeson-premium-multipurpose-wordpress-theme/',
        ),
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/nerocity-premium.jpg',
            'name'          => __( 'Nerocity Premium' , 'cannyon' ),
            'price'         => 40,
            'url'           => 'http://mythem.es/item/nerocity-premium-wordpress-theme/',
        ),
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/verbo-premium.jpg',
            'name'          => __( 'Verbo Premium' , 'cannyon' ),
            'price'         => 40,
            'url'           => 'http://mythem.es/item/verbo-premium-wordpress-theme/',
        ),
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/my-way-premium.jpg',
            'name'          => __( 'My Way Premium' , 'cannyon' ),
            'price'         => 25,
            'url'           => 'http://mythem.es/item/my-way-premium/',
        ),
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/my-contrastica-premium.jpg',
            'name'          => __( 'My Contrastica Premium' , 'cannyon' ),
            'price'         => 30,
            'url'           => 'http://mythem.es/item/my-contrastica-premium/',
        ),
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/my-engine-premium.jpg',
            'name'          => __( 'My Engine Premium' , 'cannyon' ),
            'price'         => 30,
            'url'           => 'http://mythem.es/item/my-engine-premium/',
        ),
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/my-lovely-premium.jpg',
            'name'          => __( 'My Lovely Premium' , 'cannyon' ),
            'price'         => 30,
            'url'           => 'http://mythem.es/item/my-lovely-premium/',
        ),
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/my-world-with-grass-and-dew-premium.jpg',
            'name'          => __( 'My Word with ... Premium' , 'cannyon' ),
            'price'         => 30,
            'url'           => 'http://mythem.es/item/my-world-with-grass-and-dew-premium-wp-theme/',
        )
    ),
    'diff'          => array(
        array(
            __( 'Paid Customization' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Support' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Premium Support' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Documentation' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Responsive layout' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Full support for multilanguages' , 'cannyon' ),
            0,
            1,
        ),
        array(
            __( 'Custom colors' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Quick Contact info' , 'cannyon' ),
            0,
            1,
        ),
        array(
            __( 'Custom breadcrumbs settings' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Scrollable header menu' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'WP Classic comments' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Facebook comments' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Disqus comments' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'General header settings' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Single post header settings ( each post )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Single page header settings ( each page )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Single portfolio Header settings ( each portfolio )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Fly Effect on header' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Related Posts ( by Tags or Categories )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Custom Front Page' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Front Page layout' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Custom post Portfolio' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Custom page template for Portfolios' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Portfolios archives' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Portfolios layouts ( page / single / archive )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'General layout settings' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Posts layout settings' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Single post layout settings ( each post )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Page layout settings' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Single page layout settings ( each page )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Sidebar builder ( build unlimited number of sidebars )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Social settings' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Footer background image' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Footer background color' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Footer link and text colors' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Footer copyright settings' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Footer credit link settings' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Footer Custom Menu' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Custom CSS' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Additional JavaScript settings' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Exclude pages / posts / portfolios / features / testimonials from the search results' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Exclude pages / posts / portfolios / features / testimonials from the RSS Feed' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'External URL for each portfolio / post / page' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Video thumbnail extractor - YouTube &amp; Vimeo for each portfolio / post' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Portfolio slideshow instead of thumbnail' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( '2 Addvertising section ( before content and after content ) for each portfolio / post' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Custom post Testimonials' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Custom post Features' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Additional Widgets' , 'cannyon' ),
            4,
            14
        ),
        array(
            __( 'Additional Shortcodes' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Shortcodes Manager' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Gallery special Effects' , 'cannyon' ),
            '1',
            '5'
        ),
        array(
            __( 'jetpack widgets [styled]' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'jetpack related posts [styled]' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'jetpack post numbers of views' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Contact Form 7 [styled]' , 'cannyon' ),
            1,
            1
        )
    )
);

mythemes_cfg::set( $cfgs );
?>