<?php
/**
 * The page for displaying chef
 */
?>
<div class="content-chef">
    <div class="home-chefweek">
        <p class="chefweek-title"><?php the_title() ?></p>
        <div class="chefweek-box">
            <div class="chef-profile">
                <img src="<?php echo get_template_directory_uri() ?>/images/yossi-shitrit.png" />
            </div>
            <div class="chef-biography">
                <p><?php echo get_post_meta($post->ID, "biography", true) ?></p>
            </div>
        </div>
        <div class="chefweek-restaurants">
            <?php
            $names = explode(' ', get_the_title());
            ?>
            <p class="cw-rest-title"><?php echo $names[0] ?>'s restaurants :</p>
            <div class="cw-box-cards">
                <?php
                $post_objects = get_field('restaurants');
                if( $post_objects ): ?>
                    <?php foreach( $post_objects as $post): ?>
                        <?php setup_postdata($post); ?>
                    <a href="<?php the_permalink() ?>">
                        <div class="cw-rest-card">
                            <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID))?>"/>
                            <p><?php the_title() ?></p>
                        </div>
                    </a>
                    <?php endforeach; ?>
                    <?php
                    wp_reset_postdata();
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
