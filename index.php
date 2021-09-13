<?php
/**
* 
* Template: The main template file
*
* @package WordPress
* @subpackage BFPUltimate
* @since BFP Ultimate 1.0.0
*/
?>
<?php get_header(); ?>
<div class="fullwrapper">
  <div class="mainwrapper">
    <section id="posts">
      <div role="main" id="main">
        <section id="blog-post-articles">
          <?php 
            $paged = (get_query_var('paged'))? get_query_var('paged'):1;
            $args = array(
              'posts_per_page' => 4,
              'paged' => $paged
            );
          $custom_query = new WP_Query($args);
          ?>
          <?php get_template_part('loop'); ?>
          <div class="clearfix"></div>
        </section>
        <?php if(function_exists("pagination")) {
          pagination($custom_query->max_num_pages);
        } ?>
      </div>
    </section>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>