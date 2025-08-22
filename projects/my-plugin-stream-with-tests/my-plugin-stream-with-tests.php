<?php

/**
 * Plugin Name:     My Plugin (Stream) with Tests
 * Plugin URI:      https://juanma.codes
 * Description:     A plugin for testing (stream)
 * Author:          JuanMa
 * Author URI:      YOUR SITE HERE
 * Text Domain:     my-plugin-stream-with-tests
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         My_Plugin_Stream_With_Tests
 */

// Your code starts here.

// Register the WPM setting during admin_init.
function qrt_register_settings()
{
    register_setting('qrt_settings_group', 'qrt_wpm', array(
        'type' => 'integer',
        'sanitize_callback' => 'qrt_sanitize_wpm',
        'default' => 200,
    ));
}
add_action('admin_init', 'qrt_register_settings');

// Sanitize the WPM value.
function qrt_sanitize_wpm($value)
{
    $value = intval($value);
    return ($value > 0) ? $value : 200;
}

// Add a settings page under Settings.
function qrt_register_settings_page()
{
    add_options_page(
        'Quick Reading Time',
        'Quick Reading Time',
        'manage_options',
        'qrt-settings',
        'qrt_render_settings_page'
    );
}
add_action('admin_menu', 'qrt_register_settings_page');

// Render the settings page.
function qrt_render_settings_page()
{
    if (! current_user_can('manage_options')) {
        return;
    }
?>
    <div class="wrap">
        <h1><?php esc_html_e('Quick Reading Time Settings', 'quick-reading-time'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('qrt_settings_group');
            do_settings_sections('qrt_settings_group');
            $wpm = get_option('qrt_wpm', 200);
            ?>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row">
                        <label for="qrt_wpm"><?php esc_html_e('Words Per Minute', 'quick-reading-time'); ?></label>
                    </th>
                    <td>
                        <input name="qrt_wpm" type="number" id="qrt_wpm" value="<?php echo esc_attr($wpm); ?>" class="small-text" min="1" />
                        <p class="description"><?php esc_html_e('Average reading speed for your audience.', 'quick-reading-time'); ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

// Add the reading time badge to post content.
function qrt_add_reading_time($content)
{
    if (! is_singular('post') || ! in_the_loop() || ! is_main_query()) {
        return $content;
    }
    $plain   = wp_strip_all_tags(strip_shortcodes($content));
    $words   = str_word_count($plain);
    $wpm     = (int) get_option('qrt_wpm', 200);
    $minutes = max(1, ceil($words / $wpm));
    $badge = sprintf(
        '<p class="qrt-badge" aria-label="%s"><span>%s</span></p>',
        esc_attr__('Estimated reading time', 'quick-reading-time'),
        esc_html(sprintf(_n('%s min read', '%s mins read', $minutes, 'quick-reading-time'), $minutes))
    );
    return $badge . $content;
}
add_filter('the_content', 'qrt_add_reading_time');

// Enqueue the plugin stylesheet.
function qrt_enqueue_assets()
{
    wp_enqueue_style(
        'qrt-style',
        plugin_dir_url(__FILE__) . 'style.css',
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'qrt_enqueue_assets');
