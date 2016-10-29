<?php

// this is the listing or index page that shows the default set of posts.
// of course, you can modify this to do anything, but this is the
// typical place to start.
//
// TODO: figure out what happens when this isn't the default page.
//

get_header();
if ( have_posts() ) :
    while  (have_posts() ) :
        the_post(); ?>
        <h2>
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
        <div>
            <?php the_excerpt(); ?>
        </div>
        <p>Posted on: <?php the_date(); ?> at: <?php the_time(); ?></p>
        <?php
    endwhile;
else :
    echo '<h3>Nothing to show here, move along...</h3>';
endif;
get_footer();
