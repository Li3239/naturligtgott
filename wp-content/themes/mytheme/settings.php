<?php
// This is settings.php file for MyTheme WordPress Theme
// This file handles the theme settings added to the WordPress dashboard

if (!is_admin()) {
    return;
}

add_action('admin_menu', 'mytheme_add_settings');
/*
** add menu into dashboard settings
*/ 
function mytheme_add_settings() {
    add_submenu_page(
        "options-general.php",
        "Butik001",
        "My Theme Setting", // the name will be shown in Settings in dashboard
        "edit_pages",
        "my_store_setting_page_id", // unique menu_slug
        "mytheme_add_setting_callback" // callback function
    );
}

function mytheme_add_setting_callback() {
?>
    <div class="wrap">
        <h2 style="margin-bottom: 30px;">My Theme Settings</h2>
        <form action="options.php" method="post">
            <?php
            settings_fields("butik");
            do_settings_sections("butik");
            submit_button();
            ?>
        </form>
    </div>
<?php
}

add_action('admin_init', 'mytheme_add_settings_init');
/*
** registrerar inställningar tillgängliga på sidan "Butik"
*/
function mytheme_add_settings_init()
{
    //=======================================
    // add block header_setting
    //=======================================
    add_settings_section(
        'header_setting',
        'Header Setting',
        'mytheme_add_header_settings_section', // callback function
        'butik'
    );

    //------------------
    // Hero info
    //------------------
    register_setting(
        "butik",
        "hero_info"
    );
    add_settings_field(
        "hero_info",
        "Hero Info",
        "mytheme_section_setting",
        "butik",
        "header_setting",
        array(
            "option_name" => "hero_info",
            "option_type" => "textarea"
        )
    );

    //=======================================
    // add block footer_setting
    //=======================================
    add_settings_section(
        'footer_setting',
        'Footer Setting',
        'mytheme_add_footer_settings_section', // callback function
        'butik'
    );

    //------------------
    // store footer logo（wordpress built-in media upload library）
    //------------------
    register_setting(
        "butik",
        "store_footer_image"
    );
    add_settings_field(
        "store_footer_image",
        "Store Footer Image",
        "mytheme_image_uploader_setting", // callback function for uploading image
        "butik",
        "footer_setting",
        array(
            "option_name" => "store_footer_image"
        )
    );

    //------------------
    // footer name
    //------------------
    register_setting(
        "butik",
        "store_footer_name"
    );
    add_settings_field(
        "store_footer_name",
        "Store Footer Name",
        "mytheme_section_setting",
        "butik",
        "footer_setting",
        array(
            "option_name" => "store_footer_name",
            "option_type" => "text"
        )
    );

    //------------------
    // footer copyright
    //------------------
    register_setting(
        "butik",
        "store_footer_copyright"
    );
    add_settings_field(
        "store_footer_copyright",
        "Store Footer Copyright",
        "mytheme_section_setting",
        "butik",
        "footer_setting",
        array(
            "option_name" => "store_footer_copyright",
            "option_type" => "text"
        )
    );

    //------------------
    // footer org number
    //------------------
    register_setting(
        "butik",
        "store_footer_org_number"
    );
    add_settings_field(
        "store_footer_org_number",
        "Store Footer Org-number",
        "mytheme_section_setting",
        "butik",
        "footer_setting",
        array(
            "option_name" => "store_footer_org_number",
            "option_type" => "text"
        )
    );

    //=======================================
    // add block email_setting
    //=======================================
    add_settings_section(
        'email_setting',
        'Email Setting',
        'mytheme_add_email_settings_section', // callback function
        'butik'
    );

    //------------------
    // Email Order Summary Info
    //------------------
    register_setting(
        "butik",
        "email_thanks_info"
    );
    add_settings_field(
        "email_thanks_info",
        "Thanks Text In The Email Template",
        "mytheme_section_setting",
        "butik",
        "email_setting",
        array(
            "option_name" => "email_thanks_info",
            "option_type" => "textarea"
        )
    );
    
    //=======================================
    // add block product_listing_setting
    //=======================================
    add_settings_section(
        'product_listing_setting',
        'Product Listing Page Setting',
        'mytheme_add_product_listing_setting_section', // callback function
        'butik'
    );

    //------------------
    // no more to load
    //------------------
    register_setting(
        "butik",
        "no_more_to_load"
    );
    add_settings_field(
        "no_more_to_load",
        "No More To Load Message",
        "mytheme_section_setting",
        "butik",
        "product_listing_setting",
        array(
            "option_name" => "no_more_to_load",
            "option_type" => "textarea"
        )
    );
    
    // //=======================================
    // // add block shipping_setting
    // //=======================================
    // add_settings_section(
    //     'shipping_setting',
    //     'Shipping Setting',
    //     'mytheme_add_shipping_setting_section', // callback function
    //     'butik'
    // );

    // //------------------
    // // free shipping with 
    // // minimum purchase amount
    // //------------------
    // register_setting(
    //     "butik",
    //     "free_shipping_minimum_purchase_amount"
    // );
    // add_settings_field(
    //     "free_shipping_minimum_purchase_amount",
    //     "Free Shipping With Minimum Purchase Amount",
    //     "mytheme_section_setting",
    //     "butik",
    //     "shipping_setting",
    //     array(
    //         "option_name" => "free_shipping_minimum_purchase_amount",
    //         "option_type" => "amount"
    //     )
    // );
    
}

