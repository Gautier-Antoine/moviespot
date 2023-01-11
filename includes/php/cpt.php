<?php
/**
 * Create the cpt
 *
 * @return void
 */
function create_cpt(){

    if (!post_type_exists( 'movies' )){
        register_post_type(
            'movies',
            [
                'public'       => true,
                'labels'       => [
                    'name'         => 'Movies',
                    'singular' => 'Movie',
                    'add_new_item' => 'Add New ' . 'Movie',
                    'edit_item'    => 'Edit ' . 'Movie',
                    'all_items'    => 'All ' . 'Movies',
                ],
                'menu_icon' => 'dashicons-video-alt',
                'capability_type' => 'post',
                'show_in_menu' => true,
                'show_in_rest' => true,
                'supports'     => [
                    'title',
                    'editor',
                    'author',
                    'thumbnail',
                    'excerpt',
                    // 'trackbacks',
                    'custom-fields', 
                    // 'comments', 
                    // 'revisions', 
                    'page-attributes', 
                    'post-formats', 
                ],
                'has_archive' => true,
                'hierarchical' => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                // 'rewrite'      => [ 'slug' => 'teams' ],
                // 'template'     => [ [ 'dqcblocks/member' ] ],
            ]
        );
    }
}
add_action('init', 'create_cpt');