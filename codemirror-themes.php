<?php
/**
 * Plugin Name: CodeMirror Themes
 * Plugin URI:  https://github.com/tacocode/wp-codemirror-themes
 * Description: Add a custom CodeMirror theme
 * Version:     0.0.1
 * Author:      TacoCode
 * Author URI:  https://github.com/tacocode
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: codemirror-themes
 * Domain Path: /languages
 */
defined('ABSPATH') or die();

class CodeMirror_Themes
{
    /**
     * CodeMirror_Themes constructor.
     */
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
    }

    /**
     * Load the custom CodeMirror theme
     */
    public function enqueue_admin_styles()
    {
        wp_enqueue_style('cm-dracula', plugin_dir_url(__FILE__) . '/css/cm-dracula.css');
    }
}

return new CodeMirror_Themes();
