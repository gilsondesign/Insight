<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
        <section id="post-title" class="global-banner">
            <div class="container">
            	<?php the_date('F j, Y'); ?></span>
                <h1><?php the_title(); ?></h1>
            </div>
        </section>

        <section id="post-content">
            <div class="container">
            	<div id="post">
                    <?php the_post_thumbnail('category-thumb', array('class' => 'post-thumbnail')); ?>
                    <?php the_content(); ?>
                    
                    <?php endwhile; endif; ?>
                </div>  
                
                <div id="post-sidebar">
                    <div class="recent-posts">
                    	<?php if (in_category( 'article')){ ?>
				
                            <h3><?php _e('Related Articles','replaceme'); ?></h3>
                            <?php query_posts('category_name=article&showposts=5'); ?>
                            <?php while (have_posts()) : the_post(); ?>
                            
                            <ul><li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li></ul>
                            <?php endwhile; ?>
						<?php } ?>
                    </div>
                    
                    
                </div>  
                    
			</div>
        </section>
	</article>


<?php get_footer(); ?>