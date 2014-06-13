<?php get_header(); ?>
<section class="global-banner">
	<div class="container">
    	<h1><?php _e('Search Results','replaceme'); ?></h1>
    </div>
</section>
<section id="posts-list">
	<div class="container">
    	<div id="all-posts">
			<?php if (have_posts()) : ?>
        
                <h2><?php _e('Search Results','replaceme'); ?></h2>
        
                <?php while (have_posts()) : the_post(); ?>
                    
                     <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  style="clear:both">
						<?php the_date('j F, Y'); ?>
                        <h4><?php the_title(); ?></h4>
                        
                        <p><?php the_excerpt(); ?></p>
                        <hr />
                    </article>
        
                <?php endwhile; ?>
                <?php wp_pagenavi(); ?>
        
        
            <?php else : ?>
        
                <h3><?php _e('No search results found','replaceme'); ?></h3>
        
            <?php endif; ?>
        </div>
    </div>

</section>

<?php get_footer(); ?>
