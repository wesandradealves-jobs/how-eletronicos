<?php 
	echo '
	    <div class="midnav">
	      <div class="wrap">
	        <ul class="flex">
	          <li class="flex50"><a data-value="Assistência Técnica" href="#assistencia-tecnica">Assistência Técnica</a></li>
	          <li class="flex50"><a data-value="Manual" href="#manual">Manual</a></li>
	        </ul>
	      </div>
	    </div>
	    <section id="assistencia-tecnica" class="b" style="background:url('.site_url().'/wp-content/uploads/2016/03/suporte_fundo_assist_tecnica.png) center center / cover no-repeat;">
			<div class="wrap">
				<h5 class="b">Postos de Assistência Técnica</h5>
				<div class="flex">
					<div class="flex50 flex">';
	                $query = new WP_Query( array( 'post_type' => 'assistencia-tecnica', 'order' => 'ASC') );
	                if($query->have_posts()=="1"){
	                  while ( $query->have_posts() ) : $query->the_post();
	                  echo '<div class="flex50">
	                    <h3 class="b">'.get_the_title().'</h3>
	                    <br/><br/>
	                    <p class="b">'.get_the_content().'</p> 
	                  </div>';
	                  endwhile; 
	                  wp_reset_query();
	                }
					echo '</div>
					</div>
			</div>
	    </section>
	    <section id="manual" class="b" style="background:url('.site_url().'/wp-content/uploads/2016/03/suporte_fundo_manual.png) center center / cover no-repeat;">
			<div class="wrap flex">
				<div class="flex50"><img src="'.site_url().'/wp-content/uploads/2016/03/suporte_img_manual.png" alt="Manuais" class="b"></div>
				<div class="flex50">
					<h3 class="b">Manual</h3>
					<p class="b">Escolha uma categoria:</p>
				    <select name="categorias" class="b">
				    	<option selected="selected">Selecione uma Categoria</option>';
				    	$category_ids = get_all_category_ids(); 
				    	$args = array('orderby' => 'slug','hide_empty' => FALSE,'parent' => 0);
				    	$categories = get_categories( $args );
				    	foreach ( $categories as $category ) {
				    		echo '<option value="'.$category->name.'">'.$category->name.'</option>';
				    	}
				    echo '</select>					
					<p class="b">Escolha um produto:</p>
					<select name="produtos" class="b">
					        <option selected="selected">Selecione um Produto</option>';
					$args = array('post_type' => 'produto');
					$query = new WP_Query($args);
					while($query -> have_posts()) : $query -> the_post();
					$category = get_the_category(); 
					echo '<option value="'.str_replace(' ', '-', strtolower(get_the_title())).'" class="'.$category[0]->cat_name.'">'.get_the_title().'</option>';
					endwhile; 
					wp_reset_query();
					echo '
					</select>';
      				$args = array('post_type' => 'produto', 'name' => '');
      				$query = new WP_Query($args);
      				while($query -> have_posts()) : $query -> the_post();
      				$category = get_the_category(); 
      				if(get_field('manual')!=""){
      					echo '<a href="'.get_field('manual').'" class="b btn btn_default '.str_replace(' ', '-', strtolower(get_the_title())).'" title="Fazer download do manual">Fazer download do manual</a>';
      				}
      				endwhile; 
      				wp_reset_query();
      				echo '</div>
			</div>
	    </section>';
?>