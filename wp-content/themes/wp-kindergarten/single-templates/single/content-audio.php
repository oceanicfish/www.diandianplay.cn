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
	<div class="entry-blog entry-post">
		<div class="entry-header">
			<div class="entry-date">
				<div class="arow-date"></div>
				<?php cms_archive_post_icon(); ?>
				<span><?php echo get_the_date("F d,Y"); ?></span>
			</div>
		    <div class="entry-feature entry-audio"><?php $audio = cms_archive_audio(); ?></div>
			<div class="entry-meta"><?php cms_archive_detail(); ?></div>
		</div>
		<!-- .entry-header -->

		<div class="entry-content">
			<?php if($audio){ echo apply_filters('the_content', preg_replace(array('/\[audio(.*)\](.*)\[\/audio\]/', '/\[audio(.*)\]/', '/\[playlist(.*)\]/'), '', get_the_content(), 1));} else { the_content(); }
	    		wp_link_pages( array(
	        		'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . __( 'Pages:',THEMENAME) . '</span>',
	        		'after'       => '</div>',
	        		'link_before' => '<span class="page-numbers">',
	        		'link_after'  => '</span>',
	    		) );
			?>
		</div>
		<!-- .entry-content -->
	</div>
	<!-- .entry-blog -->
</article>
<!-- #post -->
