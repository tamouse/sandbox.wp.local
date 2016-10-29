<?php

// This is the index page for the post type 'employee'.
// We have to do a WP Query on this one, since we are getting something
// quite different than a regular post.
//
// In depth: https://codex.wordpress.org/Class_Reference/WP_Query

get_header();

// Setting up the query, this will retrieve the latest 10 employee post types
$q = array(
    'post_type' => 'employee',
    'posts_per_page' => 10
);

$loop = new WP_Query( $q );

// note object notation here -- we still use the same methods, but on the
// specific query object, up to the point we execute `the_post()` method on the query object.
// after that, we use the bits that refer to the global post data.
// (I personally find this abhorent.)
if ( $loop->have_posts() ) :
    while ($loop->have_posts()) :
        $loop->the_post(); ?>
        <div class="row">
            <div class="col-xs-12">
                <h2>
                    <?php the_title(); ?>
                    <small>
                        Last updated on: <?php echo the_date(); ?> at: <?php echo the_time(); ?>
                    </small>
                </h2>

                <div><?php the_content(); ?></div>
                <footer class="text-muted">
                    <small>
                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Permanent Link</a>
                    </small>
                </footer>
            </div>
        </div>
        <?php
    endwhile;
endif;

// NOTE: THE FOLLOWING IS HUGELY IMPORTANT!!
// Because `the_post()` sets up PHP global variables, you have to reset
// that data after using it with the query above.
wp_reset_postdata();

get_footer();

