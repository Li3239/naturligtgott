<?php

function mytheme_enqueue()
{
    $theme_directory_uri = get_template_directory_uri();
    wp_enqueue_style("custom-style", $theme_directory_uri . "/style.css");
}
add_action("wp_enqueue_scripts", "mytheme_enqueue");
