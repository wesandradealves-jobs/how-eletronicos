			<footer class="b">
				<div class="wrap flex">
					<div class="flex100 flex">
						<div class="flex50 flex">
						<?php wp_nav_menu( array( 'container' => false, 'menu' => 'header','menu_class' => 'flex50','menu_id' => 'menuFooter' ) ); ?>
							<ul class="flex50">
								<li><h2>Produtos</h2></li>
								<?php 
									$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
									$args = array('post_type' => 'produto', 'posts_per_page' => 4, 'offset' => $offset, 'order' => 'ASC');
									$query = new WP_Query($args);
									while($query -> have_posts()) : $query -> the_post();
									echo '<li><a href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></li>';
									endwhile; 
									wp_reset_query();
								?>
							</ul>
						</div>
						<div class="flex50 flex">
							<div class="flex50">
								<h2 class="b">Fale Conosco</h2>
								<h3 class="b"><?php echo get_theme_mod( 'telefone' ); ?></h3>
							</div>
							<div class="flex50">
								<div class="fb-page" data-href="<?php echo get_theme_mod( 'fb_page' ); ?>" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"></div></div>
							</div>
						</div>		
						<div class="flex100">
							<p class="b">© Copyright <?php echo get_bloginfo('name').", ".date('Y')." - Todos os direitos reservados"; ?></p>
						</div>				
					</div>
				</div>
			</footer>
		</div>
        <div id="fb-root"></div>
		<script type="text/javascript">
		    jQuery(document).ready(function(){
			  $('header > .wrap nav').on( "click", function() {
			    if ($(window).width() <= 1023) {
			      jQuery('html, body').stop(true, false).animate({
			        scrollTop: jQuery("body").offset().top
			      }, 500);
			      $("#menuMobile").toggleClass("on");
			      if($("#menuMobile").hasClass("on")){
			        $("header > .wrap nav").addClass("opened");
			        $("header,main").toggleClass("opened");
			      } else {
			        $("header > .wrap nav").removeClass("opened");
			        $("header,main").toggleClass("opened");
			      }
			    }
			  });
			  $(window).resize(function(){
			    if ($(window).width() > 1023) {
			      $(".on").removeClass("on");
			      $(".opened").removeClass("opened");
			    }
			  }); 
			  var lastScrollTop = 0;
			  $(window).scroll(function(event){
			    var st = $(this).scrollTop();
			    if (st > lastScrollTop){
			      $(".on").removeClass("on");
			      $(".opened").removeClass("opened");
			    }
			    lastScrollTop = st;
			  });
		    });
		</script>
        <?php wp_footer(); ?> 
    </body>
</html>