<?php get_header(); ?>
  <div class="progress-container progress progress-striped active">
    <div role="progressbar progress-striped" class="progress-bar" id="myBar"></div>
  </div>
<div class="fullwrapper">
  <?php if(have_posts()): while(have_posts()): the_post(); ?>
    <div class="post-title"><h1><?php the_title(); ?></h1></div>
  <?php endwhile; ?><?php endif; ?>
  <div class="mainwrapper">
    <section id="post-article">
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <!-- The post article -->
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
         <div class="inner-article">

          <div class="the-post-content">
            <?php the_content(); ?>
          </div>
        </div>
        <div class="clearfix"></div>
      </article>
      <?php endwhile; ?>
      <?php else: ?>
      <article>
        <h2><?php _e('Sorry, nothing to display here', 'BFPUltimate'); ?></h2>
      </article>
      <?php endif; ?>
    </section>
  </div>
  <?php get_sidebar('sidebar post', 'BFPUltimate'); ?>
</div>

<?php get_footer(); ?>