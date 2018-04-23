<?php get_header(); ?>
<?php if ( is_front_page() || is_home() ) : ?>
  <main class="b">
    <?php if ( have_posts () ) : while (have_posts()):the_post();?>
      <?php 
        include(get_template_directory()."/".get_post( $post )->post_name.".php");
      ?>
    <?php endwhile; ?>
  <?php endif; ?>
  </main>
<?php else : ?>
  <main class="b">
    <?php if ( have_posts () ) : while (have_posts()):the_post();?>
      <?php
        echo '<section id="webdoor" class="flex" style="background-color:'; 
        if(get_field('cor_do_banner')==""||get_field('cor_do_banner')=="#eaeaea") { echo "#eaeaea"; } else { echo get_field('cor_do_banner')."; color:#fff !important;"; } echo '">
          <div class="flex100 flex">';
          if(wp_get_attachment_url(get_post_thumbnail_id($post->ID))){
            echo '<div class="flex50">
              <h1 class="b">'.get_the_title().'</h1>';
              if(get_field('subtitulo')!=""){
                echo '<h2 class="b">'.get_field('subtitulo').'</h2>';
              }
            echo '</div>
            <div class="flex50"><img src="'.wp_get_attachment_url(get_post_thumbnail_id($post->ID)).'" /></div>';
          } else {
            echo '<div class="flex100">
              <h1 class="b">'.get_the_title().'</h1>';
              if(get_field('subtitulo')!=""){
                echo '<h2 class="b">'.get_field('subtitulo').'</h2>';
              }
            echo '</div>';
          }
        echo '  
          </div>
        </section>';
        include(get_template_directory()."/".get_post( $post )->post_name.".php");
      ?>
    <?php endwhile; ?>
  <?php endif; ?>
  </main>
<?php endif; ?>
<?php get_footer(); ?>

