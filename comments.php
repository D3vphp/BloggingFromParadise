<div id="comments" class="comments">
  <?php if (post_password_required()) : ?>
  <p><?php _e('Post is password protected. Enter the password to view any comments.', 'BFPUltimate'); ?></p>
</div>
<?php return; endif;?>
<?php if (have_comments()) : ?>
<ol class="commentslist">
  <?php
    // Display comments
    wp_list_comments( array(
      'callback' => 'better_comments'
    ) );
    ?>
</ol>

<?php endif; ?>
<?php 
  $placeholder_name = __('Name', 'BFPUltimate');
  $placeholder_email = __('Email', 'BFPUltimate');
  $placeholder_comment = __('Enter your comment here...', 'BFPUltimate');
  $aria_req = ($req ? " aria-required='true'" : '');
  $field_req = ($req ? " *" : '');
  $comment_args = array(
    'title_reply'    =>__('Would you like to share your thoughts?', 'BFPUltimate'),
    'mini_reply'     =>__('<p class="mini-reply>Your email address will not be published. Required fields are marked *</p>', 'BFPUltimate'),
    'fields'         => apply_filters('comment_form_default_fields', array(
      'author'         => '<p class="comment-form-author">' . '<input id="author" name="author" type="text" placeholder="' . $placeholder_name . $field_req . '" value=""' . $aria_req . '/></p>',
      'email'          => '<p class="comment-form-email">' . '<input id="email" name="email" type="email" placeholder="' . $placeholder_email . $field_req . '" value=""' . $aria_req . '/>'.'</p>')),
      'comment_field'  => '<textarea id="comment" name="comment" cols="70" rows="8" aria-required="true" placeholder="' . $placeholder_comment . '"></textarea>',
    );
  comment_form($comment_args);
?>