<?php get_header(); ?>
<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

        <!-- Cycle through all posts -->
        <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
                <!-- Display featured image in right-aligned floating div -->
                <div style="float: right; margin: 10px">
                    <?php the_post_thumbnail( 'large' ); ?>
                </div>
                <!-- Display Title and Author Name -->
                <strong>Title: </strong><?php the_title(); ?><br />
                <strong>Author: </strong> <?php echo esc_html( get_post_meta( get_the_ID(), 'book_author', true ) ); ?>

                <br />

                <!-- Display yellow stars based on rating -->
                <strong>Rating: </strong>
                <?php
                $nb_stars = intval( get_post_meta( get_the_ID(), 'book_rating', true ) );

                for ( $star_counter = 1; $star_counter <= 5;
                      $star_counter++ ) {
                    if ( $star_counter <= $nb_stars ) {
                        echo '<img src="' . plugins_url( 'ch4-book-reviews/star-icon.png' ) .'" />';
                    } else {
                        echo '<img src="' . plugins_url( 'ch4-book-reviews/star-icon-grey.png' ) . '" />';
                    }
                }
                ?>
            </header>
            <!-- Display book review contents -->
            <div class="entry-content"><?php the_content(); ?></div>
        </article>
            <!-- Display comment form -->
            <?php comments_template( '', true ); ?>
        <?php endwhile; ?>
    </div>
</div>
<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();