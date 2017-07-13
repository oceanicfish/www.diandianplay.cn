<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
global $smof_data;
?>
        </div><!-- #main -->
			<footer>
                <?php if ($smof_data['enable_footer_top'] =='1'): ?>
                    <div id="cshero-footer-top">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3"><?php dynamic_sidebar('sidebar-5'); ?></div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3"><?php dynamic_sidebar('sidebar-6'); ?></div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3"><?php dynamic_sidebar('sidebar-7'); ?></div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3"><?php dynamic_sidebar('sidebar-8'); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <?php if ($smof_data['enable_footer_bottom'] =='1'): ?>
                    <div id="cshero-footer-bottom">
                         <div class="container">
                             <div class="row">
                                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php dynamic_sidebar('sidebar-9'); ?></div>
                                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php dynamic_sidebar('sidebar-10'); ?></div>
                             </div>
                         </div>
                    </div>
                <?php endif;?>
		</footer><!-- #site-footer -->
	</div><!-- #page -->
	<?php wp_footer(); ?>
</body>
</html>