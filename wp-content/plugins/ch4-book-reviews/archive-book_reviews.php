<?php get_header(); ?>
<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
        <?php if ( have_posts() ) : ?>
            <header class="page-header">
                <h1 class="page-title">Book Reviews</h1>
            </header>
            <table>
                <!-- Display table headers -->
                <tr>
                    <th style="width: 450px"><strong>Title</strong></th>
                    <th><strong>Author</strong></th>
                </tr>
                <!-- Start the Loop -->
                <?php while ( have_posts() ) : the_post(); ?>
                    <!-- Display review title and author -->
                    <tr>
                        <td><a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?></a></td>
                        <td><?php echo esc_html( get_post_meta( get_the_ID(),'book_author', true ) ); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
            <!-- Display page navigation -->
            <?php global $wp_query;
            if ( isset( $wp_query->max_num_pages ) && $wp_query->max_num_pages > 1 ) { ?>
                <nav id="<?php echo $nav_id; ?>">
                    <div class="nav-previous"><?php next_posts_link('<span class="meta-nav">&larr;</span> Older reviews'); ?></div>
                    <div class="nav-next"><?php previous_posts_link('Newer reviews <span class="meta-nav">&rarr;</span>' ); ?></div>
                </nav>
            <?php };
        endif; ?>
    </div>
</div>
<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();