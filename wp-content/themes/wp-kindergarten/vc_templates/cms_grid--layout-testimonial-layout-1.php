<?php 
    /* Get Categories */
        $taxo = 'testimonial-category';
        $_category = array();
        if(!isset($atts['cat']) || $atts['cat']==''){
            $terms = get_terms($taxo);
            foreach ($terms as $cat){
                $_category[] = $cat->term_id;
            }
        } else {
            $_category  = explode(',', $atts['cat']);
        }
        $atts['categories'] = $_category;
?>
<div class="cms-grid-wraper cms-testimonial-layout1 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if($atts['filter']=="true" and $atts['layout']=='masonry'):?>
        <div class="cms-grid-filter">
            <ul>
                <li><a class="active" href="#" data-group="all">All</a></li>
                <?php foreach($atts['categories'] as $category):?>
                    <?php $term = get_term( $category, 'category' );?>
                    <li><a href="#" data-group="<?php echo esc_attr('category-'.$term->slug);?>">
                            <?php echo __($term->name, THEMENAME);?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif;?>
    <div class="row cms-grid cms-testimonial-wrapper <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        $size = ($atts['layout']=='basic')?'thumbnail':'medium';
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';

            $testimonial_meta = cms_post_meta_data();

            foreach(cmsGetCategoriesByPostID(get_the_ID()) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            $cms_title_size = isset( $atts['cms_title_size'] ) ? $atts['cms_title_size'] : 'h3';
            $testimonial_rating = isset( $atts['testimonial_rating'] ) ? $atts['testimonial_rating'] : '';
            ?>
            <div class="cms-testimonial-item <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <div class="cms-grid-content cms-testimonial-content">
                    <?php the_content();?>
                </div>
                <div class="cms-grid-title">
                    <<?php echo esc_attr($cms_title_size); ?>  class="cms-testimonial-title">
                        <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title();?></a>
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
            <?php
        }
        ?>
    </div>
</div>