<div class="cms-counter-wraper cms-counter-layout-3 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
  <?php if($atts['title']!=''):?>
        <div class="cms-counter-head">
            <div class="cms-counter-title">
                <?php echo apply_filters('the_title',$atts['title']);?>
            </div>
            <div class="cms-counter-description">
                <?php echo apply_filters('the_content',$atts['description']);?>
            </div>
        </div>
    <?php endif;?>
    <div class="cms-counter-body">
        <?php
            $columns = ((int)$atts['cms_cols'])?(int)$atts['cms_cols']:1;
            $class_bootstrap = "";
            switch($columns){
              case "1 Column":
               $class_bootstrap = "";
               break;
              case "2 Columns":
               $class_bootstrap = "col-xs-12 col-sm-6 col-md-4 col-lg-6";
               break;
              case "3 Columns":
               $class_bootstrap = "col-xs-12 col-sm-6 col-md-4 col-lg-4";
               break;
              case "4 Columns":
               $class_bootstrap = "col-xs-12 col-sm-6 col-md-4 col-lg-3";
               break;
              case "6 Columns":
               $class_bootstrap = "col-xs-12 col-sm-6 col-md-4 col-lg-2";
               break;

              default:
               $class_bootstrap = "";
               break;
             }
            $item_class = 'cms-fancy-box-item '.($class_bootstrap);
            for($i=1;$i<=$columns;$i++){ ?>
                <?php if($i!=5):?>
                    <?php
                    $title = isset($atts['title'.$i])?$atts['title'.$i]:'';
                    $icon = isset($atts['icon'.$i])?$atts['icon'.$i]:'';
                    $type = isset($atts['type'.$i])?$atts['type'.$i]:'';
                    $suffix = isset($atts['suffix'.$i])?$atts['suffix'.$i]:'';
                    $digit = isset($atts['digit'.$i])?$atts['digit'.$i]:'60';
                    $cms_title_size = isset( $atts['cms_title_size'] ) ? $atts['cms_title_size'] : 'h3';
                    $cms_counter_border_color = isset( $atts['cms_counter_border_color'] ) ? $atts['cms_counter_border_color'] : '#0f9fbc';
                    $cms_counter_bg_color = isset( $atts['cms_counter_bg_color'] ) ? $atts['cms_counter_bg_color'] : '#34bfdb';
                    $cms_counter_text_color = isset( $atts['cms_counter_text_color'] ) ? $atts['cms_counter_text_color'] : '#fff';
                    $description_counter = isset( $atts['description_counter'] ) ? $atts['description_counter'] : '';
                    $cms_counter_title_color = isset( $atts['cms_counter_title_color'] ) ? $atts['cms_counter_title_color'] : '#fff';
                    $cms_counter_content_color = isset( $atts['cms_counter_content_color'] ) ? $atts['cms_counter_content_color'] : '#9c9c9c';
                    ?>
                  <div class="<?php echo esc_attr($item_class);?>">
                    <div class="cms-counter-box" style="background-color: <?php echo esc_attr($cms_counter_bg_color); ?>; border-color: <?php echo esc_attr($cms_counter_border_color); ?>; color: <?php echo esc_attr($cms_counter_text_color); ?>;">
                        <div class="cms-counter-middle">
                            <div id="counter_<?php echo esc_attr($atts['html_id'].'_item_'.$i);?>" class="cms-counter <?php echo esc_attr(strtolower($type));?>" data-suffix="<?php echo esc_attr($suffix);?>" data-type="<?php echo esc_attr(strtolower($type));?>" data-digit="<?php echo esc_attr($digit);?>">
                            </div>
                        </div>
                    </div>
                    <div class="cms-counter-right">
                      <?php if($title):?>
                        <<?php echo esc_attr($cms_title_size); ?> class="cms-counter-title" style="color: <?php echo esc_attr($cms_counter_title_color); ?>">     
                            <?php echo apply_filters('the_title',$title);?>
                        </<?php echo esc_attr($cms_title_size); ?>>
                      <?php endif;?>
                      <div class="cms-counter-description" style="color: <?php echo esc_attr($cms_counter_content_color); ?>">
                        <?php echo esc_attr($description_counter); ?>
                      </div>
                    </div>
                  </div>
                <?php endif;?>
            <?php }
        ?>
    </div>
</div>