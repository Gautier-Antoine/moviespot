<?php

/**
 * SetUp the taxonomy
 * retrieve the array and call custom_taxonomy() for each of them
 */
function start_taxonomies() {
	$taxonomies = get_taxonomies_details();
	if (!empty($taxonomies)) {
		foreach ( $taxonomies as $slug => $tax ) {
			custom_taxonomy_registerer($slug, $tax);
		}
	}
}
add_action( 'init', 'start_taxonomies', 0 );


/**
 * Array of all the taxonomies to create
 * 
 * @return Array
 */
function get_taxonomies_details() {
	return [
		'release-years' => [
			'singular' => 'Release Year',
			'plural' => 'Release Years',
			'hierarchical' => false,
		],

		'genres' => [
			'singular' => 'Genre',
			'plural' => 'Genres',
			'hierarchical' => false,
		],

		'publishers' => [
			'singular' => 'Publisher',
			'plural' => 'Publishers',
			'hierarchical' => true,
		]
	];
}
/**
 * register the taxonomy
 */
function custom_taxonomy_registerer($slug, $tax) {

	$labels = array(
		'name'                       => _x( $tax['plural'], 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( $tax['singular'], 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( $tax['singular'], 'text_domain' ),
		'all_items'                  => __( 'All ' . $tax['plural'], 'text_domain' ),
		'parent_item'                => __( 'Parent ' . $tax['singular'], 'text_domain' ),
		'parent_item_colon'          => __( 'Parent ' . $tax['singular'] . ':', 'text_domain' ),
		'new_item_name'              => __( 'New '.$tax['singular'].' Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New '.$tax['singular'], 'text_domain' ),
		'edit_item'                  => __( 'Edit '.$tax['singular'], 'text_domain' ),
		'update_item'                => __( 'Update '.$tax['singular'], 'text_domain' ),
		'view_item'                  => __( 'View '.$tax['singular'], 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate ' . $tax['plural'] . ' with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove ' . $tax['plural'], 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular ' . $tax['plural'], 'text_domain' ),
		'search_items'               => __( 'Search ' . $tax['plural'], 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No ' . $tax['plural'], 'text_domain' ),
		'items_list'                 => __( $tax['plural'] . ' list', 'text_domain' ),
		'items_list_navigation'      => __( $tax['plural'] . ' list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => $tax['hierarchical'],
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
    // ? Movies part of all those taxonomies
	register_taxonomy( $slug, array( 'movies' ), $args );

}
