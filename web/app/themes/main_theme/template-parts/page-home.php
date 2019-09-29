<?php
/**
 * The template for displaying home page
 */
?>
<div class="home-page">
    <div class="home-primary">
        <img src="<?php echo esc_url( home_url( '/' ) ) ?>app/uploads/2019/09/hero-picture.png">
        <div class="primary-box">
            <p class="p-box-title">Epicure works with the top chef restaurants in Tel Aviv</p>
            <div class="p-box-search">
                <input id="input-search" type="text" onkeyup="searchFunction()" placeholder="Search for restaurant cuisine, chef" name="input-box" id="input-box" />
                <img class="search-icon" src="<?php echo get_template_directory_uri() ?>/images/search-icon-big.png" />
                <img id="cancel-icon" onclick="emptyInput()" class="cancel-icon" src="<?php echo get_template_directory_uri() ?>/images/cross.png" />
                <input type="hidden" id="url-ajax" value="<?php echo admin_url('admin-ajax.php') ?>" />
                <div id="search-results" class="search-results">
                    <p id="type-results" class="type-results">Restaurants</p>
                    <div id="search-data" class="search-data"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-secondary">
        <div class="s-box-restaurants">
            <p class="s-box-title">THE POPULAR RESTAURANTS IN EPICURE :</p>
            <div class="s-box-cards">
                <?php
                $args = array(
                    'post_type' => 'restaurant',
                    'tax_query' => array(
                        array (
                            'taxonomy' => 'rest_tags',
                            'field' => 'slug',
                            'terms' => 'popular',
                        )
                    ),
                );
                $query = new WP_Query($args);
                while ($query -> have_posts()) :
                    $query -> the_post();
                    global $post;
                    ?>
                    <a href="<?php echo get_post_permalink() ?>">
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
                            <p class="r-card-chef"><?php echo get_the_title(); ?></p>
                        </div>
                    </a>
                <?php
                endwhile;
                wp_reset_postdata();
                wp_reset_query();
                ?>
            </div>
            <a href="/restaurants" class="box-restaurants-link">
                <p>All Restaurants</p>
                <img src="<?php echo get_template_directory_uri() ?>/images/all-restaurants-arrows.png" />
            </a>
        </div>
        <div class="s-box-dishes">
            <p class="s-box-title">SIGNATURE DISH OF :</p>
            <div class="s-box-cards">
                <?php
                $args = array(
                    'post_type'         => 'dish',
                    'post_per_page'     => '3',
                    'meta_query'        => array(
                        array(
                            'key' => 'signature_dish',
                            'compare' => '=',
                            'value' => '1'
                        )
                    ),
                );
                $query = new WP_Query($args);
                while ($query -> have_posts()) :
                    $query -> the_post();
                    global $post;
                    $img_src = '';
                    ?>
                    <div class="dish-card">
                        <p class="d-card-restaurant"><?php echo get_post_meta($post->ID, "dish_restaurant", true) ?></p>
                        <img class="d-card-pic" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>" />
                        <p class="d-card-title"><?php the_title() ?></p>
                        <p class="d-card-ingredients"><?php echo get_post_meta($post->ID, "ingredients", true) ?></p>
                        <?php
                        if(strip_tags(get_the_term_list($post->ID, "type")) == 'vegan') $img_src = get_template_directory_uri().'/images/vegan-e1569395735764.png';
                        if(strip_tags(get_the_term_list($post->ID, "type")) == 'spicy') $img_src = get_template_directory_uri().'/images/spicy-e1569395716828.png';
                        if($img_src != '') echo '<img class="d-card-type" src="'.$img_src.'" />';
                        ?>
                        <div class="d-card-price">
                            <hr class="price-line-divisor">
                            <p class="price-text">₪<?php echo get_post_meta($post->ID, "price", true) ?></p>
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
    <div class="home-meanings">
        <p class="meanings-title">THE MEANINGS OF OUR ICONS :</p>
        <div class="s-box-cards">
            <div class="icon-meaning">
                <img src="<?php echo get_template_directory_uri() ?>/images/spicy-icon.png" />
                <p>Spicy</p>
            </div>
            <div class="icon-meaning">
                <img src="<?php echo get_template_directory_uri() ?>/images/vegetarian-icon-e1569400865260.png" />
                <p>Vegetarian</p>
            </div>
            <div class="icon-meaning">
                <img src="<?php echo get_template_directory_uri() ?>/images/vegan-icon-e1569400856845.png" />
                <p>Vegan</p>
            </div>
        </div>
    </div>
    <div class="home-chefweek">
        <p class="chefweek-title">CHEF OF THE WEEK :</p>
        <div class="chefweek-box">
            <div class="chef-profile">
                <img src="<?php echo get_template_directory_uri() ?>/images/yossi-shitrit.png" />
                <span>Yossi Shitrit</span>
            </div>
            <div class="chef-biography">
                <p>Chef Yossi Shitrit has been living and breathing his culinary dreams for more than two decades, including running the kitchen in his first restaurant, the fondly-remembered Violet, located in Moshav  Udim. Shitrit's creativity and culinary  acumen born of long experience  are expressed in the every detail of each and
                    every dish.</p>
            </div>
        </div>
        <div class="chefweek-restaurants">
            <p class="cw-rest-title">Yossi's restaurants :</p>
            <div class="cw-box-cards">
                <div class="cw-rest-card">
                    <img src="<?php echo get_source_for_images()?>onza.png"/>
                    <p>Onza</p>
                </div>
                <div class="cw-rest-card">
                    <img src="<?php echo get_source_for_images()?>kitchen-market.png"/>
                    <p>Kitchen Market</p>
                </div>
                <div class="cw-rest-card">
                    <img src="<?php echo get_source_for_images()?>mashya.png"/>
                    <p>Mashya</p>
                </div>
            </div>
        </div>
    </div>
    <div class="home-about">
        <div class="about-left">
            <p class="about-title">ABOUT US :</p>
            <p class="about-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a lacus vel justo fermentum bibendum non
                eu ipsum. Cras porta malesuada eros, eget blandit
                turpis suscipit at.  Vestibulum sed massa in magna sodales porta.  Vivamus elit urna,
                dignissim a vestibulum.
                <br><br>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a lacus vel justo fermentum bibendum no
                eu ipsum. Cras porta malesuada eros.
            </p>
            <div class="about-dw">
                <img src="<?php echo get_template_directory_uri() ?>/images/apple.png" />
                <div class="about-dw-text">
                    <p class="dw-text-normal">Download on the</p>
                    <p class="dw-text-bigger">App Store</p>
                </div>
            </div>
            <div class="about-dw">
                <img src="<?php echo get_template_directory_uri() ?>/images/android.png" />
                <div class="about-dw-text">
                    <p class="dw-text-normal">Get it on</p>
                    <p class="dw-text-bigger">Google Play</p>
                </div>
            </div>
        </div>
        <div class="about-right">
            <img src="<?php echo get_template_directory_uri() ?>/images/about-logo.png"/>
        </div>
    </div>
</div>