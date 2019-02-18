<?php
/**
 * Plugin Name: WP CodeMirror Themes
 * Plugin URI:  https://github.com/tacocode/wp-codemirror-themes
 * Description: Add a custom CodeMirror theme
 * Version:     0.0.1
 * Author:      TacoCode
 * Author URI:  https://github.com/tacocode
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp-codemirror-themes
 * Domain Path: /languages
 */
defined('ABSPATH') or die();

class WPCodeMirrorThemes
{
    /**
     * CodeMirror_Themes constructor.
     */
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueueAdminStyles'));
        add_action('admin_menu', array($this, 'optionsPageMenu'));
        add_action('admin_init', array($this, 'initSettings'));
    }

    /**
     * Load the custom CodeMirror theme
     */
    public function enqueueAdminStyles()
    {
        $selected_theme = $this->getSelectedTheme();
        if ('default' != $selected_theme) {
            $theme_path = plugin_dir_path(__FILE__) . 'theme/' . $selected_theme;
            $theme_url = plugins_url('theme/' . $selected_theme, __FILE__);
            if (file_exists($theme_path)) {
                wp_enqueue_style('wp-codemirror-theme-css', $theme_url);
            }
        }
    }

    /**
     * Boilerplate
     */
    public function addSettingsSection()
    {
        // Tutu
    }

    /**
     * Add the theme list dropdown to the options page
     *
     * @param array $args
     */
    public function addThemeSelectSettingsField($args)
    {
        $selected_theme = $this->getSelectedTheme();
        $themes = $this->getThemeList();
        require_once 'includes/theme_list_select.php';
    }

    /**
     * Initialize all plugin sections, settings & fields
     */
    public function initSettings() {
        register_setting(
            'codemirror_theme',
            'codemirror_theme_settings'
        );
        add_settings_section(
            'select_codemirror_theme',
            __('Available CodeMirror Themes', 'wp-codemirror-themes'),
            array($this,'addSettingsSection'),
            'codemirror_theme'
        );
        add_settings_field(
            'wp_codemirror_theme_selection',
            __('Select Theme', 'wp-codemirror-themes'),
            array($this, 'addThemeSelectSettingsField'),
            'codemirror_theme',
            'select_codemirror_theme',
            array(
                'label_for' => 'selected_theme',
            )
        );
    }

    /**
     * Add a menu entry
     */
    public function optionsPageMenu()
    {
        add_submenu_page(
            'tools.php',
            __('WP CodeMirror Themes', 'wp-codemirror-themes'),
            __('CodeMirror Themes', 'wp-codemirror-themes'),
            'manage_options',
            'codemirror_theme',
            array($this, 'optionsPageTemplate')
        );
    }

    /**
     * The option page HTML template
     */
    public function optionsPageTemplate()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }
        require_once 'includes/options_page_template.php';
    }

    /**
     * Get a list of installed CodeMirror themes
     *
     * @return array
     */
    public function getThemeList()
    {
        $dirname = plugin_dir_path(__FILE__) . 'theme';
        $dirPath = dir($dirname);
        $files = array();
        while (($file = $dirPath->read()) !== false) {
            if ((substr($file, -3) == 'css')) {
                $files[] = trim($file);
            }
        }
        $dirPath->close();
        sort($files);

        return $files;
    }

    /**
     * Get the selected CodeMirror theme
     *
     * @return string
     */
    public function getSelectedTheme()
    {
        $codemirror_theme_settings = get_option('codemirror_theme_settings');
        return !empty($codemirror_theme_settings['selected_theme']) ? $codemirror_theme_settings['selected_theme'] : 'default';
    }
}

return new WPCodeMirrorThemes();
