<?php
/*
Template Name: Articles
*/
?>


<?php get_header(); ?>
<section id="posts-header" class="global-banner">
    <div class="container">
        <h1><?php _e('Articles','replaceme'); ?></h1>
        <p><?php _e('Financial Services Industry News and How It Affects Advisors','replaceme'); ?></p>
    </div>
</section>
<section id="posts-list">
    <div class="container">
        <div id="all-posts">
			<?php query_posts( array( 'category_name' => 'article', 'paged' => get_query_var('paged') ) ); ?>
				<?php while (have_posts()) : the_post(); ?>
                
                
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  style="clear:both">
                	<?php the_time('F j, Y'); ?>
                	<h4><?php the_title(); ?></h4>
                    
                	<?php the_post_thumbnail('category-thumb', array('class' => 'post-thumbnail')); ?>
                	<?php the_excerpt(); ?>
                	<hr />
                </article>
            
            <?php endwhile;?>
            <?php wp_pagenavi(); ?>
        </div>
        <div id="post-sidebar">
        	<div class="recent-posts">
                <h3><?php _e('Recent Articles','replaceme'); ?></h3>
                <?php query_posts('category_name=article&showposts=10'); ?>
                <?php while (have_posts()) : the_post(); ?>
                
                <ul><li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li></ul>
                <?php endwhile; ?>
            </div>
            
            <div class="tag-cloud">
            	<h3><?php _e('Top Trends','replaceme'); ?></h3>
            	<?php wp_tag_cloud( $args ); ?>
            </div>   
                     
            
    	</div>         
    </div> 
</section>


<?php get_footer(); ?>