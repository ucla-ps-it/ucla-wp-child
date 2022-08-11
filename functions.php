<?php

add_action("after_setup_theme", "ucla_ps_setup");

function ucla_ps_setup()
{
    remove_theme_support('core-block-patterns');
    add_theme_support("title-tag");
    add_theme_support("automatic-feed-links");
    add_theme_support("post-thumbnails");
    add_theme_support("html5", ["search-form"]);
    add_theme_support("responsive-embeds");
    add_theme_support("editor-styles");
    add_editor_style("style-editor.css");
    add_theme_support("disable-custom-colors");
    add_theme_support("editor-color-palette", [
    [
      "name" => esc_attr__("White", "uclaTheme"),
      "slug" => "white",
      "color" => "#ffffff",
    ],
    [
      "name" => esc_attr__("Grey 10", "uclaTheme"),
      "slug" => "grey-10",
      "color" => "#E5E5E5",
    ],
    [
      "name" => esc_attr__("Grey 40", "uclaTheme"),
      "slug" => "grey-40",
      "color" => "#999",
    ],
    [
      "name" => esc_attr__("Grey 60", "uclaTheme"),
      "slug" => "grey-60",
      "color" => "#666",
    ],
    [
      "name" => esc_attr__("Grey 80", "uclaTheme"),
      "slug" => "grey-80",
      "color" => "#333",
    ],
    [
      "name" => esc_attr__("Black", "uclaTheme"),
      "slug" => "black",
      "color" => "#000",
    ],
    [
      "name" => esc_attr__("UCLA Blue", "uclaTheme"),
      "slug" => "blue",
      "color" => "#2774ae",
    ],
    [
      "name" => esc_attr__("UCLA Gold", "uclaTheme"),
      "slug" => "gold",
      "color" => "#ffd100",
    ],
    [
      "name" => esc_attr__("Darker Blue", "uclaTheme"),
      "slug" => "darker-blue",
      "color" => "#005587",
    ],
    [
      "name" => esc_attr__("Darkest Blue", "uclaTheme"),
      "slug" => "darkest-blue",
      "color" => "#003b5c",
    ],
  ]);

    global $content_width;

    if (! isset($content_width)) {
        $content_width = 1920;
    }
    register_nav_menus(array(
      'main-menu' => esc_html__('Main Menu', 'ucla'),
      'secondary-menu' => esc_html__('Secondary Menu', 'ucla-secondary'),
      'foot-menu' => esc_html__('Foot Menu (Menu name must be "Foot Menu")', 'ucla-foot')
    ));
}

// Load Theme Scripts and Styles
add_action("wp_enqueue_scripts", "ucla_ps_load_scripts");
function ucla_ps_load_scripts()
{
    wp_enqueue_style('physci-style', get_stylesheet_directory_uri() . "/css/ucla-ps.css", [ 'lib-style', 'ucla-style' ], null, "screen");
}



// Title
// add_filter("the_title", "ucla_ps_title");
// function ucla_ps_title($title)
// {
//   if ($title == "") {
//     return "...";
//   } else {
//     return $title;
//   }
// }


/**
 * Remove hard coded thumbnail image dimensions?
 * https://wordpress.stackexchange.com/questions/22302/how-do-you-remove-hard-coded-thumbnail-image-dimensions
 */
add_filter("post_thumbnail_html", "remove_thumbnail_dimensions", 10);
add_filter("image_send_to_editor", "remove_thumbnail_dimensions", 10);
//add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions($html)
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

/**
 * Add media alternate image sizes besides WP defaults
 * https://developer.wordpress.org/reference/functions/add_image_size/
 * add_image_size( string $name, int $width, int $height, bool|array $crop = false )
 */

add_image_size("square", "600", "600", true);
add_image_size("square_thumb", "300", "300", true);

/** REMOVE wp-emoji **/

remove_action("wp_head", "print_emoji_detection_script", 7);
remove_action("wp_print_styles", "print_emoji_styles");

