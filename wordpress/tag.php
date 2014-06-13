<?php /*
Template Name: Tag Archive
*/ ?>
<div>
<?php get_header(); ?>
<section class="global-banner">
	<div class="container">
    	<h1><?php _e('Tag Archive','replaceme'); ?></h1>
    </div>
</section>

<section class="global-body"  id="post-content">
	<div class="container">
    	<div id="post">
		
			<?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                	<?php the_date('j F, Y'); ?>
                	<h4><?php the_title(); ?></h4>
                    
                    <?php the_excerpt(); ?>
                    <hr />
            
                <?php endwhile; ?>
                <?php endif; ?>
        </div>
        <div id="post-sidebar">
        	<?php wp_tag_cloud(''); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>