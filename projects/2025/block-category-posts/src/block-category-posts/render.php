<?php

$args = [
    'cat' => isset($attributes['categoryId']) ? (int) $attributes['categoryId'] : 0
];

// The Query.
$the_query = new WP_Query($args);

echo '<h2>Posts from category ' . $attributes['categoryId'] . '</h2>';
// The Loop.
if ($the_query->have_posts()) {
    echo '<ul>';
    while ($the_query->have_posts()) {
        $the_query->the_post();
        echo '<li>' . esc_html(get_the_title()) . '</li>';
    }
    echo '</ul>';
} else {
    esc_html_e('Sorry, no posts matched your criteria.');
}
// Restore original Post Data.
wp_reset_postdata();
