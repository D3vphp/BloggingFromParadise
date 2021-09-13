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
        <div class="comment-box"><i class="fa fa-comments"></i> <?php if (comments_open(get_the_ID())) comments_popup_link(__('', 'BFPUltimate'),__('1', 'BFPUltimate'),__('%', 'BFPUltimate')); ?>
          <span class="trg"></span>
        </div>
         <div class="inner-article">
          <div class="the-post-details">
            <span class="author"><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></span>
            <span class="date"><i class="fa fa-calendar"></i> <?php the_time('F j, Y'); ?></span>
            <span class="tags"><i class="fa fa-folder-open"></i> <?php foreach((get_the_category()) as $category) {echo $category->cat_name . ' ';} ?></span> 
          </div>
          <div class="the-post-content">
            <?php the_content(); ?>
          </div>
        </div>
        <div class="clearfix"></div>
      </article>
      <div id="comments-wrapper">
        <?php comments_template(); ?>
      </div>
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