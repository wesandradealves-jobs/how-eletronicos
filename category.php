<?php get_header(); ?>
<main class="b">
	<?php 
		$category = get_the_category(); 
		echo '<section id="webdoor" class="flex" style="background-color:'; 
		if(get_field('cor_do_banner',12)==""||get_field('cor_do_banner',12)=="#eaeaea") { echo "#eaeaea"; } else { echo get_field('cor_do_banner',12)."; color:#fff !important;"; } echo '">
			<div class="flex100 flex">
				<div class="flex50">
				<h1 class="b">'.$category[0]->cat_name.'</h1>';
			echo '</div>
				<div class="flex50"><img src="'.wp_get_attachment_url(get_post_thumbnail_id(12)).'" alt="'.get_the_title().'"></div>
			</div>
		</section>
		<div id="breadcrumb" class="b">
			<div class="wrap">
				<ul>
					<li><a href="'.site_url().'" title="Página Inicial">Página Inicial</a></li>
					<li><a href="'.site_url().'/produtos/" title="Produtos">Produtos</a></li>
					<li>'.$category[0]->cat_name.'</li>
				</ul>
			</div>
		</div>';

		$args = array('post_type' => 'produto', 'cat' => $category[0]->term_id, 'order' => 'ASC');
		$query = new WP_Query($args);
		if($query->have_posts()=="1"){
			echo '<section id="produtos" class="b">
					<div class="wrap">
						<ul class="flex">';
			while($query -> have_posts()) : $query -> the_post();
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
</main>
<?php get_footer(); ?>

