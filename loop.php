<?php if (have_posts()): while (have_posts()) : the_post(); ?>
  <!-- Start the article -->
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2>
      <a href="<?php the_permalink(); ?>" style="color:#fff">
        <?php the_title(); ?>
      </a>
    </h2>
    <figure>
      <!-- The post thumbnail -->
      <?php if(has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('bloglanding-post-thumbnail'); ?>
      <?php endif; ?>
    </figure>
    <div class="text">
      <span class="blogdate"><?php the_time('j F, Y'); ?></span>
      <div class="excerpt"><?php the_excerpt(); ?></div>
      <a href="<?php the_permalink(); ?>" class="btn blog-btn">READ ON...</a>
    </div>
    <div class="clearfix"></div>
  </article>
<?php endwhile; ?>
<?php else: ?>
<article>
  <h2><?php _e('Sorry, no posts was found.', 'BFPUltimate'); ?></h2>
</article>
<?php endif; ?>