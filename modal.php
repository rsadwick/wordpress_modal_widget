<?php

/*
  Plugin Name: GFC Modal Widget
  Plugin URI: https://github.com/rsadwick/wordpress_modal_widget
  Description: Modal plugin/widget
  Version: 1.0.0
  Author: Ryan Sadwick
  Author URI: http://www.3ee.com
  License: GPL V3
 */

class Testimonials
{
    private static $instance = null;
    private $plugin_path;
    private $plugin_url;
    private $text_domain = '';

    /**
     * Creates or returns an instance of this class.
     */
    public static function get_instance()
    {
        // If an instance hasn't been created and set to $instance create an instance and set it to $instance.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Initializes the plugin by setting localization, hooks, filters, and administrative functions.
     */
    private function __construct()
    {
        $this->plugin_path = plugin_dir_path(__FILE__);
        $this->plugin_url = plugin_dir_url(__FILE__);

        load_plugin_textdomain($this->text_domain, false, $this->plugin_path . '/lang');

        add_action('admin_enqueue_scripts', array($this, 'register_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'register_styles'));

        add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'register_styles'));

        // Initialize Settings
        require_once(sprintf("settings.php", dirname(__FILE__)));
        require_once(sprintf("%s/settings.php", dirname(__FILE__)));
        //$Property_Template_Settings = new Testimonial_Template_Settings();

        // Register custom post types
        //require_once(sprintf("%s/post-types/testimonial_type_template.php", dirname(__FILE__)));
        //$Testimonial_Type_Template = new Testimonial_Type_Template();

        //include widget:
        require_once(sprintf("widget.php", dirname(__FILE__)));

        $plugin = plugin_basename(__FILE__);
        add_filter("plugin_action_links_$plugin", array($this, 'plugin_settings_link'));

        register_activation_hook(__FILE__, array($this, 'activation'));
        register_deactivation_hook(__FILE__, array($this, 'deactivation'));

        $this->run_plugin();
    }

    public function get_plugin_url()
    {
        return $this->plugin_url;
    }

    public function get_plugin_path()
    {
        return $this->plugin_path;
    }

    /**
     * Place code that runs at plugin activation here.
     */
    public function activation()
    {

    }

    /**
     * Place code that runs at plugin deactivation here.
     */
    public function deactivation()
    {

    }

    // Add the settings link to the plugins page
    function plugin_settings_link($links)
    {
        $settings_link = '<a href="options-general.php?page=wp_plugin_template">Settings</a>';
        array_unshift($links, $settings_link);
        return $links;
    }

    /**
     * Enqueue and register JavaScript files here.
     */
    public function register_scripts()
    {

    }

    /**
     * Enqueue and register CSS files here.
     */
    public function register_styles()
    {

    }

    /**
     * Place code for your plugin's functionality here.
     */
    private function run_plugin()
    {

    }
}

Testimonials::get_instance();