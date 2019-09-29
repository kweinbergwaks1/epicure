<?php
/**
 * The template for displaying chefs page
 */
?>
<div class="restaurant-page">
    <div class="title-section">
        <p>The chefs of EPICURE</p>
    </div>
    <div class="results-restaurants">
        <div class="s-box-cards">
            <?php
            $query = new WP_Query(array('post_type' => 'chef'));
            while ($query -> have_posts()):
                $query -> the_post();
                global $post;
                ?>
                <a class="link-restaurant-card-result" href="<?php echo get_post_permalink() ?>">
                    <div class="chef-profile">
                        <img src="<?php echo get_template_directory_uri() ?>/images/yossi-shitrit.png"/>
                        <span><?php the_title() ?></span>
                    </div>
                </a>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>