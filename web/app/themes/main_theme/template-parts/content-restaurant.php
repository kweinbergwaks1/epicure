<?php
/**
 * The page for displaying a restaurant
 */
?>
<div class="restaurant-site">
    <div class="picture-section">
        <img src="<?php echo get_template_directory_uri()  ?>/images/banner.png" />
    </div>
    <div class="profile-section">
        <p class="title-profile"><?php the_title() ?></p>
        <?php
        $post_object = get_field('owner_chef');

        if( $post_object ) {
            // override $post
            $post = $post_object;
            setup_postdata( $post );
        }
        ?>
        <p class="chef-profile"><?php echo get_the_title() ?></p>
        <?php
        $tags = strip_tags(get_the_term_list($post->ID, "rest_tags"));
        if(strpos($tags, 'open') !== false) {
            echo '<div class="open-profile">
                    <img src="'.get_template_directory_uri().'/images/clock-icon.png"
                    <p>Open now</p>
                  </div>';
        }
        wp_reset_postdata();
        ?>
    </div>
    <div class="filter-section">
        <div class="display-filter">
            <div class="item-filter">
                <a href="<?php echo esc_url( add_query_arg( 'filter', 'breakfast' ) ); ?>">Breakfast</a>
                <img src="<?php echo get_template_directory_uri() ?>/images/line.png" id="breakfast" class="display-filter" />
            </div>
            <div class="item-filter">
                <a href="<?php echo esc_url( add_query_arg( 'filter', 'lunch' ) ); ?>">Lunch</a>
                <img src="<?php echo get_template_directory_uri() ?>/images/line.png" id="lunch" class="display-filter" />
            </div>
            <div class="item-filter">
                <a href="<?php echo esc_url( add_query_arg( 'filter', 'dinner' ) ); ?>">Dinner</a>
                <img src="<?php echo get_template_directory_uri() ?>/images/line.png" id="dinner" class="display-filter" />
            </div>
        </div>
    </div>
    <div class="dishes-results">
        <div class="s-box-cards">
            <?php
            $query = new WP_Query(get_arguments_for_content_restaurant_loop());
            while ($query -> have_posts()):
            $query -> the_post();
            global $post;
            ?>
            <div class="dish-card">
                <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>" />
                <p class="d-card-title"><?php the_title() ?></p>
                <p class="d-card-ingredients"><?php echo get_post_meta($post->ID, "dish_ingredients", true) ?></p>
                <div class="d-card-price">
                    <hr class="price-line-divisor">
                    <p class="price-text">₪<?php echo get_post_meta($post->ID, "dish_price", true) ?></p>
                    <hr class="price-line-divisor">
                </div>
            </div>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>
<script>
    var element = document.getElementById("<?php echo get_query_var('filter', 'breakfast') ?>");
    element.classList.add("show");
</script>
