<?php

// this is the format for a single item

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
            <?php the_content(); ?>
        </div>
        <p>Posted on: <?php the_date(); ?> at: <?php the_time(); ?></p>
        <?php
    endwhile;
endif;
get_footer();
