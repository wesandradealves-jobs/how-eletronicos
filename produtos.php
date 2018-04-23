<?php 
	$category_ids = get_all_category_ids(); 
	$args = array('orderby' => 'slug','hide_empty' => FALSE,'parent' => 0);
	$categories = get_categories( $args );
	
		echo '<div class="midnav">
			<div class="wrap">
				<ul class="flex">
					<li class="flex33 ativo"><a href="javascript:void(0)" data-value="Todos">Todos</a></li>';
	  				foreach ( $categories as $category ) {
	    				echo '<li class="flex33"><a href="javascript:void(0)" data-value="'.$category->name.'">'.$category->name.'</a></li>';
					}
			echo '</ul>
			</div>
		</div>';

		$args = array('post_type' => 'produto', 'order' => 'ASC');
		$query = new WP_Query($args);
		if($query->have_posts()=="1"){
			echo '<section id="produtos" class="b">
					<div class="wrap">
						<ul class="flex">';
			while($query -> have_posts()) : $query -> the_post();
			$category = get_the_category(); 
			        echo '<li class="flex33 '.$category[0]->cat_name.'">
					<div class="flex">';
				        echo '<div onclick="document.location='; 
				        echo "'".get_the_permalink()."';return false;";
				          echo '" class="flex100" style="background-image:url('; 
							if(get_field('imagem_de_destaque')=="Sim"){
								echo get_field('imagem_destaque');
							} else {
								echo wp_get_attachment_url(get_post_thumbnail_id($post->ID));
							}
							echo ');"> <!-- -->
						</div>
						<div class="flex70"><h2 class="b"><a href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h2></div>
						<div class="flex30"><p class="b"><a href="'.get_category_link( $category[0]->term_id ).'" title="'.$category[0]->cat_name.'">'.$category[0]->cat_name.'</a></p></div>
					</div>
				</li>';
			endwhile;
			wp_reset_query();
			echo '</ul>
					</div>
						</section>';
		}
?>