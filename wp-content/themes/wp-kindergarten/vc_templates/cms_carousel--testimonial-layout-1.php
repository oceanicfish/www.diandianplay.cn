<div class="cms-carousel cms-testimonial-layout1 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php
    $posts = $atts['posts'];
    while($posts->have_posts()){
        $posts->the_post();
        $testimonial_meta = cms_post_meta_data();
        $cms_title_size = isset( $atts['cms_title_size'] ) ? $atts['cms_title_size'] : 'h3';
        $testimonial_rating = isset( $atts['testimonial_rating'] ) ? $atts['testimonial_rating'] : '';
        ?>
        <div class="cms-testimonial-wrapper">
            <div class="cms-carousel-item cms-testimonial-item">
                <div class="cms-grid-content cms-testimonial-content">
                    <?php the_content();?>
                </div>
                <div class="cms-grid-title">
                    <<?php echo esc_attr($cms_title_size); ?>  class="cms-testimonial-title">
                        <?php the_title();?>
                    </<?php echo esc_attr($cms_title_size); ?>>
                </div>
                <div class="cms-grid-categories cms-testimonial-categories">
                    <?php the_terms( get_the_ID(), 'testimonial-category', '', ' / ' ); ?>
                </div>
                <?php if (!empty($testimonial_meta->_cms_testimonial_rating)):?>
                    <div class="cms-testimonial-rating">
                        <span class="<?php echo esc_attr($testimonial_meta->_cms_testimonial_rating); ?>"></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>