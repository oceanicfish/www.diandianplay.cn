<?php
/**
 * Breadcrumbs file.
 *
 * @package WordPress
 * @subpackage Happy Kids
 * @since Happy Kids 1.0
 * @version     3.3.0
 */ 

function theme_breadcrumbs() {
  $gen_sets = theme_get_option('general', 'gen_sets');
  $home = !empty($gen_sets['_home_slug']) ? $gen_sets['_home_slug'] : __('Home', 'happykids'); // homepage name
  $showOnHome = 0; // 1 - show bredcrumbs on homepage, 0 - don't show
  $delimiter = '<span class="delimiter">&gt;</span>'; // separator
  $showCurrent = 1; // 1 - show current page, 0 - don't show
  $before = '<li><span class="current_crumb">'; // before crumb tag
  $after = '</span></li>'; // after crumb tag

  global $post;
  //$homeLink = get_bloginfo('url');
  $homeLink = home_url();

  if (is_home() || is_front_page()) {

    if ($showOnHome == 1) echo '<li>' . $before . $home . $after . '</li>';

  } else {

    echo '<li><a href="' . $homeLink . '" title="'.$home.'">' . $home . '</a></li> ' . $delimiter . ' ';

    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo '<li>' . get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ') . '</li>';
      echo $before . ' "' . single_cat_title('', false) . '"' . $after;

    } elseif ( is_search() ) {
      echo $before . ' "' . get_search_query() . '"' . $after;

    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        $pt_url = (get_post_type() == 'portfolio') ? get_post_type_archive_link( 'portfolio' ) : $slug['slug'];
        echo '<li><a href="' . $pt_url . '">' . $post_type->labels->singular_name . '</a></li>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo '<li>' . $cats . '</li>';
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
       echo $before . get_the_title() . $after;
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      echo $before . ' "' . single_tag_title('', false) . '"' . $after;

    } elseif ( is_author() ) {
      global $author;
      $userdata = get_userdata($author);
      echo $before . ' ' . $userdata->display_name . $after;

    } elseif ( is_404() ) {
      echo $before . '404 page' . $after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo '<li>' . __('Page' , 'happykids') . ' ' . get_query_var('paged') . '</li>';
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

  }
} // end theme_breadcrumbs
?>