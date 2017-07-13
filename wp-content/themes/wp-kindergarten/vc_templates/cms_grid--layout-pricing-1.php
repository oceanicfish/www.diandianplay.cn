<div class="cms-grid-wraper cms-pricing-layout1 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
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
    <div class="cms-grid-pricing <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        $size = ($atts['layout']=='basic')?'thumbnail':'medium';
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            $pricing_meta = cms_post_meta_data();
            ?>
            <div class="<?php if (!empty($pricing_meta->_cms_pricing_button)):?><?php echo esc_attr($pricing_meta->_cms_pricing_button); ?><?php endif; ?> <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <div class="cms-pricing-wrapper">
                    <div class="cms-grid-title cms-pricing-title">
                        <h3><?php the_title();?></h3>
                        <?php if (!empty($pricing_meta->_cms_pricing_year)):?>
                            <span class="year">
                                <?php echo esc_attr($pricing_meta->_cms_pricing_year); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="cms-pricing-content">
                        <?php the_excerpt(); ?>
                    </div>
                    <?php if (!empty($pricing_meta->_cms_pricing_button)):?>
                        <div class="cms-pricing-button align-center">
                            <?php $button = $pricing_meta->_cms_pricing_button; ?>
                            <?php $button_text = $pricing_meta->_cms_pricing_button_text; ?>
                            <?php $button_url = $pricing_meta->_cms_pricing_button_url; ?>
                            <?php
                            switch ($button) {
                                case 'blue':
                                    echo "<a href='".$button_url."' class='btn btn-default'>".$button_text."</a>";
                                    break;
                                case 'crimson':
                                    echo "<a href='".$button_url."' class='btn btn-crimson'>".$button_text."</a>";
                                    break;
                                default:
                                    echo "<a href='".$button_url."' class='btn btn-green'>".$button_text."</a>";
                                    break;
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>