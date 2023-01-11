<?php
/**
 * Create the panel
 * @param int $post_id Current post id
 */
function create_meta_box($post_id) {
    $post_type = get_post_type($post_id);
    if ($post_type === 'movies') {
        add_meta_box('movies-rating', 'Rating', 'rating_callback',
        null, 
        "side", 
        "high",
        'rating',);
    }
}
add_action('add_meta_boxes_movies', 'create_meta_box');

/**
 * Meta box display callback. TO display all the data from the API
 *
 * @param WP_Post $post Current post object.
 */
function rating_callback($post)
{
    ?>
    <div class="meta_box">
        <p class="meta-options orchestrated_meta_field">
            <label for="rating">Rating</label>
            <input id="rating"
                type="number"
                min="0"
                max="5"
                step="1"
                name="rating"
                oninput="this.value=(parseInt(this.value)||0)"
                pattern="[0-5]"
                value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'rating', true)); ?>">
        </p>
    </div>
    <?php

}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function save_rating_meta_box($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if ($parent_id = wp_is_post_revision($post_id)) {
        $post_id = $parent_id;
    }    
    if (array_key_exists('rating', $_POST)) {
        $value = intval($_POST['rating']);
        if ($value > 5) {
            $value = 0;
        }
        update_post_meta($post_id, 'rating', sanitize_text_field($value));
    }
}
add_action('save_post', 'save_rating_meta_box');