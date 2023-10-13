function post_in_navigation()
{
    $categories = get_the_category();
    $category = !empty($categories) ? $categories[0] : null;

    $query_args = array(
        'cat' => $category->term_id,
        'posts_per_page' => -1,
        'order' => 'ASC',
    );
    $custom_query = new WP_Query($query_args);

    ob_start();
?>
    <div class="post-navigation">
        <div class="nav-previous">
            <?php

            $previous_post_link = previous_post_link('%link', '<i class="fas fa-chevron-left"></i> PREV', false, '', 'category');

            if (empty($previous_post_link)) {
                echo '<a><i class="fas fa-chevron-left"></i> PREV</a>';
            } else {
                echo $previous_post_link;
            }
            ?>
        </div>
        <div class="nav-list"><a href="<?php echo esc_url(home_url()); ?>/News">LIST</a></div>
        <div class "nav-next">
            <?php
            wp_reset_postdata(); // Reset post data
            $next_post_link = next_post_link('%link', ' NEXT <i class="fas fa-chevron-right"></i>', false, '', 'category');
            if (empty($next_post_link)) {
                echo '<a> NEXT <i class="fas fa-chevron-right"></i></a>';
            } else {
                echo $next_post_link;
            }
            ?>
        </div>
    </div>
<?php
    // Restore the original post data
    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('post_in_navigation_', 'post_in_navigation');