/*
** header section callback function
*/
function mytheme_add_header_settings_section()
{
    echo "<hr>";
    echo "<p> General settings for the store header.</p>";
    echo "<hr>";
}

/*
** footer section callback function
*/
function mytheme_add_footer_settings_section()
{
    echo "<hr>";
    echo "<p> General settings for the store footer.</p>";
    echo "<hr>";
}

/*
** footer section callback function
*/
function mytheme_add_email_settings_section()
{
    echo "<hr>";
    echo "<p> General settings for the store email template.</p>";
    echo "<hr>";
}
/*
** For "lazyload function in product listing page" section callback function
**   eg. No more data to load  
*/
function mytheme_add_product_listing_setting_section()
{
    echo "<hr>";
    echo "<p> General settings for Product Listing page.</p>";
    echo "<hr>";
}
/*
** For "shipping setting" section callback function
**   eg. free shipping minium quantity
*/
// function mytheme_add_shipping_setting_section()
// {
//     echo "<hr>";
//     echo "<p> General settings for Shipping setting.</p>";
//     echo "<hr>";
// }


/*
** draw the Settings page
*/
function mytheme_section_setting($args)
{
    $option_name = $args["option_name"];
    $option_type = $args["option_type"];
    $option_value = get_option($args["option_name"]);

    //render in HTML
    if ($option_type === 'textarea') {
        // render a textarea element
        echo '<textarea id="' . esc_attr($option_name) . '" 
        name="' . esc_attr($option_name) . '"
        rows="5" 
        cols="50">' . esc_textarea($option_value) . '</textarea>';
    }
    // Check if the type is amount
    elseif ($option_type === 'amount') {
        echo '<input type="number" 
                id="' . esc_attr($option_name) . '" 
                name="' . esc_attr($option_name) . '" 
                value="' . esc_attr($option_value) . '"
                step="0.01"  // Allow decimal to be input
                min="0"  // Minimum value should be 0 or any desired base value
                style="text-align: right; width: 100px"
              /> kr';
    } 
    else {
        // render a input element
        echo '<input type="' . esc_attr($option_type) . '" 
                     id="' . esc_attr($option_name) . '" 
                     name="' . esc_attr($option_name) . '" 
                     value="' . esc_attr($option_value) . '"
                     style="width: 300px;"
              />';
    }
}

/*
** WordPress’ built-in media upload library
*/
function mytheme_image_uploader_setting($args) {
    $option_name = $args['option_name'];
    $option_value = get_option($option_name);
    $image_url = !empty($option_value) ? $option_value : '';

    // HTML output for the media uploader
    echo '<div class="image-upload-wrapper">';
    echo '<img id="' . esc_attr($option_name) . '_preview" src="' . esc_url($image_url) . '" style="max-width: 300px; max-height: 300px; display: ' . (!empty($image_url) ? 'block' : 'none') . ';" />';
    echo '<input type="hidden" name="' . esc_attr($option_name) . '" id="' . esc_attr($option_name) . '" value="' . esc_attr($image_url) . '" />';
    echo '<button type="button" onclick="upload_image(\'' . esc_attr($option_name) . '\')">Upload Image</button>';
    echo '<button type="button" onclick="remove_image(\'' . esc_attr($option_name) . '\')" style="margin-left: 10px;">Remove Image</button>';
    echo '</div>';
}

add_action('admin_footer', 'mytheme_admin_footer_scripts');
function mytheme_admin_footer_scripts() {
?>
    <script>
        function upload_image(option_name) {
            var frame = wp.media({
                title: 'Select or Upload Media',
                button: {
                    text: 'Use this media'
                },
                multiple: false
            });

            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                jQuery('#' + option_name).val(attachment.url);
                jQuery('#' + option_name + '_preview').attr('src', attachment.url).show();
            });

            frame.open();
        }

        function remove_image(option_name) {
            jQuery('#' + option_name).val('');
            jQuery('#' + option_name + '_preview').hide();
        }
    </script>
<?php
}

add_action('admin_enqueue_scripts', 'mytheme_enqueue_media_script');
function mytheme_enqueue_media_script() {
    // Get the screen object of the current wordpress dashboard page
    $screen = get_current_screen();
    // only works for "My Theme Setting" page
    // my_store_setting_page_id is the unique id from "add_submenu_page"
    if ('settings_page_my_store_setting_page_id' === $screen->id) {
        // wordpress's build-in function which is supporting to upload media
        wp_enqueue_media();
    }
}
