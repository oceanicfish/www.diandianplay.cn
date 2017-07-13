<?php 
  $uqid = uniqid();
  $id_link = 'cms-fancyboxes-'.$uqid;
  $icon = isset( $atts['icon1'] ) ? $atts['icon1'] : '';
  $content = isset( $atts['description1'] ) ? $atts['description1'] : '';
  $image = isset( $atts['image1'] ) ? $atts['image1'] : '';
  $title = isset( $atts['title1'] ) ? $atts['title1'] : '';
  $button_link = isset( $atts['button_link1'] ) ? $atts['button_link1'] : '';
  $image_url = '';
  if (!empty($image)) {
      $attachment_image = wp_get_attachment_image_src($image, 'full');
      $image_url = $attachment_image[0];
  }
  $cms_fancybox_boder_color = isset( $atts['cms_fancybox_boder_color'] ) ? $atts['cms_fancybox_boder_color'] : '';
  $cms_fancybox_bg_color = isset( $atts['cms_fancybox_bg_color'] ) ? $atts['cms_fancybox_bg_color'] : '';
  $cms_title_size = isset( $atts['cms_title_size'] ) ? $atts['cms_title_size'] : 'h3';
  $text_more_info = isset( $atts['text_more_info'] ) ? $atts['text_more_info'] : '';
  $text_more_info_color = isset( $atts['text_more_info_color'] ) ? $atts['text_more_info_color'] : '';
  $text_more_info_color_hover = isset( $atts['text_more_info_color_hover'] ) ? $atts['text_more_info_color_hover'] : '';
  $button_more_info = isset( $atts['button_more_info'] ) ? $atts['button_more_info'] : '';
  $button_more_info_border_color = isset( $atts['button_more_info_border_color'] ) ? $atts['button_more_info_border_color'] : '';
  $button_more_info_border_color_hover = isset( $atts['button_more_info_border_color_hover'] ) ? $atts['button_more_info_border_color_hover'] : '';
  $button_more_info_bg_color = isset( $atts['button_more_info_bg_color'] ) ? $atts['button_more_info_bg_color'] : '';
  $button_more_info_bg_color_hover = isset( $atts['button_more_info_bg_color_hover'] ) ? $atts['button_more_info_bg_color_hover'] : '';
  $cms_fancybox_icon_color = isset( $atts['cms_fancybox_icon_color'] ) ? $atts['cms_fancybox_icon_color'] : '';
  $cms_fancybox_title_color = isset( $atts['cms_fancybox_title_color'] ) ? $atts['cms_fancybox_title_color'] : '';
  $cms_fancybox_content_color = isset( $atts['cms_fancybox_content_color'] ) ? $atts['cms_fancybox_content_color'] : '';
  /* Readmore */
  $text_button_color = '';
  $text_button_color_hover = '';
  $btn_border_color = '';
  $btn_bg_color = '';
  $btn_border_color_hover = '';
  $btn_bg_color_hover = '';
  if (($atts['button_type']=='text') && $text_more_info == 'yes') {
    $text_button_color = $text_more_info_color; 
    $text_button_color_hover = $text_more_info_color_hover; 
  }
  if (($atts['button_type']=='button') && $button_more_info == 'yes') {
    $btn_border_color = $button_more_info_border_color;
    $btn_bg_color = $button_more_info_bg_color;
    $btn_border_color_hover = $button_more_info_border_color_hover;
    $btn_bg_color_hover = $button_more_info_bg_color_hover;
  }
?>
<div id="<?php echo esc_attr($id_link); ?>" class="cms-fancyboxes-wraper cms-fancybox-layout-2 <?php echo esc_attr($atts['template']);?>">
  <style type="text/css" scoped>
    #<?php echo esc_attr($id_link); ?>.cms-fancybox-layout-2 .cms-fancyboxes-readmore a:hover {
      color: <?php echo esc_attr($text_button_color_hover); ?> !important;
      border-color: <?php echo esc_attr($btn_border_color_hover); ?> !important;
      background-color: <?php echo esc_attr($btn_bg_color_hover); ?> !important;
    }
  </style>
  <?php if($atts['title']!=''):?>
      <div class="cms-fancyboxes-head">
          <div class="cms-fancyboxes-title">
              <?php echo apply_filters('the_title',$atts['title']);?>
          </div>
          <div class="cms-fancyboxes-description">
              <?php echo apply_filters('the_content',$atts['description']);?>
          </div>
      </div>
  <?php endif;?>
  <div class="cms-fancyboxes-body">
    <div class="cms-fancyboxes-item">
      <?php if($image_url):?>
      <div class="cms-fancy-box-image">
          <img src="<?php echo esc_attr($image_url);?>" alt="" />
      </div>
      <?php else:?>
      <div class="cms-fancy-box-content-icon">
          <i class="<?php echo esc_attr($icon);?>" style="background-color: <?php echo esc_attr($cms_fancybox_bg_color); ?>; border-color: <?php echo esc_attr($cms_fancybox_boder_color); ?>; color: <?php echo esc_attr($cms_fancybox_icon_color); ?>;"></i>
      </div>
      <?php endif;?>
      <div class="cms-fancy-box-boxright">
        <?php if($title):?>
        <div class="cms-fancy-box-content-title">
            <<?php echo esc_attr($cms_title_size); ?> class="cms-fancy-box-title" style="color: <?php echo esc_attr($cms_fancybox_title_color); ?>;">
                <?php echo apply_filters('the_title',$title);?>
            </<?php echo esc_attr($cms_title_size); ?>>
        </div>    
        <?php endif;?>
        <div class="cms-fancy-box-content" style="color: <?php echo esc_attr($cms_fancybox_content_color); ?>;">
            <?php echo apply_filters('the_content',$content);?>
        </div>
        <?php if($atts['button_text']!=''):?>
          <div class="cms-fancyboxes-readmore">
              <?php
                $class_btn = ($atts['button_type']=='button')?'btn btn-large':'';
              ?>
              <a style="background-color: <?php echo esc_attr($btn_bg_color); ?>; border-color: <?php echo esc_attr($btn_border_color); ?>; color: <?php echo esc_attr($text_button_color); ?>" href="<?php echo esc_url($button_link);?>" class="<?php echo esc_attr($class_btn);?>"><?php echo esc_attr($atts['button_text']);?></a>
          </div>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
