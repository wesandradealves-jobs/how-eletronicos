<?php 
  get_header(); 
  $category = get_the_category();
  $childargs = array('post_type' => 'vitrine','order' => 'ASC','meta_query' => array(array('value' => get_the_ID())));
  $child_posts = get_posts($childargs);
?>
  <main class="b">
    <?php if ( have_posts () ) : while (have_posts()):the_post();?>
    <?php 
        echo '<section id="webdoor" class="flex" style="background-color:'; 
            if(get_field('cor_do_banner')=="") { 
              echo "#3090e4;"; 
            } else { 
              echo get_field('cor_do_banner').";"; 
            } 
            if(get_field('header_com_margem')=="Sim"){
              echo ' padding-'.get_field('margem_do_header').':60px;';
            } else {
              echo ' padding:0;';
            } 
        echo '">';
        echo '
        <div class="wrap">
          <div class="flex100 flex">
            <div class="flex50">
              <h1 class="b">'.get_the_title().'</h1>';
              if(get_field('tem_teaser')=="Sim"){
                echo '<p class="b">'.get_field('teaser').'</p>';
              } else {
                echo '<p class="b">'.get_the_content().'</p>';
              }
            echo '</div>
            <div class="flex50"><img title="'.get_the_title().'" src="'; 
              if(get_field('outra_imagem_de_banner')=="Sim"){
                echo get_field('imagem_de_banner');
              } else {
                echo wp_get_attachment_url(get_post_thumbnail_id($post->ID));
              }
            echo '"/></div>
            </div>
          </div>
        </section>';
        echo "<script type='text/javascript'>
            jQuery(document).ready(function(){
              var caracteristicas_pos = $('#caracteristicas').offset().top;
              var sticky = new Waypoint.Sticky({
                element: $('#caracteristicas')[0],
                stuckClass: '',
                offset: 0 
              });";
              switch ($category[0]->cat_name) {
                case 'Acessórios':
                  echo "var disparos = new Odometer({ el: $('.disparos')[0], value: 999});
                        var bateria = new Odometer({ el: $('.bateria')[0], value: 999});

                        setTimeout(function(){
                          $('.disparos').html('".get_field('disparos')."');
                          $('.bateria').html('".get_field('bateria')."');
                        }, 5);";
                  break;
                case 'Tablets':
                  echo "var memoria = new Odometer({ el: $('.memoria')[0], value: 9});
                        var bateria = new Odometer({ el: $('.bateria')[0], value: 99});

                        setTimeout(function(){
                          $('.memoria').html('".get_field('armazenamento')."');
                          $('.bateria').html('".get_field('bateria')."');
                        }, 5);";
                  break;
                default:
                  # code...
                  break;
              }
      echo "  });
            </script>";
      echo '<section id="caracteristicas" class="b">
        <div class="wrap">
          <ul class="flex">';
            switch ($category[0]->cat_name) {
              case 'Acessórios':
                echo '
                  <li class="flex33">
                    <div class="b">
                      <p class="disparos"></p>
                      <p>X</p>
                    </div>
                    <p class="zmdi zmdi-camera"><span>Limite de '.get_field('disparos').'X por carga</span></p>
                  </li>
                  <li class="flex33">
                    <div class="b">
                      <p class="bateria"></p>
                      <p>h</p>
                    </div>
                    <p class="zmdi zmdi-battery-alert"><span>Bateria com '.get_field('bateria').' horas de duração</span></p>
                  </li>
                  <li class="flex33">
                    <div class="b">
                      <p class="bluetooth">'.get_field('bluetooth').'</p>
                    </div>
                    <p class="zmdi zmdi-bluetooth"><span>Versão do Bluetooth '.get_field('bluetooth').'</span></p>
                  </li>
                ';
                break;
              case 'Tablets':
                echo '
                  <li class="flex33">
                    <div class="b">
                      <p class="memoria"></p>
                      <p>GB</p>
                    </div>
                    <p class="zmdi zmdi-card-sd"><span>Memória interna '.get_field('armazenamento').'GB';
                    if(get_field('memoria_expansivel')!=""){
                      echo ' expansível até '.get_field('memoria_expansivel').'GB';
                    }
                    echo '</span></p>
                  </li>
                  <li class="flex33">
                    <div class="b">
                      <p class="bateria"></p>
                      <p>h</p>
                    </div>
                    <p class="zmdi zmdi-battery-alert"><span>Bateria com '.get_field('bateria').' horas de duração</span></p>
                  </li>
                  <li class="flex33">
                    <div class="b">
                      <p class="android">'.get_field('android').'</p>
                    </div>
                    <p class="zmdi zmdi-android"><span>Versão do Android '.get_field('android').'</span></p>
                  </li>
                ';
                break;
              default:
                # code...
                break;
            }
      echo '</ul>
        </div>
      </section>
      <div class="midnav">
        <div class="wrap">
          <ul class="flex">
            <li class="flex25"><a data-value="Apresentação" href="#vitrine">Apresentação</a></li>
            <li class="flex25"><a data-value="Galeria" href="#galeria">Galeria</a></li>
            <li class="flex25"><a data-value="Especificações" href="#especificacoes">Especificações</a></li>
            <li class="flex25"><a data-value="Suporte" href="#suporte">Suporte</a></li>
          </ul>
        </div>
      </div>
      <section id="vitrine" class="b">
          <ul class="flex vitrines">';   
            foreach ($child_posts as $child_post) {
              echo '<li class="flex100" style="'; 
              if(get_post_meta($child_post->ID, 'wpcf-vitrine-com-margem', true)=="Sim"){
                echo 'Padding:0px; Padding-'.get_post_meta($child_post->ID, 'wpcf-margem-da-vitrine', true).':60px;';
              } else {
                echo 'padding:60px 0;';
              } 
              echo '">
                <div class="flex wrap">
                  <div class="flex50">'.get_the_post_thumbnail( $child_post->ID, 'post-thumbnail').'</div>
                  <div class="flex50">
                    <h1 class="b">'.get_the_title($child_post -> ID).'</h1>
                    <p class="b">'.get_the_content($child_post -> ID).'</p>
                  </div>
                </div>
              </li>';
            }
            echo '</ul>
      </section>
      <section id="galeria" class="b">
          <div class="grid masonry">
            <div class="grid-sizer"><!-- --></div>
              <div class="grid-item grid-item--width2 grid-item--height1">
                <div class="row">
                  <div class="flex" style="background-color:#eaeaea;background-image:url('.types_render_field('galeria', array('raw'=>'true','index'=>'0')).');"><!-- --></div>
                </div>
              </div>
              <div class="grid-item grid-item--width3">
                <div class="row">
                  <div class="flex" style="background-color:#1aaa4b;background-image:url('.types_render_field('galeria', array('raw'=>'true','index'=>'1')).');"><!-- --></div>
                  <div class="flex" style="background-color:#a23b96;background-image:url('.types_render_field('galeria', array('raw'=>'true','index'=>'2')).');"><!-- --></div>
                </div>
              </div>
              <div class="grid-item grid-item--width3">
                <div class="row">
                  <div class="flex" style="background-color:#ed185b;background-image:url('.types_render_field('galeria', array('raw'=>'true','index'=>'3')).');"><!-- --></div>
                  <div class="flex" style="background-color:#f0d814;background-image:url('.types_render_field('galeria', array('raw'=>'true','index'=>'4')).');"><!-- --></div>
                </div>
              </div>
          </div>
        </section>
        <section id="especificacoes">
          <div class="wrap flex">
            <h3 class="flex100">Especificações</h3>';
            if(get_field('imagem_de_especificação')=="Sim"){
              echo '
                <div class="flex flex70">';
              echo '
              <ul class="flex flex100">';
                switch ($category[0]->cat_name) {
                  case 'Acessórios':
                  echo '
                  <li class="flex25">
                    <i class="zmdi zmdi-smartphone-android"><!-- --></i>
                    <h4 class="b">Compatibilidade</h4>
                    <p class="b">'.get_field('compatibilidade').'</p>
                  </li>
                  <li class="flex25">
                    <i class="zmdi zmdi-input-power"><!-- --></i>
                    <h4 class="b">Alimentação</h4>
                    <p class="b">'.get_field('alimentação').'</p>
                  </li>
                  <li class="flex25">
                    <i class="zmdi zmdi-battery-flash"><!-- --></i>
                    <h4 class="b">Bateria</h4>
                    <p class="b">'.get_field('bateria').'h</p>
                  </li>
                  <li class="flex25">
                    <i class="zmdi zmdi-bluetooth-connected"><!-- --></i>
                    <h4 class="b">Bluetooth</h4>
                    <p class="b">'.get_field('bluetooth').'</p>
                  </li>
                  ';
                  break;
                  case 'Tablets':
                  echo '
                  <li class="flex25">
                    <i class="zmdi zmdi-smartphone-android"><!-- --></i>
                    <h4 class="b">Display</h4>
                    <p class="b">'.get_field('display').' Polegadas</p>
                  </li>
                  <li class="flex25">
                    <i class="zmdi zmdi-card-sd"><!-- --></i>
                    <h4 class="b">Armazenamento</h4>
                    <p class="b">'.get_field('armazenamento').'GB</p>
                  </li>
                  <li class="flex25">
                    <i class="zmdi zmdi-memory"><!-- --></i>
                    <h4 class="b">Processador</h4>
                    <p class="b">'.get_field('processador').'</p>
                  </li>
                  <li class="flex25">
                    <i class="zmdi zmdi-camera"><!-- --></i>
                    <h4 class="b">Câmera</h4>
                    <p class="b">'.get_field('camera').'MP</p>
                  </li>
                  ';
                  break;
                  default:
                                      # code...
                  break;
                }
                echo '
              </ul>
              <div class="flex flex100">
                <div class="flex50">
                  <h3 class="b">'.get_the_title().'</h3>
                  <p class="b">'.get_the_content().'</p>
                </div>
                <div class="flex50">
                  <ul class="b">';
                    switch ($category[0]->cat_name) {
                      case 'Acessórios':
                      echo '
                      <li>
                        <h3 class="b">Tamanho e Peso</h3>
                        <p class="b">'.get_field('tamanho_e_peso').'</p>
                      </li>
                      <li>
                        <h3 class="b">Compatibilidade</h3>
                        <p class="b">'.get_field('compatibilidade').'</p>
                      </li>
                      <li>
                        <h3 class="b">Bluetooth</h3>
                        <p class="b">'.get_field('bluetooth').'</p>
                      </li>
                      <li>
                        <h3 class="b">Bateria</h3>
                        <p class="b">Dura até '.get_field('bateria').' horas</p>
                      </li>
                      ';
                      break;
                      case 'Tablets':
                      echo '
                      <li>
                        <h3 class="b">Tamanho e Peso</h3>
                        <p class="b">'.get_field('tamanho_e_peso').'</p>
                      </li>
                      <li>
                        <h3 class="b">Armazenamento</h3>
                        <p class="b">'.get_field('armazenamento').'GB</p>
                      </li>
                      <li>
                        <h3 class="b">Processador</h3>
                        <p class="b">'.get_field('processador').'</p>
                      </li>
                      <li>
                        <h3 class="b">Bateria</h3>
                        <p class="b">Dura até '.get_field('bateria').' horas</p>
                      </li>
                      ';
                      break;
                      default:
                                          # code...
                      break;
                    }
                    echo '</ul>
                  </div>
                </div>
                ';
                echo '</div>
                <div class="flex30">
                  <img src="'.get_field('imagem_especificação').'" alt="'.get_the_title().'" class="b" />
                </div>
              ';
            } else {
              echo '
                <div class="flex100 flex">';
              echo '
              <ul class="flex flex100">';
                switch ($category[0]->cat_name) {
                  case 'Acessórios':
                  echo '
                  <li class="flex25">
                    <i class="zmdi zmdi-smartphone-android"><!-- --></i>
                    <h4 class="b">Compatibilidade</h4>
                    <p class="b">'.get_field('compatibilidade').'</p>
                  </li>
                  <li class="flex25">
                    <i class="zmdi zmdi-input-power"><!-- --></i>
                    <h4 class="b">Alimentação</h4>
                    <p class="b">'.get_field('alimentação').'</p>
                  </li>
                  <li class="flex25">
                    <i class="zmdi zmdi-battery-flash"><!-- --></i>
                    <h4 class="b">Bateria</h4>
                    <p class="b">'.get_field('bateria').'h</p>
                  </li>
                  <li class="flex25">
                    <i class="zmdi zmdi-bluetooth-connected"><!-- --></i>
                    <h4 class="b">Bluetooth</h4>
                    <p class="b">'.get_field('bluetooth').'</p>
                  </li>
                  ';
                  break;
                  case 'Tablets':
                  echo '
                  <li class="flex25">
                    <i class="zmdi zmdi-smartphone-android"><!-- --></i>
                    <h4 class="b">Display</h4>
                    <p class="b">'.get_field('display').' Polegadas</p>
                  </li>
                  <li class="flex25">
                    <i class="zmdi zmdi-card-sd"><!-- --></i>
                    <h4 class="b">Armazenamento</h4>
                    <p class="b">'.get_field('armazenamento').'GB</p>
                  </li>
                  <li class="flex25">
                    <i class="zmdi zmdi-memory"><!-- --></i>
                    <h4 class="b">Processador</h4>
                    <p class="b">'.get_field('processador').'</p>
                  </li>
                  <li class="flex25">
                    <i class="zmdi zmdi-camera"><!-- --></i>
                    <h4 class="b">Câmera</h4>
                    <p class="b">'.get_field('camera').'MP</p>
                  </li>
                  ';
                  break;
                  default:
                                      # code...
                  break;
                }
                echo '
              </ul>
              <div class="flex flex100">
                <div class="flex50">
                  <h3 class="b">'.get_the_title().'</h3>
                  <p class="b">'.get_the_content().'</p>
                </div>
                <div class="flex50">
                  <ul class="b">';
                    switch ($category[0]->cat_name) {
                      case 'Acessórios':
                      echo '
                      <li>
                        <h3 class="b">Tamanho e Peso</h3>
                        <p class="b">'.get_field('tamanho_e_peso').'</p>
                      </li>
                      <li>
                        <h3 class="b">Compatibilidade</h3>
                        <p class="b">'.get_field('compatibilidade').'</p>
                      </li>
                      <li>
                        <h3 class="b">Bluetooth</h3>
                        <p class="b">'.get_field('bluetooth').'</p>
                      </li>
                      <li>
                        <h3 class="b">Bateria</h3>
                        <p class="b">Dura até '.get_field('bateria').' horas</p>
                      </li>
                      ';
                      break;
                      case 'Tablets':
                      echo '
                      <li>
                        <h3 class="b">Tamanho e Peso</h3>
                        <p class="b">'.get_field('tamanho_e_peso').'</p>
                      </li>
                      <li>
                        <h3 class="b">Armazenamento</h3>
                        <p class="b">'.get_field('armazenamento').'GB</p>
                      </li>
                      <li>
                        <h3 class="b">Processador</h3>
                        <p class="b">'.get_field('processador').'</p>
                      </li>
                      <li>
                        <h3 class="b">Bateria</h3>
                        <p class="b">Dura até '.get_field('bateria').' horas</p>
                      </li>
                      ';
                      break;
                      default:
                                          # code...
                      break;
                    }
                    echo '</ul>
                  </div>
                </div>
                ';    
                echo '</div>
              ';
            }
        echo '</div>
        </section>
        <section id="suporte" class="b">
          <div class="wrap">
            <h5 class="b">Suporte</h5>
            <div class="flex">';
            if(get_field('manual')){
              echo '
                <div class="flex50">
                  <h3 class="b zmdi zmdi-book">Manual</h3>
                  <p class="b">Faça o download do manual de seu <b>'.get_the_title().'</b></p>
                  <a href="'.get_field('manual').'" class="b btn btn_default" title="Fazer download do Manual">Fazer download do Manual</a>';
                  if($category[0]->cat_name=="Tablets"){
                    if(get_field('modems')){
                      echo '<a href="'.get_field('modems').'" class="b btn btn_verde" title="Fazer download da lista de modems">Fazer download da lista de modems</a>';
                    }
                  }
                  echo '
                </div><div class="flex50">';
            } else {
                echo '<div class="flex100">';
            }
            echo '<h3 class="b zmdi zmdi-devices">Assistência Técnica</h3>';
                $query = new WP_Query( array( 'post_type' => 'assistencia-tecnica', 'order' => 'ASC') );
                if($query->have_posts()=="1"){
                  echo '<select name="locations" class="b">';
                  while ( $query->have_posts() ) : $query->the_post();
                  echo '<option value="'.str_replace(' ', '-', strtolower(get_the_title())).'" ';  
                  if(str_replace(' ', '-', strtolower(get_the_title()))=="rio-de-janeiro"){echo 'selected="Selected"';}
                  echo '>'.get_the_title().'</option>';
                  endwhile; 
                  wp_reset_query();
                  echo '</select>';

                  while ( $query->have_posts() ) : $query->the_post();
                  echo '
                  <div data-type="locations" data-value="'.str_replace(' ', '-', strtolower(get_the_title())).'">
                    <h3 class="b">'.get_the_title().'</h3>
                    <p class="b">
                      '.get_the_content().'
                    </p> 
                  </div>
                  ';
                  endwhile; 
                  wp_reset_query();
                }
              echo '
              </div>
            </div>
          </div>
        </section>';
    ?>
    <?php endwhile; ?>
  <?php endif; ?>
  </main>
<?php get_footer(); ?>

