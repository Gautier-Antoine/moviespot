<?php

/**
 * Create the array for select
 * 
 * @param String $tax taxonomy slug
 * @return Array
 */
function get_array_tax($tax) {
    $array = [
        "all" => "All " . ucfirst($tax),
    ];
    $terms = get_terms([
        'taxonomy' => $tax,
        'hide_empty' => true,
    ]);
    if (!empty($terms)) {
        foreach($terms as $term) {
            $array[$term->slug] = $term->name;
            if( $term->parent !== 0 ) {
                $array[$term->slug] = '- ' . $term->name;
            }
        }
    }
    return $array;
}

$releaseYears_array = get_array_tax('release-years');
$genres_array = get_array_tax('genres');
$publishers_array = get_array_tax('publishers');
$sortby = ['date', 'rating'];

wp_enqueue_script('movies-search', get_template_directory_uri() . '/includes/filters/movies-search.js', array('jquery'), false, true);
wp_localize_script('movies-search', 'ajax_url', [admin_url('admin-ajax.php')]);
// wp_enqueue_style('style-css', get_template_directory_uri() . '/includes/css/movies-cpt-style.css');

get_header();

$query = new WP_Query(array( 'post_type' => 'movies' ));

if ($query->have_posts()) : ?>
<div id="search-movies" class="movies-container">   
    <h3>Movies Listings</h3>
    <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">

        <?php if ( is_user_logged_in() === true): ?>        
            <select id="genre" name="genre">
                <?php
                    foreach ($genres_array as $key => $value) {
                        ?><option value="<?= $key; ?>"><?= $value; ?></option><?php
                    }
                ?>
            </select>
            <select id="publisher" name="publisher">
                <?php
                    foreach ($publishers_array as $key => $value) {
                        ?><option value="<?= $key; ?>"><?= $value; ?></option><?php
                    }
                ?>
            </select>
            <select id="year" name="year">
                <?php
                    foreach ($releaseYears_array as $key => $value) {
                        ?><option value="<?= $key; ?>"><?= $value; ?></option><?php
                    }
                ?>
            </select>
        <?php endif; ?>

        <select id="sortby" name="sortby">
            <?php
                foreach ($sortby as $value) {
                    ?><option value="<?= $value; ?>"><?= $value; ?></option><?php
                }
            ?>
        </select>
        <input type="hidden" name="post_type" value="movies" />
     </form>
     <div class="results"></div>
     <button>Load more ...</button>
 </div>
<?php else : ?>
<?php endif;
get_footer();
