function EMO_CPT_Servicios() {

	$labels = array(
		'name'                => _x( 'Servicios', 'Post Type General Name', 'themename' ),
		'singular_name'       => _x( 'Servicio', 'Post Type Singular Name', 'themename' ),
		'menu_name'           => __( 'Servicios', 'themename' ),
		'name_admin_bar'      => __( 'Servicios', 'themename ),
		'parent_item_colon'   => __( 'Parent Service:', 'themename' ),
		'all_items'           => __( 'Todos Servicios', 'themename' ),
		'add_new_item'        => __( 'Add Servicio', 'themename' ),
		'add_new'             => __( 'Añadir Servicio', 'themename' ),
		'new_item'            => __( 'Add Servicio', 'themename' ),
		'edit_item'           => __( 'Edit Servicio', 'themename' ),
		'update_item'         => __( 'Update Service', 'themename' ),
		'view_item'           => __( 'View Service', 'themename' ),
		'search_items'        => __( 'Search Service', 'themename' ),
		'not_found'           => __( 'Not found', 'themename' ),
		'not_found_in_trash'  => __( 'Not found in trash', 'themename' ),
	);
	$rewrite = array(
		'slug'                => _x( 'servicios', 'URL slug'),
		'with_front'          => false,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __( 'Servicios', 'themename ),
		'description'         => __( 'Servicios Manager', 'themename' ),
		'labels'              => $labels,
		'capability_type'     => 'page',
		'hierarchical'        => true,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt'),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 10,
		'menu_icon'           => 'dashicons-list-view',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
	);
	register_post_type( 'servicios', $args );

}
add_action( 'init', 'EMO_CPT_Servicios', 0 );

//REGISTRO CUSTOM POST TYPE
register_post_type( 'servicios', $recursos_args );

    $taxonomy_args = array(
      'labels' => array( 'name' => 'Categorías' ),
      'show_ui' => true,
	  'show_admin_column'          => true,
      'show_tagcloud' => false,
	  'hierarchical'  => true,
	  'query_var' => true,
	  'has_archive'         => true,
      'rewrite' => array( 'slug' => 'categoria' )
    );
    register_taxonomy( 'categoria', array( 'servicios' ), $taxonomy_args );
}

add_action( 'init', 'register_recursos_entities' );

function generate_taxonomy_rewrite_rule( $wp_rewrite ) {
  $rules = array();
  $post_types = get_post_types( array( 'name' => 'servicios', 'public' => true, '_builtin' => false ), 'objects' );
  $taxonomies = get_taxonomies( array( 'name' => 'categoria', 'public' => true, '_builtin' => false ), 'objects' );

  foreach ( $post_types as $post_type ) {
    $post_type_name = $post_type->name; // 'developer'
    $post_type_slug = $post_type->rewrite['slug']; // 'developers'

    foreach ( $taxonomies as $taxonomy ) {
      if ( $taxonomy->object_type[0] == $post_type_name ) {
        $terms = get_categories( array( 'type' => $post_type_name, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0 ) );
        foreach ( $terms as $term ) {
          $rules[$post_type_slug . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
        }
      }
    }
  }
  $wp_rewrite->rules = $rules + $wp_rewrite->rules;

}
