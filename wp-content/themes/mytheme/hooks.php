<?php

// CHANGES BREADCRUMB DELIMITER
function change_breadcrumb_delimiter( $defaults ) {
    // GET URL FOR THE ICON FROM MEDIA LIBRARY
    $icon_url = 'http://naturligtgott.test/wp-content/uploads/2024/05/breadcrumbarrow.png';

    // REPLACE DELIMITER WITH ICON
    $defaults['delimiter'] = '<img src="' . esc_url( $icon_url ) . '" alt="Breadcrumb Icon" class="breadcrumb-icon">';

    return $defaults;
}
