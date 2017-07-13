<div class="cms-carousel cms-blog-layout1 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php
    $posts = $atts['posts'];
    while($posts->have_posts()){
        $posts->the_post();
        $cms_title_size = isset( $atts['cms_title_size'] ) ? $atts['cms_title_size'] : 'h3';
        ?>
        <div class="cms-carousel-item">
            <?php
                get_template_part( 'single-templates/grid/content', get_post_format() );
            ?>
        </div>
        <?php
    }
    ?>
</div>