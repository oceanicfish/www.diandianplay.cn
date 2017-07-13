<div class="cms-carousel cms-carousel-team-layout1 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php
    $posts = $atts['posts'];
    while($posts->have_posts()){
        $posts->the_post();
        $cms_title_size = isset( $atts['cms_title_size'] ) ? $atts['cms_title_size'] : 'h3';
        ?>
        <div class="cms-carousel-item">
            <div class="cms-carousel-title">
                <<?php echo esc_attr($cms_title_size); ?>>
                    <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title();?></a>
                </<?php echo esc_attr($cms_title_size); ?>>
            </div>
            <div class="cms-carousel-categories">
                <?php the_terms( get_the_ID(), 'team-category', '', ' / ' ); ?>
            </div>
            <?php 
                if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()))):
                    $class = ' has-thumbnail';
                    $thumbnail = get_the_post_thumbnail(get_the_ID(),'full');
                else:
                    $class = ' no-image';
                    $thumbnail = '<img src="'.CMS_IMAGES.'no-image.jpg" alt="'.get_the_title().'" />';
                endif;
                echo '<div class="cms-carousel-media '.esc_attr($class).'"><a title="'.get_the_title().'" href="'.get_the_permalink().'">'.$thumbnail.'</a></div>';
            ?>
        </div>
        <?php
    }
    ?>
</div>