<?php 

if(get_theme_mod('webdoor')){
	if(get_theme_mod('webdoor')=="normal"){
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$query = new WP_Query( array( 'post_type' => 'webdoor', 'posts_per_page' => 1, 'offset' => $offset, 'order' => 'ASC') );
		if($query->have_posts()=="1"){
			echo '<section id="webdoor" class="b">
					<div class="wrap">';			
						while ( $query->have_posts() ) : $query->the_post();
							echo '<style type="text/css">#webdoor{background-image:url('.wp_get_attachment_url(get_post_thumbnail_id($post->ID)).');}</style>';
							echo '<h1 class="b">'.get_the_title().'</h1>';
							echo '<p class="b">'.get_the_content().'</p>';
							if(get_field('url')){
								echo '<a href="http://'.get_field('url').'" class="b btn btn_default" title="'.get_the_title().'">Saiba Mais</a>';
							}
						endwhile; 
						wp_reset_query();	
			echo '</div>
					</section>';		
		}
	} else {
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$query = new WP_Query( array( 'post_type' => 'produto', 'posts_per_page' => 1, 'offset' => $offset, 'order' => 'ASC', 'meta_key' => 'e_webdoor', 'meta_value' => 'Sim' ) );
		if($query->have_posts()=="1"){
			echo '<section id="webdoor" class="b">
					<div class="wrap">';				
						while ( $query->have_posts() ) : $query->the_post();
							echo '<style type="text/css">#webdoor{background-image:url('.wp_get_attachment_url(get_post_thumbnail_id($post->ID)).');}</style>';
							echo '<h1 class="b">'.get_the_title().'</h1>';
							echo '<p class="b">'.get_the_content().'</p>';
							if(get_field('url')){
								echo '<a href="http://'.get_field('url').'" class="b btn btn_default" title="'.get_the_title().'">Saiba Mais</a>';
							}
						endwhile; 
						wp_reset_query();	
			echo '</div>
					</section>';		
		}
	}
}

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$query = new WP_Query( array( 'post_type' => 'servico', 'posts_per_page' => 2, 'offset' => $offset, 'order' => 'ASC') );
if($query->have_posts()=="1"){
	echo '<section id="servicos" class="b">
			<div class="wrap">
				<h1 class="b">Confira os produtos e serviços que a How oferece para você</h1>';	
				echo '<ul class="b flex">';		
				while ( $query->have_posts() ) : $query->the_post();
					if(get_field('url_externa')=="Sim"){
						echo '<li class="flex50 has_url" onclick="document.location='."'".site_url()."/".strtolower(get_field('url'))."'".';return false;">
								<img src="'.wp_get_attachment_url(get_post_thumbnail_id($post->ID)).'" alt="'.get_the_title().'" class="b" />
								<h3 class="b">'.get_the_title().'</h3>';
								echo '<p class="b">'.get_the_content().'</p>
							</li>';
					} else {
						echo '<li class="flex50">
								<img src="'.wp_get_attachment_url(get_post_thumbnail_id($post->ID)).'" alt="'.get_the_title().'" class="b" />
								<h3 class="b">'.get_the_title().'</h3>';
								echo '<p class="b">'.get_the_content().'</p>
							</li>';
					}
				endwhile; 
				wp_reset_query();	
	echo '</ul>
			</div>
				</section>';		
}

$args = array('post_type' => 'produto','meta_key' => 'destaque', 'meta_value' => 'Sim');
$query = new WP_Query($args);
if($query->have_posts()=="1"){
	echo '<section id="vitrine" class="b"><ul class="flex vitrines">';
	while($query -> have_posts()) : $query -> the_post();
		echo '
		<li class="flex100">
			<div class="flex wrap" style="'; 
				if(get_field('destaque_com_margem')=="Sim"){
					if(get_field('margem_do_destaque') == "Full"){
						echo 'padding:60px 0;';	
					} else {
						echo 'padding-'.get_field('margem_do_destaque').':60px;';
					}
				}
				echo '">
				<div class="flex50"><img src="';
				if(get_field('imagem_de_destaque')=="Sim"){
					echo get_field('imagem_destaque');
				} else {
					echo wp_get_attachment_url(get_post_thumbnail_id($post->ID));
				}
				echo '" alt="'.get_the_title().'"  /></div>
				<div class="flex50">
					<h1 class="b">'.get_the_title().'</h1>
					<p class="b">';
					if(get_field('tem_teaser')=="Sim"){ 
						echo get_field('teaser'); 
					} else { 
						echo get_the_content(); 
					}
				echo '</p>
				<a class="b btn btn_default" href="'.get_the_permalink().'" title="'.get_the_title().'">Veja Mais</a>
				</div>
			</div>
		</li>';
	endwhile;
	wp_reset_query();
	echo '</ul></section>';
}

?>