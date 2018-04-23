<?php

function themeslug_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'logo_section' , array(
        'title'       => __( 'Logo', 'themeslug' ),
        'priority'    => 1,
        'description' => 'Suba a logo do Site'
    ));

    $wp_customize->add_setting( 'logo' );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
        'label'    => __( 'Logo', 'themeslug' ),
        'section'  => 'logo_section',
        'settings' => 'logo'
    )));   

    // 

    $wp_customize->add_section('footer_section',array(
        'title' => 'Rodapé',
        'description' => '',
        'priority' => 3,
    ));

    $wp_customize->add_setting('fb_page');

    $wp_customize->add_setting('telefone');

    $wp_customize->add_control('fb_page',  array(
        'label' => 'Fanpage',
        'section' => 'footer_section',
        'type' => 'text'
    ));

    $wp_customize->add_control('telefone', array(
        'label' => 'Telefone',
        'section' => 'footer_section',
        'type' => 'text'
    ));

    // 

    $wp_customize->add_section('header', array(
        'title' => 'Header',
        'description' => '',
        'priority' => 2,
    ));

    $wp_customize->add_setting('webdoor', array(
            'default'   => 'normal',
            'transport' => 'postMessage'
        )
    );
     
    $wp_customize->add_control('webdoor', array(
            'section'  => 'header',
            'label'    => 'Webdoor',
            'type'     => 'radio',
            'choices'  => array(
                'produtos'    => 'Produtos',
                'normal'   => 'Normal'
            )
        )
    );   
}

add_action( 'customize_register', 'themeslug_theme_customizer' );

function remove_customizer_settings( $wp_customize ){
  $wp_customize->remove_panel('nav_menus');
  $wp_customize->remove_section('static_front_page');
}
add_action( 'customize_register', 'remove_customizer_settings', 20 );

// 

function get_the_category_bytax( $id = false, $tcat = 'category' ) {
    $categories = get_the_terms( $id, $tcat );
    if ( ! $categories )
        $categories = array();

    $categories = array_values( $categories );

    foreach ( array_keys( $categories ) as $key ) {
        _make_cat_compat( $categories[$key] );
    }

    // Filter name is plural because we return alot of categories (possibly more than #13237) not just one
    return apply_filters( 'get_the_categories', $categories );
}

// 

function get_custom_field_data($key, $echo = false) {
    global $post;
    $value = get_post_meta($post->ID, $key, true);
    if($echo == false) {
        return $value;
    } else {
        echo $value;
    }
}

//

function hide_admin_bar() {
    wp_add_inline_style('admin-bar', '<style> html { margin-top: 0 !important; } </style>');
    return false;
}

add_filter( 'show_admin_bar', 'hide_admin_bar' );

//

function menu() {
  register_nav_menus(
    array(
      'header' => __( 'Header' )
    )
  );
}

add_action( 'init', 'menu' );

//

function updateNumbers() {
    global $wpdb;
    $querystr = "SELECT $wpdb->posts.* FROM $wpdb->posts WHERE $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'post' ";
    $pageposts = $wpdb->get_results($querystr, OBJECT);
    $counts = 0 ;
    if ($pageposts):
    foreach ($pageposts as $post):
    setup_postdata($post);
    $counts++;
    add_post_meta($post->ID, 'incr_number', $counts, true);
    update_post_meta($post->ID, 'incr_number', $counts);
    endforeach;
    endif;
}
 
add_action ( 'publish_post', 'updateNumbers' );
add_action ( 'deleted_post', 'updateNumbers' );
add_action ( 'edit_post', 'updateNumbers' );

// 

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 600, 600 );


update_option( 'siteurl', 'http://www.how.com.br/' );
update_option( 'home', 'http://www.how.com.br/' );

?>
