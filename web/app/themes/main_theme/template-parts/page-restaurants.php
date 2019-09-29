<?php
/**
 * The template for displaying restaurants page
 */
?>
<div class="restaurant-page">
    <div class="filter-list">
        <a href="/restaurants" id="all" class="filter-list">All</a>
        <a href="<?php echo esc_url( add_query_arg( 'filter', 'new' ) ); ?>" id="new" class="filter-list">New</a>
        <a href="<?php echo esc_url( add_query_arg( 'filter', 'popular' ) ); ?>" id="popular" class="filter-list">Most Popular</a>
        <a href="<?php echo esc_url( add_query_arg( 'filter', 'open' ) ); ?>" id="open" class="filter-list">Open Now</a>
    </div>
    <div class="results-restaurants">
        <div class="s-box-cards">
            <?php
            $query = new WP_Query(get_arguments_for_page_restaurants_loop());
            while ($query -> have_posts()):
            $query -> the_post();
            global $post;
            ?>
            <a class="link-restaurant-card-result" href="<?php echo get_post_permalink() ?>">
                <div class="restaurant-card">
                    <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>"/>
                    <p class="r-card-title"><?php the_title() ?></p>
                    <?php
                    $post_object = get_field('owner_chef');

                    if( $post_object ) {
                        // override $post
                        $post = $post_object;
                        setup_postdata( $post );
                    }
                    ?>
                    <p class="r-card-chef"><?php echo get_the_title() ?></p>
                </div>
            </a>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>
<script>
    var element = document.getElementById("<?php echo get_query_var('filter', 'all') ?>");
    element.classList.add("selected");
</script>
