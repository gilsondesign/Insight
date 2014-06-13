<?php
		// Translations can be filed in the /languages/ directory
        load_theme_textdomain( 'replaceme', TEMPLATEPATH . '/languages' );
 
		$locale = get_locale();
        $locale_file = TEMPLATEPATH . "/languages/$locale.php";
        if ( is_readable($locale_file) )
            require_once($locale_file);

	
	// Add RSS links to <head> section
	automatic_feed_links();

	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => __('Sidebar Widgets','replaceme' ),
    		'id'   => 'sidebar-widgets',
    		'description'   => __( 'These are widgets for the sidebar.','replaceme' ),
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }
    
    add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video')); // Add 3.1 post format theme support.
	
	if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // default Post Thumbnail dimensions (cropped)
	
	// additional image sizes
	// delete the next line if you do not need additional image sizes
	add_image_size( 'category-thumb', 200, 150 ); 
	}
			
	
	//custom excerpt filter length for homepage
	function custom_excerpt_length( $length ) {
	return 80;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	
	
	function new_excerpt_more( $more ) {
		return '...';
	}
	add_filter( 'excerpt_more', 'new_excerpt_more' );
	
	function excerpt_read_more_link($output) {
	 global $post;
	 return $output . '<a href="'. get_permalink($post->ID) . '" class="btn btn-teal">Read More &raquo;</a>';
	}
	add_filter('the_excerpt', 'excerpt_read_more_link');
	
	
	//Gets post cat slug and looks for single-[cat slug].php and applies it
	add_filter('single_template', create_function(
		'$the_template',
		'foreach( (array) get_the_category() as $cat ) {
			if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
			return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
		return $the_template;' )
	);
	
	if ( ! function_exists( 'replaceme_content_nav' ) ) :
	/**
	 * Displays navigation to next/previous pages when applicable.
	 *
	 * @since Twenty Twelve 1.0
	 */
	function replaceme_content_nav( $html_id ) {
		global $wp_query;
	
		$html_id = esc_attr( $html_id );
	
		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
				<h3 class="assistive-text"><?php _e( 'Post navigation', 'replaceme' ); ?></h3>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'replaceme' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'replaceme' ) ); ?></div>
			</nav><!-- #<?php echo $html_id; ?> .navigation -->
		<?php endif;
	}
	endif;
	
	
	/* Iframe shortcode */
	add_shortcode('iframe', 'ag_iframe');
	
	function ag_iframe($atts, $content) {
	 if (!$atts['width']) { $atts['width'] = 300; }
	 if (!$atts['height']) { $atts['height'] = 490; }
	
	 return '<iframe border="0" scrolling="no" class="form-background" frameborder="0" src="' . $atts['src'] . '" width="' . $atts['width'] . '" height="' . $atts['height'] . '"></iframe>';
	}

?>