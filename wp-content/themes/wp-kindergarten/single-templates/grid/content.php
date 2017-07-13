<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cms-blog-header">
		<div class="entry-feature entry-feature-image">
			<?php 
				if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()))):
					$class = ' has-thumbnail';
					$thumbnail = get_the_post_thumbnail(get_the_ID(),'full');
				else:
					$class = ' no-image';
					$thumbnail = '<img src="'.CMS_IMAGES.'no-image.jpg" alt="'.get_the_title().'" />';
				endif;
				echo '<div class="'.esc_attr($class).'">'.$thumbnail.'</div>';
			?>
		</div>
		<div class="cms-blog-date">
	        <div class="arow-date"></div>
	        <?php cms_archive_post_icon(); ?>
	        <span><?php echo get_the_date("F d,Y"); ?></span>
	    </div>
	    <div class="cms-blog-overlay">
	        <a class="cms-blog-overlay-readmore" title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel="">+</a>
	    </div>
	</div>
	<div class="cms-blog-title">
		<h4><?php the_title(); ?></h4>
	</div>
	<div class="cms-blog-content">
		<?php echo substr(get_the_excerpt(), 0,300); ?>
    	<a class="cms-blog-readmore" title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php _e('Read More >', THEMENAME) ?></a>
	</div>
</article>
