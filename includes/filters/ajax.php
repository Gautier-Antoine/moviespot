<?php
/**
 *  AJAX callback
 */
function movies_search_callback()
{
    header("Content-type: application/json");
    $publisher = (isset($_GET['publisher'])) ? sanitize_text_field($_GET['publisher']) : 'all';
    $years = (isset($_GET['years'])) ? sanitize_text_field($_GET['years']) : 'all';
    $genre = (isset($_GET['genre'])) ? sanitize_text_field($_GET['genre']) : 'all';
    $sortby = (isset($_GET['sortby'])) ? sanitize_text_field($_GET['sortby']) : 'date';
    $sort = (isset($_GET['sort'])) ? sanitize_text_field($_GET['sort']) : "false";
    $args = [
        "post_type" => "movies",
        "posts_per_page" => -1,
        'order' => 'DESC',
    ];
    if ($sortby != 'date') {
        $args['orderby'] = 'meta_value';
        $args['meta_key'] = 'rating';
    } else {
        $args['orderby'] = 'date';

    }
    $args['order'] = ("false" !== $sort) ? 'ASC' : 'DESC';

    if ($publisher != "all") {
        $args['tax_query'][] = [
                    'taxonomy' => 'publishers',
                    'field'    => 'slug',
                    'terms'    => $publisher,
                    'include_children' => false
        ];
    }
    if ($years != "all") {
        $args['tax_query'][] = [
                    'taxonomy' => 'release-years',
                    'field'    => 'slug',
                    'terms'    => $years
        ];
    }
    if ($genre != "all") {
        $args['tax_query'][] = [
                    'taxonomy' => 'genres',
                    'field'    => 'slug',
                    'terms'    => $genre
        ];
    }
    $response = [];

    $movies_query = new WP_Query($args);
    while ($movies_query->have_posts()) {
        $movies_query->the_post();
        $response[] = [
            "title" => get_the_title(),
            "permalink" => get_permalink(),
            "excerpt" => get_the_excerpt(),
            "rating" => get_post_meta(get_the_ID(), 'rating', true),
        ];
    }
    $response = json_encode($response);
    echo $response;
    wp_die();
}
add_action('wp_ajax_movies_search', 'movies_search_callback');
add_action('wp_ajax_nopriv_movies_search', 'movies_search_callback');

