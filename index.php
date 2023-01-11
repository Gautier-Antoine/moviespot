<?php get_header() ?>
    <?php if (have_posts()): ?>
            <?php while(have_posts()): the_post(); ?>
                <?php the_content(); ?>
        <?php endwhile ?>
    <?php else: ?>
        <h1>No articles.</h1>
    <?php endif; ?>
<?php get_footer() ?>