// https://managewp.com/hack-improve-wordpress-toolbar

add_action("admin_bar_menu", "ucla_ps_edit_toolbar", 999);

function ucla_ps_edit_toolbar($wp_toolbar)
{
    $wp_toolbar->remove_node("updates");
    $wp_toolbar->remove_node("comments");
    //$wp_toolbar->remove_node('wp-logo');
    //$wp_toolbar->remove_node('site-name');
    //$wp_toolbar->remove_node('new-content');
    //$wp_toolbar->remove_node('top-secondary');
}

/**
 * Removes some menus by page.
 */
add_action("admin_menu", "ucla_ps_remove_menus");
function ucla_ps_remove_menus()
{
    remove_menu_page("edit-comments.php");
    remove_menu_page("link-manager.php"); //Comments
    //remove_menu_page( 'index.php' );                  //Dashboard
    //remove_menu_page( 'jetpack' );                    //Jetpack*
    //remove_menu_page( 'edit.php' );                   //Posts
    //remove_menu_page( 'upload.php' );                 //Media
    //remove_menu_page( 'edit.php?post_type=page' );    //Pages
    //remove_menu_page( 'themes.php' );                 //Appearance
    //remove_menu_page( 'plugins.php' );                //Plugins
    //remove_menu_page( 'users.php' );                  //Users
    //remove_menu_page( 'tools.php' );                  //Tools
    //remove_menu_page( 'options-general.php' );        //Settings
}

/* Tracking script for Gauges Analytics https://secure.gaug.es/ */
// disabled action and pasted script code in footer.php right before closing body tag
// add_action('wp_footer', 'add_gauges_analytics_tracking_code');
function add_gauges_analytics_tracking_code()
{
    ?>
<script type="text/javascript">
var _gauges = _gauges || [];
(function() {
var t = document.createElement('script');
t.type = 'text/javascript';
t.async = true;
t.id = 'gauges-tracker';
t.setAttribute('data-site-id', '61d7595279f7ec7745a5bda4');
t.setAttribute('data-track-path', 'https://track.gaug.es/track.gif');
t.src = 'https://d2fuc4clr7gvcn.cloudfront.net/track.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(t, s);
})();
</script>
<?php
}

/**
 * PRINT DATE FUNCTIONS
 */

function custom_datetime_object($field_name)
{
    $date = new DateTime($field_name);
    echo $date->format("Ymd");
}

function custom_unixtimestamp($field_name)
{
    $date = new DateTime($field_name);
    echo $date->format("d.m.Y H:i:s");
}

function custom_html_datetime($field_name)
{
    $date = new DateTime($field_name);
    echo $date->format("Y-m-d H:i");
}

function custom_html_date($field_name)
{
    $date = new DateTime($field_name);
    echo $date->format("Y-m-d");
}

function custom_html_time($field_name)
{
    $date = new DateTime($field_name);
    echo $date->format("H:i");
}

function custom_year($field_name)
{
    $date = new DateTime($field_name);
    echo $date->format("Y");
}

function custom_public_date($field_name)
{
    $date = new DateTime($field_name);
    echo $date->format("F j, Y");
}

function custom_public_datetime($field_name)
{
    $date = new DateTime($field_name);
    echo $date->format("F j, Y, g:i a");
}

function custom_public_time($field_name)
{
    $date = new DateTime($field_name);
    echo $date->format("g:i a");
}

function custom_public_date_format($field_name, $format)
{
    //$format = ('l, F j, Y, g:i a');
    $date = new DateTime($field_name);
    echo $date->format($format);
}

// Dashboard Widgets

// Remove WordPress Events & News
add_action("wp_dashboard_setup", "remove_dashboard_widgets");
function remove_dashboard_widgets()
{
    remove_meta_box("dashboard_primary", "dashboard", "side");
    remove_meta_box("dashboard_secondary", "dashboard", "side");
}
